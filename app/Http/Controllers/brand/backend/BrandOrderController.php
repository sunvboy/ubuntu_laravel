<?php

namespace App\Http\Controllers\brand\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandOrder;
use App\Models\BrandProductCart;
use App\Models\BrandProductCartHistory;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\ListHangHistory;
use App\Models\Product;
use App\Models\ProductConfig;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BrandOrderController extends Controller
{
    protected $module = 'brand_orders';
    protected $dateEnd = '';
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
    }
    public function outListIndex(Request $request)
    {
        $date_end = $request->date_end;
        $data = BrandProductCart::groupBy('date_end')->orderBy('date_end', 'desc');
        if (!empty($date_end)) {
            $data =  $data->where('date_end', $date_end);
        }
        $data =  $data->paginate(env('APP_paginate'));
        $htmlOption = dropdownOneDeault(BrandProductCart::groupBy('date_end')->orderBy('date_end', 'asc')->get(), 'Chọn ngày đặt hàng', 'date_end', 'date_end');
        return view('brand.backend.out-list.index', compact('data', 'htmlOption'));
    }

    public function index($id)
    {
        $detail  = Brand::with(['brand_product_cart_histories' => function ($q) {
            $q->where('date_end', $this->dateEnd);
        }])->where('alanguage', config('app.locale'))->find($id);
        if (!isset($detail)) {
            return redirect()->route('brands.index')->with('error', "Thương hiệu không tồn tại");
        }
        $data  = BrandProductCart::with(['cart_items' => function ($q) {
            $q->where('date_end', $this->dateEnd);
        }])->where(['brand_id' => $id, 'date_end' => $this->dateEnd])->get();
        if (!isset($data)) {
            return redirect()->route('brands.index')->with('error', "Thương hiệu không tồn tại");
        }
        return view('brand.backend.brand-order.index', compact('data', 'detail'));
    }
    public function update(Request $request, $id)
    {
        $quantity = $request->quantity;
        $ids = $request->ids;
        $quantityOlds = $request->quantityOlds;
        $note = '';
        if (!empty($quantity) && !empty($ids)) {
            foreach ($ids as $key => $item) {
                $product = Product::find($item);
                $quantityOld = $quantityOlds[$key];
                $quantityFinal = $quantity[$key];
                BrandProductCart::where(['brand_id' => $id, 'product_id' => $item, 'date_end' => $this->dateEnd])->update([
                    'quantity' => $quantityFinal
                ]);
                if ($quantityOld != $quantityFinal) {
                    $note .= "<div><span class='font-bold fw-bold'>$product->title</span> số lượng từ <span class='font-bold fw-bold text-red-600 text-danger'>$quantityOld</span> thành <span class='font-bold fw-bold text-red-600 text-danger'>$quantityFinal</span></div>";
                }
            }
        }
        //ghi log lịch sử chỉnh sửa
        if (!empty($note)) {
            BrandProductCartHistory::create([
                'note' => $note,
                'brand_id' => $id,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'date_end' => $this->dateEnd
            ]);
        }
        return redirect()->route('brand_orders.index', ['id' => $id])->with('success', "Cập nhập thành công");
    }
}
