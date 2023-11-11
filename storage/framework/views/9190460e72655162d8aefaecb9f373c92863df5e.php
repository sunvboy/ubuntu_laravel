 <div class="card">

     <div class="card-header">

         <div class="d-flex">

             <h5 class="card-title flex-grow-1 mb-0">Thông tin khách hàng</h5>

         </div>

     </div>

     <div class="card-body">

         <ul class="list-unstyled mb-0 vstack gap-3">

             <li>

                 <div class="d-flex align-items-center">

                     <div class="flex-shrink-0">

                         <img src="<?php echo e(asset('backend/assets/images/users/avatar-3.jpg')); ?>" alt="" class="avatar-sm rounded">

                     </div>

                     <div class="flex-grow-1 ms-3">

                         <h6 class="fs-14 mb-1"><?php echo e($customer->name); ?></h6>

                         <p class="text-muted mb-0"><?php echo e($customer->code); ?></p>

                     </div>

                 </div>

             </li>

             <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i> <?php echo e($customer->phone); ?></li>

             <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i> <?php echo e($customer->email); ?></li>

         </ul>

     </div>

 </div>

 <!--end card-->

 <?php if(!empty($customer->customer_addresses) && count($customer->customer_addresses) > 0): ?>

 <div class="card">

     <div class="card-header">

         <h5 class="card-title mb-0 d-flex align-items-center">

             <span>Địa chỉ giao hàng</span>

         </h5>

     </div>

     <div class="card-body">

         <div class="row gy-3">

             <?php $__currentLoopData = $customer->customer_addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

             <div class="col-lg-4 col-sm-6">

                 <div class="form-check card-radio">

                     <input id="shippingAddress<?php echo e($item->id); ?>" value="<?php echo e($item->id); ?>" name="customer_addresses_id" type="radio" class="form-check-input" <?php if(!empty($item->publish)): ?> checked="" <?php endif; ?>>

                     <label class="form-check-label" for="shippingAddress<?php echo e($item->id); ?>">

                         <span class="fs-14 mb-2 d-block"><?php echo e($item->name); ?></span>

                         <span class="text-muted fw-normal text-wrap mb-1 d-block" style="height: 42px;"><?php echo e($item->address); ?></span>

                         <span class="text-muted fw-normal d-block"><?php echo e($item->phone); ?></span>

                     </label>

                 </div>

             </div>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

         </div>

     </div>

 </div>

 <!--end card-->

 <?php endif; ?>

 <div class="card">

     <div class="card-body">

         <div>

             <div class="table-responsive table-card">

                 <table class="table align-middle" style="margin-bottom: 0;">

                     <thead class="text-muted">

                         <tr>

                             <th>

                                 STT

                             </th>

                             <th>

                                 Tên sản phẩm

                             </th>

                             <th>

                                 Nhà cung cấp

                             </th>

                             <th>

                                 Đơn giá

                             </th>

                             <th>

                                 Số lượng

                             </th>

                             <th>

                                 Thành tiền

                             </th>

                             <th>

                                 Ghi chú

                             </th>

                         </tr>

                     </thead>

                     <tbody class="list form-check-all" id="invoice-list-data">



                         <?php if(!empty($products)): ?>

                         <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                         <?php

                            $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' =>

                            $item['price_contact']));

                            if (!empty($item->product_customer_price_items)) {

                                $priceShow = number_format($item->product_customer_price_items->price, '0', ',', '.') . 'đ';

                                $priceNonFormat = floor($item->product_customer_price_items->price);
                            } else {

                                $priceShow =  $price['price_final'];

                                $priceNonFormat = $price['price_final_none_format'];
                            }

                            $quantity = 0;
                            $description = '';
                            $amount = 0;

                            if (!empty($item->cart_items)) {

                                $quantity = (!empty($item->cart_items->quantity) ? $item->cart_items->quantity : 0) + (!empty($item->cart_items->quantity_add) ? $item->cart_items->quantity_add : 0);

                                $description = $item->cart_items->description;

                                $amount = $item->cart_items->amount;
                            }

                            ?>

                         <tr>

                             <td>

                                 <?php echo e($key+1); ?>


                             </td>

                             <td class="customer_name">

                                 <div class="d-flex align-items-center">

                                     <img src="<?php echo e(asset($item->image)); ?>" alt="" class="avatar-xs rounded-circle me-2">

                                     <a href="<?php echo e(route('products.edit',['id' => $item->id])); ?>" target="_blank">

                                         <?php echo e($item->title); ?>


                                     </a>

                                 </div>

                             </td>

                             <td class="Deutsch"> <?php echo e(!empty($item->brand)?$item->brand->title:''); ?></td>

                             <td class="invoice_amount">

                                 <?php echo e($priceShow); ?>


                             </td>

                             <td>

                                 <div class="d-flex align-items-center">

                                     <div class="menge input-step">
                                         <?php if (!empty($detail) && $detail->date_end == $dateEnd) { ?>

                                             <button type="button" class="minus" data-price="<?php echo e($priceNonFormat); ?>" data-id="<?php echo e($item->id); ?>">–</button>
                                         <?php } ?>

                                         <input name="quantity[<?php echo e($item->id); ?>][]" type="text" class="product-quantity product-quantity-<?php echo e($item->id); ?> floatCustom" value="<?php echo e($quantity); ?>" data-price="<?php echo e($priceNonFormat); ?>" data-id="<?php echo e($item->id); ?>" <?php if (!empty($detail) && $detail->date_end != $dateEnd) { ?> disabled <?php } ?>>

                                         <input name="quantity_old[<?php echo e($item->id); ?>][]" type="hidden" value="<?php echo e(!empty($item->cart_items->quantity_add) ? $item->cart_items->quantity_add : 0); ?>">
                                         <?php if (!empty($detail) && $detail->date_end == $dateEnd) { ?>
                                             <button type="button" class="plus" data-price="<?php echo e($priceNonFormat); ?>" data-id="<?php echo e($item->id); ?>">+</button>
                                         <?php } ?>

                                     </div>

                                     <span class="ms-1"><?php echo e($item->unit); ?></span>

                                 </div>

                             </td>

                             <td class="gesamt price-<?php echo e($item->id); ?>"><?php echo e(number_format($amount,'0',',','.')); ?>đ</td>

                             <td class="date">
                                 <?php if (!empty($detail) && $detail->date_end != $dateEnd) { ?>
                                     <?php echo $description ?>
                                 <?php } else { ?>
                                     <?php echo Form::text('description[' . $item->id . '][]', $description, ['class' => 'form-control']); ?>
                                 <?php } ?>
                                 <input type="hidden" value="<?php echo e($amount); ?>" name="amount[<?php echo e($item->id); ?>][]" class="value-price value-price-<?php echo e($item->id); ?>">
                                 <input type="hidden" value="<?php echo e($priceNonFormat); ?>" name="price[<?php echo e($item->id); ?>][]">
                                 <input type="hidden" value="<?php echo e(!empty($item->cart_items)?$item->cart_items->id : ''); ?>" name="cart_items_ids[]">
                             </td>

                         </tr>

                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         <?php endif; ?>

                     </tbody>

                 </table>

             </div>

         </div>

     </div>

 </div><?php /**PATH D:\xampp\htdocs\order.local\resources\views/cart/backend/common/info-customer.blade.php ENDPATH**/ ?>