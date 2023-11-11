<?php

namespace App\Http\Controllers\brand\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandProductCart;
use App\Models\BrandProductCartHistory;
use App\Models\Product;
use App\Models\ProductConfig;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class OutListController extends Controller
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
        // if (empty($date_end)) {
        //     return redirect()->route('brand_orders.outListIndex')->with('error', "Error");
        // }
        $groupByDateEnd = BrandProductCart::select('date_end')->groupBy('date_end')->orderBy('id', 'desc')->get()->pluck('date_end')->toArray();
        $units = ProductConfig::select('value')->find(1);
        $units =  !empty($units) ? json_decode($units->value, TRUE) : [];
        // $brand_product_carts = BrandProductCart::where(['date_end' => $date_end])->groupBy('product_id')->orderBy('id', 'desc')->get()->pluck('product_id');
        $histories = BrandProductCartHistory::where(['date_end' => $date_end])->orderBy('id', 'desc')->get();
        if (!empty($request->unit)) {
            $unit = $request->unit;
        } else {
            $unit = !empty($units) ? collect($units)->first() : '';
        }
        $products = Product::select('id', 'title', 'brand_id', 'slug')
            ->where(['unit' => $unit])
            // ->whereIn('id', $brand_product_carts->toArray())
            ->with([
                'cart_items_all' => function ($q) use ($date_end) {
                    $q->where('date_end', $date_end);
                }
            ])->with([
                'brand_product_carts' => function ($q) use ($date_end) {
                    $q->where('date_end', $date_end);
                }
            ])->where(['alanguage' => config('app.locale')])->orderBy('title', 'asc')->get();
        $totalCustomer = 0;
        $inventoryQuantity = 0;
        if (!empty($products) && count($products) > 0) {
            foreach ($products as $item) {
                $totalCustomer += $item->cart_items_all->sum('quantity');
                if (!empty($item->brand_product_carts)) {
                    $inventoryQuantity = $inventoryQuantity + $item->brand_product_carts->inventory;
                }
            }
        }
        $brands = Brand::select('id', 'title', 'highlight', 'ishome')
            ->with(['brand_product_carts' => function ($q) use ($date_end) {
                $q->where('date_end', $date_end);
            }])
            ->with(['products' => function ($e) use ($date_end, $unit) {
                $e->where(['unit' => $unit])->with([
                    'cart_items_all' => function ($a) use ($date_end) {
                        $a->where('date_end', $date_end);
                    }
                ]);
            }])
            ->get();
        $totalBrand = 0;
        if (!empty($brands)) {
            foreach ($brands as $brand) {
                $totalBrand += $brand->brand_product_carts->sum('quantity');
            }
        }
        return view('brand.backend.out-list.index', compact('products', 'totalCustomer', 'inventoryQuantity', 'brands', 'totalBrand', 'histories', 'units', 'groupByDateEnd', 'date_end'));
    }
    public function update(Request $request)
    {
        $dateEndUpdate = $request->dateEndUpdate;
        $type = $request->type;
        $product_id = $request->product_id;
        $quantity_test = $request->quantity_test;
        $quantity_add = $request->quantity_add;
        $detail = BrandProductCart::where(['product_id' => $product_id, 'date_end' => $dateEndUpdate])->first();
        $product = Product::find($product_id);
        if (!empty($detail)) {
            BrandProductCart::where(['product_id' => $product_id, 'date_end' => $dateEndUpdate])->update([
                'quantity_test' => $quantity_test,
                'quantity_add' => $quantity_add,
            ]);
        } else {
            BrandProductCart::create([
                'quantity_test' => $quantity_test,
                'quantity_add' => $quantity_add,
                'brand_id' => $product->brand_id,
                'product_id' => $product->id,
                'products' => json_encode([
                    'title' => $product->title,
                    'image' => $product->image,
                    'unit' => $product->unit,
                ]),
                'price_import' => $product->price_import,
                'created_at' => Carbon::now(),
                'date_end' => $dateEndUpdate,
            ]);
        }

        //lưu lịch sử
        if ($type == 'add') {
            $detailQtyAdd = !empty($detail->quantity_add) ? $detail->quantity_add : 0;
            $note = "<div><span class='font-bold fw-bold'>$product->title</span> số lượng <span class='fw-bold text-green-600 text-success font-bold'>Đặt thêm</span> từ <span class='font-bold fw-bold text-red-600 text-danger'>$detailQtyAdd</span> thành <span class='font-bold fw-bold text-red-600 text-danger'>$quantity_add</span></div>";
        } else {
            $detailQtyTest = !empty($detail->quantity_test) ? $detail->quantity_test : 0;
            $note = "<div><span class='font-bold fw-bold'>$product->title</span> số lượng <span class='fw-bold text-red-600 text-danger font-bold'>Đặt thử hàng Việt</span> từ <span class='font-bold fw-bold text-red-600 text-danger'>$detailQtyTest</span> thành <span class='font-bold fw-bold text-red-600 text-danger'>$quantity_test</span></div>";
        }
        $history = BrandProductCartHistory::create([
            'note' => $note,
            'product_id' => $product->id,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'date_end' => $dateEndUpdate
        ]);
        return response(['status' => 200, 'history' => $history, 'user_edit' => !empty($history->user) ? $history->user->name : '']);
    }
    public function filter(Request $request)
    {
        $date_end = $request->dateEnd;
        $unit = $request->unit;
        // $brand_product_carts = BrandProductCart::where(['date_end' => $date_end])->groupBy('product_id')->orderBy('id', 'desc')->get()->pluck('product_id');
        $histories = BrandProductCartHistory::where(['date_end' => $date_end])->orderBy('id', 'desc')->get();
        $products = Product::select('id', 'title', 'brand_id', 'inventoryQuantity', 'slug')
            ->where(['unit' => $unit])
            // ->whereIn('id', $brand_product_carts->toArray())
            ->with([
                'cart_items_all' => function ($q) use ($date_end) {
                    $q->where('date_end', $date_end);
                }
            ])->with([
                'brand_product_carts' => function ($q) use ($date_end) {
                    $q->where('date_end', $date_end);
                }
            ])->where(['alanguage' => config('app.locale')])->orderBy('title', 'asc')->get();
        $totalCustomer = 0;
        $inventoryQuantity = 0;
        if (!empty($products) && count($products) > 0) {
            foreach ($products as $item) {
                $totalCustomer += $item->cart_items_all->sum('quantity');
                if (!empty($item->brand_product_carts)) {
                    $inventoryQuantity = $inventoryQuantity + $item->brand_product_carts->inventory;
                }
            }
        }
        $brands = Brand::select('id', 'title', 'highlight', 'ishome')
            ->with(['brand_product_carts' => function ($q) use ($date_end) {
                $q->where('date_end', $date_end);
            }])
            ->with(['products' => function ($e) use ($date_end, $unit) {
                $e->where(['unit' => $unit])->with([
                    'cart_items_all' => function ($a) use ($date_end) {
                        $a->where('date_end', $date_end);
                    }
                ]);
            }])
            ->get();
        $totalBrand = 0;
        if (!empty($brands)) {
            foreach ($brands as $brand) {
                $totalBrand += $brand->brand_product_carts->sum('quantity');
            }
        }
        $productIDs = $products->pluck('id');
        $html = view('brand.backend.out-list.data', compact('products', 'totalCustomer', 'inventoryQuantity', 'brands', 'totalBrand', 'histories',  'date_end'))->render();
        return response()->json(['html' => $html, 'productIDs' => $productIDs]);
    }
}
