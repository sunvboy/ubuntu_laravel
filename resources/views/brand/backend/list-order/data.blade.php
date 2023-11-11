  <div class="col-lg-12">
      <div class="card" id="invoiceList">
          <div class="card-body card-body-22">
              <div class="p-2">
                  <div class="table-responsive table-card outer-wrapper">
                      <table class="table align-middle table-nowrap" style="margin-bottom: 0" id="invoiceTable">
                          <thead class="text-muted">
                              <tr>
                                  <td class="text-uppercase">MKH</td>
                                  <td class="text-uppercase">Tên Hàng</td>
                                  <?php
                                    $totalOrder = 0;
                                    ?>
                                  @if(!empty($customers))
                                  @foreach($customers as $customer)
                                  <td class="text-uppercase itemCustomer {{$customer->code}}">{{$customer->code}}</td>
                                  @endforeach
                                  @endif
                                  <td style="color: #fff;font-weight: bold;background: #e26b0a;text-align: center;">
                                      Đặt hàng<br>
                                      = <span class="totalQuantityOrderSuccess">{{$totalQuantity}}</span>
                                  </td>
                                  <td style="color: #ffff00;font-weight: bold;background: #808080;text-align: center;">
                                      Thừa/Thiếu<br>
                                      = <span class="totalExcess"></span>
                                      <input type="hidden" name="" class="inputTotalExcess" value="">
                                  </td>
                                  <td style="color: #ffff00;font-weight: bold;background: #808080;text-align: center;">
                                      Đặt thêm<br>
                                      = <span class="totalAdd"></span>
                                      <input type="hidden" name="" class="inputTotalAdd" value="">
                                  </td>
                                  <td style="color: #ffff00;font-weight: bold;background: #808080;text-align: center;">
                                      Đặt thử<br>
                                      = <span class="totalTest"></span>
                                      <input type="hidden" name="" class="inputTotalTest" value="">
                                  </td>
                                  @if(!empty($brands))
                                  @foreach($brands as $brand)
                                  <td style="color: #fff;font-weight: bold;background: #e26b0a;text-align: center;">
                                      <?php /*{{$brand->title}} = {{!empty($brand->brand_product_carts)?$brand->brand_product_carts->sum('quantity')-$brand->brand_product_carts->sum('inventory'):0}}<br>
                                      Mặt hàng = {{!empty($brand->brand_product_carts)?$brand->brand_product_carts->count():0}}*/ ?>

                                      {{$brand->title}} = <span class="quantityOfBrand-{{$brand->id}}"></span><br>
                                      Mặt hàng = <span class="countOfBrand-{{$brand->id}}"></span>
                                  </td>
                                  @endforeach
                                  @endif
                                  <td style="color: #fff;font-weight: bold;background: #e26b0a;text-align: center;">
                                      <?php /* Kho = {{ $inventoryQuantity}}<br>
                                      Mặt hàng = {{$inventoryQuantityCount}}*/ ?>
                                      Kho = <span class="inventoryQuantity"></span><br>
                                      Mặt hàng = <span class="inventoryCount"></span>
                                  </td>
                                  <td style="color: #ff0000; text-align: center">
                                      So Sánh
                                  </td>
                              </tr>
                          </thead>
                          <tbody class="list form-check-all">
                              @if($products)
                              @foreach($products as $key=>$item)
                              <?php $totalCustomer = $totalBrand = $totalCustomerOld = 0; ?>
                              <tr>
                                  <td>{{$key+1}}</td>
                                  <td>{{$item->title}}</td>
                                  @if(!empty($customers))
                                  @foreach($customers as $customer)
                                  <td class="text-uppercase customerQuantity itemCustomer {{$customer->code}}" data-product-id="{{$item->id}}" data-customer-id="{{$customer->id}}">
                                      @if(!empty($customer->carts) && !empty($customer->carts->cart_items))
                                      <?php
                                        $checks = $customer->carts->cart_items;
                                        ?>
                                      @foreach($checks as $kc=>$check)
                                      @if($check->product_id == $item->id)
                                      <?php
                                        $totalCustomer += (float)$check->quantity + (float)$check->quantity_add;
                                        $totalCustomerOld += (float)$check->quantity;
                                        ?>
                                      <input style="border:0px;background: gray;width: 50px;color:white" class="quantityCustomer quantityCustomer-{{$item->id}}" value="{{(float)$check->quantity+(float)$check->quantity_add}}" data-product-id="{{$item->id}}" data-customer-id="{{$customer->id}}">
                                      <input type="hidden" class="quantityCustomerOld quantityCustomerOld-{{$item->id}}" value="{{(float)$totalCustomerOld}}" data-product-id="{{$item->id}}" data-customer-id="{{$customer->id}}">
                                      @endif
                                      @endforeach
                                      @endif
                                  </td>
                                  @endforeach
                                  @endif
                                  <!-- Đặt hàng -->
                                  <td style="font-size: 16px;font-weight: bold;text-align: center; ">
                                      <span class="totalCustomer totalCustomer-{{$item->id}}">{{!empty($totalCustomer)?$totalCustomer:''}}</span>
                                      <input type="hidden" value="{{$totalCustomer}}" class="inputTotalCustomer inputTotalCustomer-{{$item->id}}">
                                      <input type="hidden" value="{{$totalCustomerOld}}" class="inputTotalCustomerOld inputTotalCustomerOld-{{$item->id}}">
                                  </td>
                                  <!-- END -->
                                  <!-- thừa thiếu -->
                                  <?php
                                    $totalExcess =  0;
                                    $quantity_test = !empty($item->brand_product_carts->quantity_test) ? $item->brand_product_carts->quantity_test : 0;
                                    $quantity_add = !empty($item->brand_product_carts->quantity_add) ? $item->brand_product_carts->quantity_add : 0;
                                    $inventoryQuantityItem = !empty($item->brand_product_carts->inventory) ? (float)$item->brand_product_carts->inventory : 0;
                                    if (!empty($inventoryQuantityItem)) {
                                        // if ($inventoryQuantityItem > $totalCustomer) {
                                        //     $totalExcess = ($inventoryQuantityItem - $totalCustomer) + $quantity_test + $quantity_add;
                                        // } else {
                                        //     $totalExcess = ($inventoryQuantityItem - $totalCustomer) + $quantity_test + $quantity_add;
                                        // }
                                        $totalExcess = ($inventoryQuantityItem - $totalCustomer) + $quantity_test + $quantity_add;
                                    } else {
                                        if ($totalCustomer > 0) {
                                            $totalExcess =  0;
                                        } else {
                                            $totalExcess =  $quantity_test + $quantity_add;
                                        }
                                    }
                                    ?>
                                  <td style="text-align: center">
                                      <span class="excess excess-{{$item->id}}">{{!empty($totalExcess)?$totalExcess:'' }}</span>
                                      <input type="hidden" value="{{$totalExcess}}" class="inputExcess inputExcess-{{$item->id}}" data-id="{{$item->id}}">
                                      <?php
                                        /*
                                            @if($totalCustomerOld == $totalCustomer && $inventoryQuantityItem > 0)
                                            <span class="excess excess-{{$item->id}}">{{(float)$inventoryQuantityItem - $totalCustomer + $quantity_add + $quantity_test}}</span>
                                            <input type="hidden" value="{{(float)$inventoryQuantityItem - $totalCustomer + $quantity_add + $quantity_test}}" class="inputExcess inputExcess-{{$item->id}}" data-id="{{$item->id}}">
                                            @else
                                            <span class="excess excess-{{$item->id}}">{{!empty((float)$inventoryQuantityItem - ($totalCustomer-$totalCustomerOld) + $quantity_add + $quantity_test == 0)?'-':(float)$inventoryQuantityItem - ($totalCustomer-$totalCustomerOld) + $quantity_add + $quantity_test}}</span>
                                            <input type="hidden" value="{{(float)$inventoryQuantityItem - ($totalCustomer-$totalCustomerOld)+ $quantity_add + $quantity_test}}" class="inputExcess inputExcess-{{$item->id}}" data-id="{{$item->id}}">
                                            @endif
                                        */
                                        ?>
                                  </td>
                                  <td style="text-align: center" class="input_quantity_add input_quantity_add_{{$item->id}}">{{!empty($quantity_add)?$quantity_add:''}}</td>
                                  <td style="text-align: center" class="input_quantity_test input_quantity_test_{{$item->id}}">{{!empty($quantity_test)?$quantity_test:''}}</td>
                                  <!--END-->
                                  @if(!empty($brands))
                                  @foreach($brands as $brand)
                                  <td>
                                      <div class="brandTitleQuantityItem-{{$brand->id}}">
                                          <?php
                                            $totalBrand = 0;
                                            if (!empty($brand->brand_product_carts)) { ?>
                                              <?php foreach ($brand->brand_product_carts as $key => $s) { ?>
                                                  <?php if ($s->product_id == $item->id) { ?>
                                                      <?php
                                                        if (!empty($s->inventory)) {
                                                            if ((float) $s->inventory >= (float) $s->quantity) {
                                                                $totalBrand = 0;
                                                            } else {
                                                                $totalBrand = ((float) $s->quantity - (float) $s->inventory);
                                                            }
                                                        } else {
                                                            $totalBrand = $s->quantity;
                                                        }
                                                        ?>
                                                  <?php } ?>
                                              <?php } ?>
                                          <?php } ?>
                                          <?php if ($brand->ishome == 1) { ?>
                                              <?php $totalQuantityAdd =  (float)$totalBrand + (!empty($item->brand_product_carts) ? (float)$item->brand_product_carts->quantity_add : 0) ?>
                                              <?php echo !empty($totalQuantityAdd) ? $totalQuantityAdd : ''; ?>
                                          <?php } else if ($brand->highlight == 1) { ?>
                                              <?php $totalQuantityTest = (float)$totalBrand + (!empty($item->brand_product_carts) ? (float)$item->brand_product_carts->quantity_test : 0) ?>
                                              <?php echo !empty($totalQuantityTest) ? $totalQuantityTest : ''; ?>
                                          <?php } else { ?>
                                              <?php echo !empty($totalBrand) ? $totalBrand : ''; ?>
                                          <?php } ?>
                                      </div>
                                  </td>
                                  @endforeach
                                  @endif
                                  <!-- Kho hàng -->
                                  <td style="text-align: center">
                                      <span class="inventoryQuantityItem-{{$item->id}}">
                                          {{!empty($inventoryQuantityItem)?$inventoryQuantityItem:''}}
                                      </span>
                                      <input value="{{$inventoryQuantityItem}}" type="hidden" class="inventoryQuantity inventoryQuantity-{{$item->id}}">
                                  </td>
                                  <!-- END-->
                                  <td class="status status-{{$item->id}}">
                                  </td>
                              </tr>
                              @endforeach
                              @endif
                          </tbody>
                      </table>
                  </div>
                  <div class="pseduo-track"></div>
              </div>
          </div>
      </div>
      @if(!empty($histories) && count($histories) > 0)
      <!--end card-->
      <div class="card">
          <div class="card-header">
              <div class="d-sm-flex align-items-center">
                  <h5 class="card-title flex-grow-1 mb-0">Lịch sử chỉnh sửa</h5>
              </div>
          </div>
          <div class="card-body">
              <div class="profile-timeline">
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                      @foreach($histories as $item)
                      <div class="accordion-item border-0">
                          <div class="accordion-header" id="heading{{$item->id}}">
                              <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                                  <div class="d-flex align-items-center">
                                      <div class="flex-shrink-0 avatar-xs">
                                          <div class="avatar-title bg-success rounded-circle">
                                              <i class="ri-shopping-bag-line"></i>
                                          </div>
                                      </div>
                                      <div class="flex-grow-1 ms-3">
                                          <h6 class="fs-15 mb-0 fw-semibold">Người sửa {{!empty($item->user)?$item->user->name:''}} - <span class="fw-normal">{{$item->created_at}}</span></h6>
                                          <h6 class="fs-15 mb-0 fw-semibold">Khách hàng <span class="text-danger">{{$item->customer->code}}-{{$item->customer->name}}</span></h6>
                                      </div>
                                  </div>
                              </a>
                          </div>
                          <div id="collapse{{$item->id}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$item->id}}" data-bs-parent="#accordionExample">
                              <div class="accordion-body ms-2 ps-5 pt-0">
                                  <div class="mb-1">{!!$item->note!!}</div>
                              </div>
                          </div>
                      </div>
                      @endforeach
                  </div>
                  <!--end accordion-->
              </div>
          </div>
      </div>
      @endif
  </div>
  <input type="hidden" name="dateEndUpdate" value="<?php echo $date_end ?>">