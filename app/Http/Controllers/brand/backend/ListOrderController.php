<?php

namespace App\Http\Controllers\brand\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandProductCart;
use App\Models\BrandProductCartHistory;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\ListHangHistory;
use App\Models\Product;
use App\Models\ProductConfig;
use App\Models\ProductInventoryHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ListOrderController extends Controller
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
    //list hàng
    public function index(Request $request)
    {
        $date_end = $this->dateEnd;
        // if (empty($date_end)) {
        //     return redirect()->route('brand_orders.outListIndex')->with('error', "Error");
        // }
        $groupByDateEnd = BrandProductCart::select('date_end')->groupBy('date_end')->orderBy('id', 'desc')->get()->pluck('date_end')->toArray();
        $units = ProductConfig::select('value')->find(1);
        $units =  !empty($units) ? json_decode($units->value, TRUE) : [];
        $unit = !empty($units) ? collect($units)->first() : '';
        $histories = ListHangHistory::where(['date_end' => $date_end])->orderBy('id', 'desc')->get();
        $products = Product::select('id', 'title', 'brand_id', 'unit')
            ->where(['unit' => $unit])
            ->with([
                'cart_items' => function ($q) use ($date_end) {
                    $q->where('date_end', $date_end)
                        ->with('carts:id,customer_id');
                }
            ])
            ->with([
                'brand_product_carts' => function ($q) use ($date_end) {
                    $q->where('date_end', $date_end);
                }
            ])
            ->where(['alanguage' => config('app.locale')])
            ->orderBy('title', 'asc')
            ->get();
        $customers = Customer::select('id', 'code')
            ->with(['carts' => function ($q) use ($date_end) {
                $q->where('date_end', $date_end)
                    ->with(['cart_items' => function ($e) {
                        $e->pluck('product_id', 'quantity');
                    }]);
            }])
            ->get();
        $totalCustomer = $inventoryQuantity = $inventoryQuantityCount = $totalQuantity = 0;
        if (!empty($products) && count($products) > 0) {
            foreach ($products as $item) {
                $totalCustomer += $item->cart_items_all->sum('quantity');
                if (!empty($item->brand_product_carts)) {
                    $inventoryQuantity = $inventoryQuantity + $item->brand_product_carts->inventory;
                    $inventoryQuantityCount =  $inventoryQuantityCount + 1;
                    $totalQuantity +=  $item->brand_product_carts->quantity;
                }
            }
        }
        $brands = Brand::select('id', 'title', 'ishome', 'highlight')
            ->with(['brand_product_carts' => function ($q) use ($date_end) {
                $q->where('date_end', $date_end);
            }])
            ->with(['products' => function ($e) use ($date_end, $unit) {
                $e->where(['unit' => $unit])->where(['alanguage' => config('app.locale')])->with([
                    'cart_items_all' => function ($a) use ($date_end) {
                        $a->where('date_end', $date_end);
                    }
                ]);
            }])->get();
        $totalBrand = 0;
        if (!empty($brands)) {
            foreach ($brands as $brand) {
                $totalBrand += $brand->brand_product_carts->sum('quantity');
            }
        }
        return view('brand.backend.list-order.index', compact('products', 'customers', 'totalCustomer', 'inventoryQuantity', 'inventoryQuantityCount', 'brands', 'totalBrand', 'histories', 'date_end', 'groupByDateEnd', 'units', 'totalQuantity'));
    }
    //update list hang
    public function update(Request $request)
    {
        $dateEndUpdate = $request->dateEndUpdate;
        $product_id = $request->product_id;
        $customer_id = $request->customer_id;
        $quantityOld = $request->quantityOld;
        $quantity = !empty($request->quantity) ? (!empty($request->quantity != 'NaN') ?  (int)$request->quantity : 0) : 0;
        $inputTotalCustomer = $request->inputTotalCustomer;
        //check bảng "carts"
        $carts = Cart::where(['date_end' => $dateEndUpdate, 'customer_id' => $customer_id])->first();
        //chi tiết sản phẩm
        $product = Product::with(['product_customer_price_items'])->find($product_id);
        $price = getPrice(array('price' => $product['price'], 'price_sale' => $product['price_sale'], 'price_contact' =>
        $product['price_contact']));
        if (!empty($product->product_customer_price_items)) {
            $priceNonFormat = floor($product->price);
        } else {
            $priceNonFormat = $price['price_final_none_format'];
        }
        $customer = Customer::with(['customer_addresses_one' => function ($q) {
            $q->where('publish', 1);
        }])->find($customer_id);
        if (empty($carts)) {
            $tax = ProductConfig::find(2);
            //thêm mới vào bảng "carts"
            $create = [
                'customer_id' => $customer_id,
                'customer_addresses_id' => !empty($customer->customer_addresses_one) ? $customer->customer_addresses_one->id : 0,
                'date_end' => $dateEndUpdate,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'tax' => !empty($tax) ? $tax->value : 0
            ];
            $id = Cart::insertGetId($create);
            if ($id) {
                // thêm bảng cartItem
                CartItem::insertGetId([
                    'cart_id' => $id,
                    'product_id' => $product_id,
                    'quantity' => $quantityOld,
                    'quantity_add' => $quantity - $quantityOld,
                    'amount' => ($quantity + $quantityOld) * $priceNonFormat,
                    'price' =>  $priceNonFormat,
                    'description' => '',
                    'created_at' => Carbon::now(),
                    'date_end' => $dateEndUpdate,
                ]);
            }
        } else {
            $CartItem = CartItem::where(['cart_id' => $carts->id, 'date_end' => $dateEndUpdate, 'product_id' => $product_id])->first();
            if (empty($CartItem)) {
                CartItem::insertGetId([
                    'cart_id' => $carts->id,
                    'product_id' => $product_id,
                    'quantity_add' => $quantity - $quantityOld,
                    'amount' => ($quantity + $quantityOld) * $priceNonFormat,
                    'price' =>  $priceNonFormat,
                    'description' => '',
                    'created_at' => Carbon::now(),
                    'date_end' => $dateEndUpdate,
                ]);
            } else {
                CartItem::where(['cart_id' => $carts->id, 'date_end' => $dateEndUpdate, 'product_id' => $product_id])->update([
                    'quantity_add' => $quantity -  $CartItem->quantity,
                    'amount' => ($quantity + $CartItem->quantity) * $CartItem->price,
                    'updated_at' => Carbon::now(),
                ]);
            }
            //thêm mới vào bảng brand_product_carts

        }
        //kiểm tra xem có tồn tại product_id hay chưa
        /*$BrandProductCart = BrandProductCart::where(['product_id' => $product_id, 'date_end' => $dateEndUpdate])->first();
        if (!empty($BrandProductCart)) {
            BrandProductCart::where('id', $BrandProductCart->id)->update([
                'quantity' => $inputTotalCustomer
            ]);
            $note = "<div>List hàng <span class='font-bold fw-bold'>$product->title</span> số lượng từ <span class='font-bold fw-bold text-red-600 text-danger'>$BrandProductCart->quantity</span> thành <span class='font-bold fw-bold text-red-600 text-danger'>$inputTotalCustomer</span></div>";
            BrandProductCartHistory::create([
                'note' => $note,
                'product_id' => $product_id,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'date_end' => $dateEndUpdate
            ]);
        } else {
            $product = Product::find($product_id);
            $BrandProductCart = BrandProductCart::insertGetId([
                'brand_id' => $product->brand_id,
                'product_id' => $product->id,
                'inventory' => $product->inventoryQuantity,
                'products' => json_encode([
                    'title' => $product->title,
                    'image' => $product->image,
                    'unit' => $product->unit,
                ]),
                'quantity' => $inputTotalCustomer,
                'price_import' => $product->price_import,
                'created_at' => Carbon::now(),
                'date_end' => $dateEndUpdate,
            ]);
            //cập nhập lại product
            Product::where('id', $product->id)->update([
                'inventoryQuantity' => 0
            ]);
            //ghi lịch sử
            ProductInventoryHistory::create([
                'brand_product_cart_id' => $BrandProductCart,
                'product_id' => $product->id,
                'inventory' => $product->inventoryQuantity,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
        } */
        $note = "<div>List hàng <span class='font-bold fw-bold'>$product->title</span> số lượng từ <span class='font-bold fw-bold text-red-600 text-danger'>$quantityOld</span> thành <span class='font-bold fw-bold text-red-600 text-danger'>$quantity</span></div>";
        $history = ListHangHistory::create([
            'note' => $note,
            'customer_id' => $customer_id,
            'product_id' => $product_id,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'date_end' => $dateEndUpdate
        ]);
        return response(['status' => 200, 'history' => $history, 'user_edit' => !empty($history->user) ? $history->user->name : '', 'customer' => $customer->code . '-' . $customer->name]);
    }
    public function filter(Request $request)
    {
        $date_end = $request->dateEnd;
        $unit = $request->unit;
        // if (empty($date_end)) {
        //     return redirect()->route('brand_orders.outListIndex')->with('error', "Error");
        // }
        $histories = ListHangHistory::where(['date_end' => $date_end])->orderBy('id', 'desc')->get();
        $products = Product::select('id', 'title', 'brand_id', 'inventoryQuantity', 'unit')
            ->where(['unit' => $unit])
            ->with([
                'cart_items' => function ($q) use ($date_end) {
                    $q->where('date_end', $date_end)
                        ->with('carts:id,customer_id');
                }
            ])
            ->with([
                'brand_product_carts' => function ($q) use ($date_end) {
                    $q->where('date_end', $date_end);
                }
            ])
            ->where(['alanguage' => config('app.locale')])
            ->orderBy('title', 'asc')
            ->get();
        $customers = Customer::select('id', 'code')
            ->with(['carts' => function ($q) use ($date_end) {
                $q->where('date_end', $date_end)
                    ->with(['cart_items' => function ($e) {
                        $e->pluck('product_id', 'quantity');
                    }]);
            }])
            ->get();
        $totalCustomer = $inventoryQuantity = $inventoryQuantityCount = $totalQuantity = 0;
        if (!empty($products) && count($products) > 0) {
            foreach ($products as $item) {
                $totalCustomer += $item->cart_items_all->sum('quantity');
                if (!empty($item->brand_product_carts)) {
                    $inventoryQuantity = $inventoryQuantity + $item->brand_product_carts->inventory;
                    $inventoryQuantityCount =  $inventoryQuantityCount + 1;
                    $totalQuantity +=  $item->brand_product_carts->quantity;
                }
            }
        }
        $brands = Brand::select('id', 'title', 'ishome', 'highlight')
            ->with(['brand_product_carts' => function ($q) use ($date_end) {
                $q->where('date_end', $date_end);
            }])
            ->with(['products' => function ($e) use ($date_end, $unit) {
                $e->where(['unit' => $unit])->where(['alanguage' => config('app.locale')])->with([
                    'cart_items_all' => function ($a) use ($date_end) {
                        $a->where('date_end', $date_end);
                    }
                ]);
            }])->get();
        $totalBrand = 0;
        if (!empty($brands)) {
            foreach ($brands as $brand) {
                $totalBrand += $brand->brand_product_carts->sum('quantity');
            }
        }
        $html = view('brand.backend.list-order.data', compact('products', 'customers', 'totalCustomer', 'inventoryQuantity', 'inventoryQuantityCount', 'brands', 'totalBrand', 'histories', 'date_end', 'totalQuantity'))->render();
        return response()->json(['html' => $html]);
    }
}
