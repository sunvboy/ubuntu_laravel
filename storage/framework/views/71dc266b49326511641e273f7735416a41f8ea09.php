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
                                  <?php if(!empty($customers)): ?>
                                  <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <td class="text-uppercase itemCustomer <?php echo e($customer->code); ?>"><?php echo e($customer->code); ?></td>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
                                  <td style="color: #fff;font-weight: bold;background: #e26b0a;text-align: center;">
                                      Đặt hàng<br>
                                      = <span class="totalQuantityOrderSuccess"><?php echo e($totalQuantity); ?></span>
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
                                  <?php if(!empty($brands)): ?>
                                  <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <td style="color: #fff;font-weight: bold;background: #e26b0a;text-align: center;">
                                      <?php /*{{$brand->title}} = {{!empty($brand->brand_product_carts)?$brand->brand_product_carts->sum('quantity')-$brand->brand_product_carts->sum('inventory'):0}}<br>
                                      Mặt hàng = {{!empty($brand->brand_product_carts)?$brand->brand_product_carts->count():0}}*/ ?>

                                      <?php echo e($brand->title); ?> = <span class="quantityOfBrand-<?php echo e($brand->id); ?>"></span><br>
                                      Mặt hàng = <span class="countOfBrand-<?php echo e($brand->id); ?>"></span>
                                  </td>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
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
                              <?php if($products): ?>
                              <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php $totalCustomer = $totalBrand = $totalCustomerOld = 0; ?>
                              <tr>
                                  <td><?php echo e($key+1); ?></td>
                                  <td><?php echo e($item->title); ?></td>
                                  <?php if(!empty($customers)): ?>
                                  <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <td class="text-uppercase customerQuantity itemCustomer <?php echo e($customer->code); ?>" data-product-id="<?php echo e($item->id); ?>" data-customer-id="<?php echo e($customer->id); ?>">
                                      <?php if(!empty($customer->carts) && !empty($customer->carts->cart_items)): ?>
                                      <?php
                                        $checks = $customer->carts->cart_items;
                                        ?>
                                      <?php $__currentLoopData = $checks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kc=>$check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php if($check->product_id == $item->id): ?>
                                      <?php
                                        $totalCustomer += (float)$check->quantity + (float)$check->quantity_add;
                                        $totalCustomerOld += (float)$check->quantity;
                                        ?>
                                      <input style="border:0px;background: gray;width: 50px;color:white" class="quantityCustomer quantityCustomer-<?php echo e($item->id); ?>" value="<?php echo e((float)$check->quantity+(float)$check->quantity_add); ?>" data-product-id="<?php echo e($item->id); ?>" data-customer-id="<?php echo e($customer->id); ?>">
                                      <input type="hidden" class="quantityCustomerOld quantityCustomerOld-<?php echo e($item->id); ?>" value="<?php echo e((float)$totalCustomerOld); ?>" data-product-id="<?php echo e($item->id); ?>" data-customer-id="<?php echo e($customer->id); ?>">
                                      <?php endif; ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                  </td>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
                                  <!-- Đặt hàng -->
                                  <td style="font-size: 16px;font-weight: bold;text-align: center; ">
                                      <span class="totalCustomer totalCustomer-<?php echo e($item->id); ?>"><?php echo e(!empty($totalCustomer)?$totalCustomer:''); ?></span>
                                      <input type="hidden" value="<?php echo e($totalCustomer); ?>" class="inputTotalCustomer inputTotalCustomer-<?php echo e($item->id); ?>">
                                      <input type="hidden" value="<?php echo e($totalCustomerOld); ?>" class="inputTotalCustomerOld inputTotalCustomerOld-<?php echo e($item->id); ?>">
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
                                      <span class="excess excess-<?php echo e($item->id); ?>"><?php echo e(!empty($totalExcess)?$totalExcess:''); ?></span>
                                      <input type="hidden" value="<?php echo e($totalExcess); ?>" class="inputExcess inputExcess-<?php echo e($item->id); ?>" data-id="<?php echo e($item->id); ?>">
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
                                  <td style="text-align: center" class="input_quantity_add input_quantity_add_<?php echo e($item->id); ?>"><?php echo e(!empty($quantity_add)?$quantity_add:''); ?></td>
                                  <td style="text-align: center" class="input_quantity_test input_quantity_test_<?php echo e($item->id); ?>"><?php echo e(!empty($quantity_test)?$quantity_test:''); ?></td>
                                  <!--END-->
                                  <?php if(!empty($brands)): ?>
                                  <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <td>
                                      <div class="brandTitleQuantityItem-<?php echo e($brand->id); ?>">
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
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
                                  <!-- Kho hàng -->
                                  <td style="text-align: center">
                                      <span class="inventoryQuantityItem-<?php echo e($item->id); ?>">
                                          <?php echo e(!empty($inventoryQuantityItem)?$inventoryQuantityItem:''); ?>

                                      </span>
                                      <input value="<?php echo e($inventoryQuantityItem); ?>" type="hidden" class="inventoryQuantity inventoryQuantity-<?php echo e($item->id); ?>">
                                  </td>
                                  <!-- END-->
                                  <td class="status status-<?php echo e($item->id); ?>">
                                  </td>
                              </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                          </tbody>
                      </table>
                  </div>
                  <div class="pseduo-track"></div>
              </div>
          </div>
      </div>
      <?php if(!empty($histories) && count($histories) > 0): ?>
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
                      <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="accordion-item border-0">
                          <div class="accordion-header" id="heading<?php echo e($item->id); ?>">
                              <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse<?php echo e($item->id); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($item->id); ?>">
                                  <div class="d-flex align-items-center">
                                      <div class="flex-shrink-0 avatar-xs">
                                          <div class="avatar-title bg-success rounded-circle">
                                              <i class="ri-shopping-bag-line"></i>
                                          </div>
                                      </div>
                                      <div class="flex-grow-1 ms-3">
                                          <h6 class="fs-15 mb-0 fw-semibold">Người sửa <?php echo e(!empty($item->user)?$item->user->name:''); ?> - <span class="fw-normal"><?php echo e($item->created_at); ?></span></h6>
                                          <h6 class="fs-15 mb-0 fw-semibold">Khách hàng <span class="text-danger"><?php echo e($item->customer->code); ?>-<?php echo e($item->customer->name); ?></span></h6>
                                      </div>
                                  </div>
                              </a>
                          </div>
                          <div id="collapse<?php echo e($item->id); ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?php echo e($item->id); ?>" data-bs-parent="#accordionExample">
                              <div class="accordion-body ms-2 ps-5 pt-0">
                                  <div class="mb-1"><?php echo $item->note; ?></div>
                              </div>
                          </div>
                      </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <!--end accordion-->
              </div>
          </div>
      </div>
      <?php endif; ?>
  </div>
  <input type="hidden" name="dateEndUpdate" value="<?php echo $date_end ?>"><?php /**PATH D:\xampp\htdocs\order.local\resources\views/brand/backend/list-order/data.blade.php ENDPATH**/ ?>