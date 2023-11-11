<?php

namespace App\Http\Controllers\brand\backend;

use App\Http\Controllers\Controller;
use App\Components\Nestedsetbie;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Validator;

class BrandController extends Controller
{
    protected $module = 'brands';
    protected $dateEnd = '';
    protected $nestedsetbie = '';
    public function __construct()
    {
        //START: tính toán ngày sửa đơn Hàng
        $today = Carbon::now()->format('d-m-Y');
        $mo = Carbon::now()->startOfWeek()->format('d-m-Y');
        $tu = Carbon::now()->startOfWeek()->addDays(1)->format('d-m-Y'); //thứ 3
        $we = Carbon::now()->startOfWeek()->addDays(2)->format('d-m-Y'); //thứ 4
        $th = Carbon::now()->startOfWeek()->addDays(3)->format('d-m-Y'); //thứ 5
        $fr = Carbon::now()->startOfWeek()->addDays(4)->format('d-m-Y'); //thứ 6
        $sa = Carbon::now()->startOfWeek()->addDays(5)->format('d-m-Y'); //thứ 7
        $su = Carbon::now()->startOfWeek()->addDays(6)->format('d-m-Y'); //chủ nhật
        $chunhat = Carbon::now()->startOfWeek()->addDays(6);
        if ($today >= $mo && $today <= $we) {
            $this->dateEnd =  $th;
        } else if ($today >= $th && $today <= $sa) {
            $this->dateEnd =  $su;
        } else if ($today == $su) {
            $this->dateEnd = $chunhat->addDays(4)->format('d-m-Y');
        }
        View::share(['module' => $this->module, 'dateEnd' => $this->dateEnd]);
        $this->nestedsetbie = new Nestedsetbie(array('table' => $this->module));
    }
    public function index(Request $request)
    {
        $data =  Brand::where('alanguage', config('app.locale'))->orderBy('lft', 'ASC');
        $keyword = $request->keyword;
        $type = $request->type;
        if (!empty($keyword)) {
            $data =  $data->where('title', 'like', '%' . $keyword . '%');
        }
        if (!empty($type)) {
            $data =  $data->where($this->module . '.' . $type,  1);
        }
        $data =  $data->paginate(env('APP_paginate'));
        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        if (is($type)) {
            $data->appends(['type' => $type]);
        }
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->module, 'active' => 1])->get();
        return view('brand.backend.brand.index', compact('data', 'configIs'));
    }
    public function create()
    {
        $htmlCatalogue = $this->nestedsetbie->dropdown();
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $this->module])->get();
        return view('brand.backend.brand.create', compact('field', 'htmlCatalogue'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:brands',
            'slug' => 'required|unique:brands',
        ], [
            'title.required' => 'Tên thương hiệu là trường bắt buộc.',
            'title.unique' => 'Tên thương hiệu đã tồn tại.',
            'slug.required' => 'Đường dẫn là trường bắt buộc.',
            'slug.unique' => 'Đường dẫn đã tồn tại.',

        ]);
        //upload image,banner,...
        if (!empty($request->file('image'))) {
            $image_url = uploadImageNone($request->file('image'), 'thuong-hieu');
        } else {
            $image_url = $request->image_old;
        }
        if (!empty($request->file('banner'))) {
            $banner_url = uploadImageNone($request->file('banner'), 'thuong-hieu/banner');
        } else {
            $banner_url = $request->banner_old;
        }
        $arrayImg = [
            'image_url' => $image_url,
            'banner_url' => $banner_url
        ];
        //end
        $this->submit($request, 'create', 0, $arrayImg);
        return redirect()->route('brands.index')->with('success', "Thêm mới thương hiệu thành công");
    }
    public function edit($id)
    {
        $detail  = Brand::where('alanguage', config('app.locale'))->find($id);
        if (!isset($detail)) {
            return redirect()->route('brands.index')->with('error', "Thương hiệu không tồn tại");
        }
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $this->module])->get();
        $htmlCatalogue = $this->nestedsetbie->dropdown();
        return view('brand.backend.brand.edit', compact('detail', 'field', 'htmlCatalogue'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:brands,slug,' . $id . ',id',
            'slug' => 'required|unique:brands,slug,' . $id . ',id',
        ], [
            'title.required' => 'Tên thương hiệu là trường bắt buộc.',
            'title.unique' => 'Tên thương hiệu đã tồn tại.',
            'slug.required' => 'Đường dẫn là trường bắt buộc.',
            'slug.unique' => 'Đường dẫn đã tồn tại.',

        ]);
        //upload image,banner,...
        if (!empty($request->file('image'))) {
            $image_url = uploadImageNone($request->file('image'), 'thuong-hieu');
        } else {
            $image_url = $request->image_old;
        }
        if (!empty($request->file('banner'))) {
            $banner_url = uploadImageNone($request->file('banner'), 'thuong-hieu/banner');
        } else {
            $banner_url = $request->banner_old;
        }
        $arrayImg = [
            'image_url' => $image_url,
            'banner_url' => $banner_url
        ];
        //end
        $this->submit($request, 'update', $id, $arrayImg);
        return redirect()->route('brands.index')->with('success', "Cập nhập thương hiệu thành công");
    }
    public function submit($request = [], $action = '', $id = 0, $arrayImg = [])
    {
        if ($action == 'create') {
            $time = 'created_at';
            $user = 'userid_created';
        } else {
            $time = 'updated_at';
            $user = 'userid_updated';
        }
        $_data = [
            'title' => $request['title'],
            'slug' => $request['slug'],
            'parentid' => $request['parentid'],
            'image' =>  $arrayImg['image_url'],
            'banner' => $arrayImg['banner_url'],
            'description' => $request['description'],
            'meta_title' => $request['meta_title'],
            'meta_description' => $request['meta_description'],
            'publish' => $request['publish'],
            $user => Auth::user()->id,
            $time => Carbon::now(),
            'alanguage' => config('app.locale'),
        ];
        if ($action == 'create') {
            $id = Brand::insertGetId($_data);
        } else {
            Brand::find($id)->update($_data);
        }
        if (!empty($id)) {
            //xóa khi cập nhập
            if ($action == 'update') {
                //xóa custom fields
                DB::table('config_postmetas')->where(['module_id' => $id, 'module' => $this->module])->delete();
            }
            //START: custom fields
            fieldsInsert($this->module, $id, $request);
            //END
            $this->nestedsetbie->Get();
            $this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
            $this->nestedsetbie->Action();
        }
    }
}
