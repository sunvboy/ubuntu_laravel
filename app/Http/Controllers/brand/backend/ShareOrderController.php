<?php

namespace App\Http\Controllers\brand\backend;

use App\Http\Controllers\Controller;
use App\Models\BrandProductCart;
use App\Models\CartItem;
use App\Models\ProductConfig;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareOrderController extends Controller
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
    public function index(Request $request)
    {
        $date_end = $this->dateEnd;
        $groupByDateEnd = BrandProductCart::select('date_end')->groupBy('date_end')->orderBy('id', 'desc')->get()->pluck('date_end')->toArray();
        $cart_items = CartItem::where(['date_end' => $date_end])
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->with(['carts' => function ($q) {
                $q->select('id', 'customer_id')->with('customer:id,name,code');
            }])
            ->select('cart_items.*', 'products.title as title')
            ->get();
        $cart_items = $cart_items->groupBy('title');
        return view('brand.backend.share-order.index', compact('cart_items', 'date_end', 'groupByDateEnd'));
    }
    public function filter(Request $request)
    {
        $date_end = $request->dateEnd;
        $cart_items = CartItem::where(['date_end' => $date_end])
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->with(['carts' => function ($q) {
                $q->select('id', 'customer_id')->with('customer:id,name,code');
            }])
            ->select('cart_items.*', 'products.title as title')
            ->get();
        $cart_items = $cart_items->groupBy('title');
        return response()->json(['html' => view('brand.backend.share-order.data', compact('cart_items', 'date_end'))->render()]);
    }
}
