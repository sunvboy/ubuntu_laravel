<?php

namespace App\Http\Controllers\product\backend;

use App\Http\Controllers\Controller;
use App\Models\ProductConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductConfigController extends Controller
{
    protected $table = 'product_configs';
    public function __construct()
    {
        View::share(['module' => $this->table]);
    }
    public function index()
    {
        $units =  ProductConfig::find(1);
        $tax =  ProductConfig::find(2);
        return view('product.backend.config.index', compact('units', 'tax'));
    }

    public function createUnit(Request $request)
    {
        $detail = ProductConfig::find(1);
        $value = !empty($detail->value) ? $detail->value : [];
        if (!empty($value)) {
            $value = collect(json_decode($value, true));
            $filtered = $value->filter(function ($value) use ($request) {
                return $value == $request->value;
            })->toArray();
            if (!empty($filtered)) {
                return response()->json(['status' => 500, 'message' => "Bản ghi đã tồn tại"]);
            } else {
                $value = $value->push($request->value)->toArray();
            }
        } else {
            $value[] = $request->value;
        }
        ProductConfig::where(['id' => 1])->update([
            'value' => json_encode($value),
        ]);
        return response()->json(['status' => 200, 'message' => "Thêm mới thành công"]);
    }
    public function updateUnit(Request $request)
    {
        $detail = ProductConfig::find(1);
        $value = !empty($detail->value) ? $detail->value : [];
        if (!empty($value)) {
            $value = collect(json_decode($value, true));
            $filtered = $value->filter(function ($value) use ($request) {
                return $value == $request->value;
            })->toArray();
            if (!empty($filtered)) {
                if ($request->value != $request->valueOld) {
                    return response()->json(['status' => 500, 'message' => "Bản ghi đã tồn tại"]);
                }
            } else {
                $filtered = $value->filter(function ($value) use ($request) {
                    return $value != $request->valueOld;
                });
                $filtered = $filtered->push($request->value)->toArray();
                ProductConfig::where(['id' => 1])->update([
                    'value' => json_encode($filtered),
                ]);
            }
        }
        return response()->json(['status' => 200, 'message' => "Cập nhập thành công"]);
    }
    public function updateTax(Request $request)
    {
        ProductConfig::where(['id' => 2])->update([
            'value' => $request->value,
        ]);
        return response()->json(['status' => 200, 'message' => "Cập nhập thành công"]);
    }


    public function deleteUnit(Request $request)
    {
        $detail = ProductConfig::find(1);
        $value = !empty($detail->value) ? $detail->value : [];
        if (!empty($value)) {
            $value = collect(json_decode($value, true));
            $filtered = $value->filter(function ($value) use ($request) {
                return $value != $request->value;
            })->toArray();
            ProductConfig::where(['id' => 1])->update([
                'value' => json_encode($filtered),
            ]);
        }
        return response()->json(['status' => 200, 'message' => "Thêm mới thành công"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
