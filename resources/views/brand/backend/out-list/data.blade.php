<div class="col-lg-12">
    <div class="card" id="invoiceList">
        <div class="card-body card-body-22">
            <div>
                <div class="table-responsive table-card">
                    <table class="table align-middle table-nowrap" style="margin-bottom: 0;" id="invoiceTable">
                        <thead style="font-weight: bold;">
                            <tr style="text-align: center; ">
                                <td colspan="2">
                                </td>
                                <td class="text-center text-uppercase" style="color: blue;background-color: #d1f0eb !important;color: #089d27;font-size: 15px;font-weight: bold;">
                                    Tổng<br> = <span class="totalEnforcement"></span>
                                </td>
                                <td style="color: blue; ">
                                </td>
                                @if(!empty($brands))
                                @foreach($brands as $brand)
                                <td <?php if ($brand->highlight == 1) { ?>style="background:#299cdb;color: #fff" <?php } ?> <?php if ($brand->ishome == 1) { ?>style="background:#0ab39c;color: #fff" <?php } ?>>
                                    {{$brand->title}}<br> = <span class="quantityOfBrand-{{$brand->id}} <?php if ($brand->ishome == 1) { ?> quantityBrandAdd <?php } ?> <?php if ($brand->highlight == 1) { ?> quantityBrandTest <?php } ?>">0</span>
                                </td>
                                @endforeach
                                @endif
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>
                        </thead>
                        <thead style="font-weight: bold;">
                            <tr style="text-align: center;">
                                <td colspan="2">
                                </td>
                                <td style="color: #ff0000;" class="text-center">
                                    Tổng khách đã đặt<br>
                                    = {{$totalCustomer}}
                                </td>
                                <td style="color: blue;">
                                    Kho<br> = {{$inventoryQuantity}}
                                </td>
                                @if(!empty($brands))
                                @foreach($brands as $brand)
                                <?php
                                $totalBrand = 0;
                                if (!empty($brand->products) && count($brand->products) > 0) {
                                    foreach ($brand->products as $p) {
                                        if (!empty($p->cart_items_all)) {
                                            $totalBrand += $p->cart_items_all->sum('quantity');
                                        }
                                    }
                                }
                                ?>
                                <td>
                                    Khách đã đặt<br>
                                    = {{$totalBrand}}
                                </td>
                                @endforeach
                                @endif
                                <td>
                                    Tổng<br> = <span class="inputTotalTestSuccess">0</span>
                                </td>
                                <td>
                                    Tổng<br> = <span class="inputTotalAddSuccess">0</span>
                                </td>
                                <td>
                                    Tổng<br> = <span class="inputExcessSuccess">0</span>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td style="color: #ff0000;">
                                    Tổng <br> = <span class="totalEnforcement"></span>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>
                        </thead>
                        <thead class="text-muted">
                            <tr style="text-align: center;">
                                <td style="min-width: 30px">
                                    MKH
                                </td>
                                <td>
                                    Tên Hàng
                                </td>
                                <td>
                                    Tổng
                                </td>
                                <td>
                                    Kho
                                </td>
                                @if(!empty($brands))
                                @foreach($brands as $brand)
                                <td>
                                    {{$brand->title}}
                                </td>
                                @endforeach
                                @endif
                                <td style="background-color:#299cdb;color: #fff">
                                    Đặt thử<br> hàng Việt
                                </td>
                                <td style="background-color: #0ab39c;color: #fff">
                                    Đặt thêm
                                </td>
                                <td>
                                    Thừa thiếu
                                </td>
                                <td>
                                    Ghi chú
                                </td>
                                <td>
                                    Diễn giải
                                </td>
                                <td>
                                    Thực đặt
                                </td>
                                <td>
                                    Tổng thử<br> = <span class="inputTotalTestSuccess">0</span>
                                </td>
                                <td>
                                    Tổng thêm<br> = <span class="inputTotalAddSuccess">0</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            @if(!empty($products))
                            @foreach($products as $key=>$item)
                            <?php
                            $inventoryQuantityItem = !empty($item->brand_product_carts->inventory) ? $item->brand_product_carts->inventory : 0;
                            ?>
                            <tr class="{{$item->slug}} itemProducts">
                                <td>{{$key+1}}</td>
                                <td>
                                    {{$item->title}}
                                </td>
                                <td>
                                    <span class="textQuantityProduct-{{$item->id}}">{{!empty($item->brand_product_carts)?$item->brand_product_carts->quantity:''}}</span>
                                    <input type="hidden" class="quantity quantity-{{$item->id}}" value="{{!empty($item->brand_product_carts)?$item->brand_product_carts->quantity:0}}">
                                </td>
                                <td>
                                    <input type="text" class="inventoryQuantity inventoryQuantity-{{$item->id}}" value="{{!empty($inventoryQuantityItem)?$inventoryQuantityItem:''}}" style="border:0px;width: 50px;background: transparent;" disabled>
                                </td>
                                @if(!empty($brands))
                                @foreach($brands as $brand)
                                <td>
                                    <?php
                                    if ($brand->id == $item->brand_id) {
                                        echo '<span class="textQuantityProduct-' . $item->id . '">' . !empty($item->cart_items_all->sum('quantity') > 0) ? $item->cart_items_all->sum('quantity') : '' . '</span>';
                                    }
                                    ?>
                                </td>
                                @endforeach
                                @endif
                                <td>
                                    <input type="text" class="quantity-test quantity-test-{{$item->id}}" data-id="{{$item->id}}" value="{{!empty($item->brand_product_carts)?$item->brand_product_carts->quantity_test:''}}" style="border:0px;width: 50px;background: gray;color:white">
                                    <?php /*@if($date_end == $dateEnd)
                                    <input type="text" class="quantity-test quantity-test-{{$item->id}}" data-id="{{$item->id}}" value="{{!empty($item->brand_product_carts)?$item->brand_product_carts->quantity_test:''}}" style="border:0px;width: 50px;background: gray;color:white">
                                    @else
                                    {{!empty($item->brand_product_carts)?$item->brand_product_carts->quantity_test:''}}
                                    @endif*/ ?>
                                </td>
                                <td>
                                    <input type="text" class="quantity-add quantity-add-{{$item->id}}" data-id="{{$item->id}}" value="{{!empty($item->brand_product_carts)?$item->brand_product_carts->quantity_add:''}}" style="border:0px;width: 50px;background: gray;color:white">
                                    <?php /*@if($date_end == $dateEnd)
                                    <input type="text" class="quantity-add quantity-add-{{$item->id}}" data-id="{{$item->id}}" value="{{!empty($item->brand_product_carts)?$item->brand_product_carts->quantity_add:''}}" style="border:0px;width: 50px;background: gray;color:white">
                                    @else
                                    {{!empty($item->brand_product_carts)?$item->brand_product_carts->quantity_add:''}}
                                    @endif*/ ?>
                                </td>
                                <td style="background: #cfcfdf;">
                                    <span class="excess excess-{{$item->id}}">
                                        -
                                    </span>
                                    <input class="inputExcess inputExcess-{{$item->id}}" type="hidden" value="0">
                                </td>
                                <td>
                                    <input type="text" value="{{!empty($item->brand_product_carts)?$item->brand_product_carts->note:''}}" style="border:0px;width: 50px;background: gray;color:white">
                                    <?php /*@if($date_end == $dateEnd)
                                    <input type="text" value="{{!empty($item->brand_product_carts)?$item->brand_product_carts->note:''}}" style="border:0px;width: 50px;background: gray;color:white">
                                    @else
                                    {{!empty($item->brand_product_carts)?$item->brand_product_carts->note:''}}
                                    @endif*/ ?>
                                </td>
                                <td>
                                    <span class=" fw-bold message message-{{$item->id}}">
                                        @if($inventoryQuantityItem > $item->cart_items_all->sum('quantity'))
                                        <span class="text-success">Không phải đặt</span>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    $totalEnd = 0;
                                    /*
                                    $inputTotalEndOld = 0;
                                    if (!empty($item->brand_product_carts)) {
                                        $totalEndAddTest = $item->brand_product_carts->quantity_test + $item->brand_product_carts->quantity_add;
                                        if ($inventoryQuantityItem < $item->brand_product_carts->quantity) {
                                            $totalEnd = $item->brand_product_carts->quantity;
                                            $inputTotalEndOld = $item->brand_product_carts->quantity;
                                        }
                                        if ($item->brand_product_carts->quantity_test || $item->brand_product_carts->quantity_add) {
                                            $totalEnd = $totalEnd + $item->brand_product_carts->quantity_test + $item->brand_product_carts->quantity_add;
                                        }
                                    } */
                                    $quantity = !empty($item->brand_product_carts->quantity) ? $item->brand_product_carts->quantity : 0;
                                    $inventory = !empty($item->brand_product_carts->inventory) ? $item->brand_product_carts->inventory : 0;
                                    $quantity_test = !empty($item->brand_product_carts->quantity_test) ? $item->brand_product_carts->quantity_test : 0;
                                    $quantity_add = !empty($item->brand_product_carts->quantity_add) ? $item->brand_product_carts->quantity_add : 0;
                                    $totalEnd = ($quantity - $inventory) + ($quantity_test + $quantity_add);
                                    ?>
                                    <span class="totalEnd totalEnd-{{$item->id}}">

                                    </span>
                                    <input type="hidden" data-brand-id="{{$item->brand_id}}" class="inputTotalEnd inputTotalEnd-{{$item->id}}" value="">
                                    <input type="hidden" data-brand-id="{{$item->brand_id}}" class="inputTotalEndOld inputTotalEndOld-{{$item->id}}" value="">
                                </td>
                                <td>
                                    <span class="totalTest totalTest-{{$item->id}}"></span>
                                    <input class="inputTotalTest inputTotalTest-{{$item->id}}" type="hidden" value="0">
                                </td>
                                <td>
                                    <span class="totalAdd totalAdd-{{$item->id}}"></span>
                                    <input class="inputTotalAdd inputTotalAdd-{{$item->id}}" type="hidden" value="0">
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('brand.backend.out-list.history')
</div>
<input type="hidden" name="dateEndUpdate" value="<?php echo $date_end ?>">
<script>
    var availableTags = [
        <?php if (!empty($products)) {
            foreach ($products as $key => $item) { ?> {
                    slug: "<?php echo $item->slug ?>",
                    title: "<?php echo $item->title ?>"
                },
            <?php } ?>
        <?php } ?>
    ];
</script>