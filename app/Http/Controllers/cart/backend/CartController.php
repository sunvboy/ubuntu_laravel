<?php

namespace App\Http\Controllers\cart\backend;

use App\Events\OrderCartProcessed;
use App\Http\Controllers\Controller;
use App\Models\BrandProductCart;
use App\Models\Cart;
use App\Models\CartHistory;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductConfig;
use App\Models\ProductInventoryHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    protected $module = 'carts';
    protected $dateEnd = '';
    protected $tax = '';
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
        $customers = dropdown(Customer::select('id', 'code', 'name')->get(), 'Chọn khách hàng', 'id', 'code', 'name');
        $tax = ProductConfig::find(2);
        $this->tax = !empty($tax) ? $tax->value : 0;
        View::share(['module' => $this->module, 'customers' => $customers, 'dateEnd' => $this->dateEnd, 'tax' => $tax]);
    }
    public function index(Request $request)
    {
        $data =  Cart::with(['user:id,name', 'customer:id,code,name'])->where(['deleted_at' => null])->orderBy('date_end', 'DESC')->orderBy('id', 'DESC');
        $keyword = $request->keyword;
        $customer_id = $request->customer_id;
        $date_end = $request->date_end;

        if (!empty($keyword)) {
            $data =  $data->where($this->module . '.title', 'like', '%' . $keyword . '%');
        }
        if (!empty($customer_id)) {
            $data =  $data->where('customer_id', $customer_id);
        }
        if (!empty($date_end)) {
            $data =  $data->where('date_end', $date_end);
        }
        $data =  $data->paginate(env('APP_paginate'));
        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        if (is($customer_id)) {
            $data->appends(['customer_id' => $customer_id]);
        }
        if (is($date_end)) {
            $data->appends(['date_end' => $date_end]);
        }
        return view('cart.backend.index', compact('data'));
    }
    public function show($id)
    {
        $detail  = Cart::with(['cart_items', 'cart_histories', 'customer', 'customer_addresses'])->where(['deleted_at' => null])->find($id);
        if (!isset($detail)) {
            return redirect()->route('carts.index')->with('error', "Đơn hàng đặt hộ không tồn tại");
        }
        $products = Product::select('id', 'title', 'price', 'price_sale', 'price_contact', 'brand_id', 'image', 'unit')
            ->with(['product_customer_price_items' => function ($q) use ($detail) {
                $q->where('customer_id', $detail->customer_id);
            }])
            ->with(['cart_items' => function ($q) use ($detail) {
                $q->where(["cart_id" => $detail->id]);
            }])
            ->where(['alanguage' => config('app.locale')])->orderBy('title', 'asc')->with(['brand'])->get();
        $data =  Cart::where(['deleted_at' => null, 'customer_id' => $detail->customer_id])->where('id', '!=', $detail->id)->with('cart_items')->orderBy('id', 'DESC')->paginate(env('APP_paginate'));
        return view('cart.backend.show', compact('detail', 'products', 'data'));
    }
    public function create()
    {
        return view('cart.backend.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|gt:0',
        ], [
            'customer_id.required' => 'Khách hàng là trường bắt buộc.',
            'customer_id.gt' => 'Khách hàng là trường bắt buộc.',
        ]);
        $create = [
            'customer_id' => $request->customer_id,
            'tax' => $this->tax,
            'customer_addresses_id' => $request->customer_addresses_id,
            'date_end' => $this->dateEnd,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ];
        $id = Cart::insertGetId($create);
        if ($id) {
            //thêm bảng cartItem
            $cart_items = [];
            $quantity = $request->quantity;
            $amount = $request->amount;
            $price = $request->price;
            $description = $request->description;
            if (!empty($quantity)) {
                foreach ($quantity as $key => $item) {
                    if (!empty(collect($item)->join(''))) {
                        $cart_items[] = [
                            'cart_id' => $id,
                            'product_id' => $key,
                            'quantity' => collect($item)->join(''),
                            'amount' =>  !empty($amount) ? collect($amount[$key])->join('') : '',
                            'price' =>  !empty($price) ? collect($price[$key])->join('') : '',
                            'description' => !empty($description) ?  collect($description[$key])->join('') : '',
                            'created_at' => Carbon::now(),
                            'date_end' => $this->dateEnd,
                        ];
                    }
                }
            }
            CartItem::insert($cart_items);
            //thêm mới vào bảng brand_product_carts
            if (!empty($quantity)) {
                foreach ($quantity as $key => $item) {
                    if (!empty(collect($item)->join(''))) {
                        //kiểm tra xem có tồn tại product_id hay chưa
                        $BrandProductCart = BrandProductCart::where(['product_id' => $key, 'date_end' => $this->dateEnd])->first();
                        if (!empty($BrandProductCart)) {
                            //cập nhập lại số lượng cần mua hàng
                            BrandProductCart::where(['id' => $BrandProductCart->id])->update([
                                'quantity' => collect($item)->join(''),
                            ]);
                        } else {
                            $product = Product::find($key);
                            $BrandProductCart = BrandProductCart::create([
                                'brand_id' => $product->brand_id,
                                'product_id' => $product->id,
                                'inventory' => $product->inventoryQuantity,
                                'products' => json_encode([
                                    'title' => $product->title,
                                    'image' => $product->image,
                                    'unit' => $product->unit,
                                ]),
                                'quantity_add' => 0,
                                'quantity_test' => 0,
                                'quantity' => collect($item)->join(''),
                                'price_import' => $product->price_import,
                                'created_at' => Carbon::now(),
                                'date_end' => $this->dateEnd,
                            ]);
                            //cập nhập lại product
                            Product::where('id', $product->id)->update([
                                'inventoryQuantity' => 0
                            ]);
                            //ghi lịch sử
                            ProductInventoryHistory::create([
                                'brand_product_cart_id' => $BrandProductCart->id,
                                'product_id' => $product->id,
                                'inventory' => $product->inventoryQuantity,
                                'user_id' => Auth::user()->id,
                                'created_at' => Carbon::now(),
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->route('carts.edit', ['id' => $id])->with('success', "Thêm mới đơn đặt hàng hộ thành công");
    }

    public function edit($id)
    {
        $detail  = Cart::with(['cart_items', 'cart_histories'])->where(['deleted_at' => null])->find($id);
        if (!isset($detail)) {
            return redirect()->route('carts.index')->with('error', "Đơn hàng đặt hộ không tồn tại");
        }
        return view('cart.backend.edit', compact('detail'));
    }
    public function duplicate($id)
    {
        $detail  = Cart::with(['cart_items', 'cart_histories'])->where(['deleted_at' => null])->find($id);
        if (!isset($detail)) {
            return redirect()->route('carts.index')->with('error', "Đơn hàng đặt hộ không tồn tại");
        }
        return view('cart.backend.duplicate', compact('detail'));
    }
    public function update(Request $request, $id)
    {

        $update = [
            'customer_addresses_id' => $request->customer_addresses_id,
            'updated_at' => Carbon::now(),
        ];
        Cart::where(['id' => $id])->update($update);
        $detail  = Cart::with('cart_items')->find($id);
        if ($id) {
            $pushers = [];
            //xóa trước khi cập nhập
            // CartItem::where('cart_id', $id)->delete();
            //thêm mới
            $cart_items = [];
            $cart_items_ids = $request->cart_items_ids;
            $quantity = $request->quantity;
            $quantity_old = $request->quantity_old;
            $amount = $request->amount;
            $description = $request->description;
            $price = $request->price;
            $note = '';
            //thêm mới vào bảng cart_items
            if (!empty($quantity)) {
                $i = 0;
                foreach ($quantity as $key => $item) {
                    if (!empty(collect($item)->join(''))) {
                        if (!empty($cart_items_ids[$i])) {
                            CartItem::where('id', (int)$cart_items_ids[$i])->update([
                                'quantity' => (float)collect($item)->join('') - (float)collect($quantity_old[$key])->join(''),
                                'description' => !empty($description) ?  collect($description[$key])->join('') : '',
                            ]);
                        } else {

                            $cart_items[] = [
                                'cart_id' => $id,
                                'product_id' => $key,
                                'quantity' => (float)collect($item)->join('') - (float)collect($quantity_old[$key])->join(''),
                                'quantity_add' => (float)collect($quantity_old[$key])->join(''),
                                'amount' =>  !empty($amount) ? collect($amount[$key])->join('') : '',
                                'price' =>  !empty($price) ? collect($price[$key])->join('') : '',
                                'description' => !empty($description) ?  collect($description[$key])->join('') : '',
                                'created_at' => Carbon::now(),
                                'date_end' => $this->dateEnd,
                            ];
                        }
                        $product = Product::select('title')->find($key);
                        $quantityOld = !empty($quantity_old) ? collect($quantity_old[$key])->join('') : '';
                        $quantityFinal = collect($item)->join('');
                        if ($quantityOld != $quantityFinal) {
                            $pushers[] = $key;
                            $note .= "<div><span class='font-bold fw-bold'>$product->title</span> số lượng từ <span class='font-bold fw-bold text-red-600 text-danger'>$quantityOld</span> thành <span class='font-bold fw-bold text-red-600 text-danger'>$quantityFinal</span></div>";
                        }
                    }
                    $i++;
                }
            }
            CartItem::insert($cart_items);
            //ghi log chỉnh sửa
            if (!empty($note)) {
                CartHistory::create([
                    'cart_id' => $id,
                    'user_id' => Auth::user()->id,
                    'note' => $note,
                    'created_at' => Carbon::now(),
                    'data_old' => json_encode(collect($detail->cart_items)->toArray())
                ]);
            }
            $CartItem = CartItem::select('product_id', 'quantity')->where(['date_end' => $this->dateEnd])->get();
            $CartItem = $CartItem->groupBy('product_id');
            $brand_product_carts = [];
            if (!empty($CartItem)) {
                foreach ($CartItem as $key => $item) {
                    $brand_product_carts[$key] = collect($item)->sum('quantity');
                }
            }
            //thêm mới vào bảng brand_product_carts
            if (!empty($quantity)) {
                foreach ($quantity as $key => $item) {
                    if (!empty(collect($item)->join(''))) {
                        //kiểm tra xem có tồn tại product_id hay chưa
                        $BrandProductCart = BrandProductCart::where(['product_id' => $key, 'date_end' => $this->dateEnd])->first();
                        if (!empty($BrandProductCart)) {
                            //cập nhập lại số lượng cần mua hàng
                            BrandProductCart::where(['id' => $BrandProductCart->id])->update([
                                'quantity' => (float)collect($item)->join('') - (float)collect($quantity_old[$key])->join('')
                            ]);
                        } else {
                            $product = Product::find($key);
                            $BrandProductCart = BrandProductCart::insertGetId([
                                'brand_id' => $product->brand_id,
                                'product_id' => $product->id,
                                'inventory' => $product->inventoryQuantity,
                                'products' => json_encode([
                                    'title' => $product->title,
                                    'image' => $product->image,
                                    'unit' => $product->unit,
                                ]),
                                'quantity' => collect($item)->join(''),
                                'price_import' => $product->price_import,
                                'created_at' => Carbon::now(),
                                'date_end' => $this->dateEnd,
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
                        }
                    }
                }
            }
            // trừ số lượng cũ
            // if (!empty($detail->cart_items) && count($detail->cart_items) > 0) {
            //     foreach ($detail->cart_items as $item) {
            //         $BrandProductCart = BrandProductCart::where(['product_id' => $item->product_id, 'date_end' => $this->dateEnd])->first();
            //         if (!empty($BrandProductCart)) {
            //             BrandProductCart::where(['id' => $BrandProductCart->id])->update([
            //                 'quantity' => (float)$BrandProductCart->quantity - (float) $item->quantity
            //             ]);
            //         }
            //     }
            // }
            //thêm mới vào bảng brand_product_carts
            // if (!empty($quantity)) {
            //     foreach ($quantity as $key => $item) {
            //         if (!empty(collect($item)->join(''))) {
            //             //kiểm tra xem có tồn tại product_id hay chưa
            //             $BrandProductCart = BrandProductCart::where(['product_id' => $key, 'date_end' => $this->dateEnd])->first();
            //             if (!empty($BrandProductCart)) {
            //                 //cập nhập lại số lượng cần mua hàng
            //                 BrandProductCart::where(['id' => $BrandProductCart->id])->update([
            //                     'quantity' => (float)$BrandProductCart->quantity + (float) collect($item)->join('')
            //                 ]);
            //             } else {
            //                 $product = Product::find($key);
            //                 BrandProductCart::create([
            //                     'brand_id' => $product->brand_id,
            //                     'product_id' => $product->id,
            //                     'products' => json_encode([
            //                         'title' => $product->title,
            //                         'image' => $product->image,
            //                         'unit' => $product->unit,
            //                     ]),
            //                     'quantity' => collect($item)->join(''),
            //                     'price_import' => $product->price_import,
            //                     'created_at' => Carbon::now(),
            //                     'date_end' => $this->dateEnd,
            //                 ]);
            //             }
            //         }
            //     }
            // }
            //lấy theo brand_product_carts
            // $BrandProductCartPushers =  BrandProductCart::whereIn('product_id', $pushers)->where('date_end', $this->dateEnd)->orderBy('id', 'desc')->get();
            // $events = [];
            // if (!empty($BrandProductCartPushers)) {
            //     foreach ($BrandProductCartPushers as $item) {
            //         $events[$item->product_id] = $item->quantity;
            //     }
            // }
            // event(new OrderCartProcessed($events));
        }
        return redirect()->route('carts.edit', ['id' => $id])->with('success', "Cập nhập đơn đặt hàng hộ thành công");
    }
    public function customer(Request $request)
    {
        $id = $request->id;
        $detail  = Cart::where(['deleted_at' => null])->find($id);
        $dateEnd = $this->dateEnd;
        $checkCart = Cart::where(['customer_id' => $id, 'date_end' => $this->dateEnd, 'deleted_at' => null])->first();
        if (!empty($checkCart)) {
            return response()->json(['error' => "Đơn đặt hàng ngày $this->dateEnd đã tồn tại chuyển đến trang chỉnh sửa", "detail" => $checkCart]);
        }
        $customer = Customer::with(['customer_addresses' => function ($q) {
            $q->orderBy('publish', 'desc');
        }])->find($id);
        $products = Product::select('id', 'title', 'price', 'price_sale', 'price_contact', 'brand_id', 'image', 'unit')->with(['product_customer_price_items' => function ($q) use ($id) {
            $q->where('customer_id', $id);
        }])->with(['cart_items' => function ($q) {
            $q->where(["cart_id" => 0]);
        }])->where(['alanguage' => config('app.locale')])->orderBy('title', 'asc')->with(['brand'])->get();
        return view('cart.backend.common.info-customer', compact('customer', 'products'))->render();
    }
    public function customerEdit(Request $request)
    {
        $id = $request->id;
        $cart_id = $request->cart_id;
        $detail  = Cart::where(['deleted_at' => null])->find($cart_id);
        $dateEnd = $this->dateEnd;
        $customer = Customer::with(['customer_addresses' => function ($q) {
            $q->orderBy('publish', 'desc');
        }])->find($id);
        $products = Product::select('id', 'title', 'price', 'price_sale', 'price_contact', 'brand_id', 'image', 'unit')
            ->with(['product_customer_price_items' => function ($q) use ($id) {
                $q->where('customer_id', $id);
            }])
            ->with(['cart_items' => function ($q) use ($cart_id) {
                $q->where(["cart_id" => $cart_id]);
            }])
            ->where(['alanguage' => config('app.locale')])->orderBy('title', 'asc')->with(['brand'])->get();
        return view('cart.backend.common.info-customer', compact('customer', 'products', 'detail', 'dateEnd'))->render();
    }
}
