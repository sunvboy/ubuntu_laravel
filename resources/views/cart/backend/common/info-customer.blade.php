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

                         <img src="{{asset('backend/assets/images/users/avatar-3.jpg')}}" alt="" class="avatar-sm rounded">

                     </div>

                     <div class="flex-grow-1 ms-3">

                         <h6 class="fs-14 mb-1">{{$customer->name}}</h6>

                         <p class="text-muted mb-0">{{$customer->code}}</p>

                     </div>

                 </div>

             </li>

             <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i> {{$customer->phone}}</li>

             <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i> {{$customer->email}}</li>

         </ul>

     </div>

 </div>

 <!--end card-->

 @if(!empty($customer->customer_addresses) && count($customer->customer_addresses) > 0)

 <div class="card">

     <div class="card-header">

         <h5 class="card-title mb-0 d-flex align-items-center">

             <span>Địa chỉ giao hàng</span>

         </h5>

     </div>

     <div class="card-body">

         <div class="row gy-3">

             @foreach($customer->customer_addresses as $item)

             <div class="col-lg-4 col-sm-6">

                 <div class="form-check card-radio">

                     <input id="shippingAddress{{$item->id}}" value="{{$item->id}}" name="customer_addresses_id" type="radio" class="form-check-input" @if(!empty($item->publish)) checked="" @endif>

                     <label class="form-check-label" for="shippingAddress{{$item->id}}">

                         <span class="fs-14 mb-2 d-block">{{$item->name}}</span>

                         <span class="text-muted fw-normal text-wrap mb-1 d-block" style="height: 42px;">{{$item->address}}</span>

                         <span class="text-muted fw-normal d-block">{{$item->phone}}</span>

                     </label>

                 </div>

             </div>

             @endforeach

         </div>

     </div>

 </div>

 <!--end card-->

 @endif

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



                         @if(!empty($products))

                         @foreach($products as $key=>$item)

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

                                 {{$key+1}}

                             </td>

                             <td class="customer_name">

                                 <div class="d-flex align-items-center">

                                     <img src="{{asset($item->image)}}" alt="" class="avatar-xs rounded-circle me-2">

                                     <a href="{{route('products.edit',['id' => $item->id])}}" target="_blank">

                                         {{$item->title}}

                                     </a>

                                 </div>

                             </td>

                             <td class="Deutsch"> {{!empty($item->brand)?$item->brand->title:''}}</td>

                             <td class="invoice_amount">

                                 {{$priceShow}}

                             </td>

                             <td>

                                 <div class="d-flex align-items-center">

                                     <div class="menge input-step">
                                         <?php if (!empty($detail) && $detail->date_end == $dateEnd) { ?>

                                             <button type="button" class="minus" data-price="{{$priceNonFormat}}" data-id="{{$item->id}}">–</button>
                                         <?php } ?>

                                         <input name="quantity[{{$item->id}}][]" type="text" class="product-quantity product-quantity-{{$item->id}} floatCustom" value="{{$quantity}}" data-price="{{$priceNonFormat}}" data-id="{{$item->id}}" <?php if (!empty($detail) && $detail->date_end != $dateEnd) { ?> disabled <?php } ?>>

                                         <input name="quantity_old[{{$item->id}}][]" type="hidden" value="{{!empty($item->cart_items->quantity_add) ? $item->cart_items->quantity_add : 0}}">
                                         <?php if (!empty($detail) && $detail->date_end == $dateEnd) { ?>
                                             <button type="button" class="plus" data-price="{{$priceNonFormat}}" data-id="{{$item->id}}">+</button>
                                         <?php } ?>

                                     </div>

                                     <span class="ms-1">{{$item->unit}}</span>

                                 </div>

                             </td>

                             <td class="gesamt price-{{$item->id}}">{{number_format($amount,'0',',','.')}}đ</td>

                             <td class="date">
                                 <?php if (!empty($detail) && $detail->date_end != $dateEnd) { ?>
                                     <?php echo $description ?>
                                 <?php } else { ?>
                                     <?php echo Form::text('description[' . $item->id . '][]', $description, ['class' => 'form-control']); ?>
                                 <?php } ?>
                                 <input type="hidden" value="{{$amount}}" name="amount[{{$item->id}}][]" class="value-price value-price-{{$item->id}}">
                                 <input type="hidden" value="{{$priceNonFormat}}" name="price[{{$item->id}}][]">
                                 <input type="hidden" value="{{!empty($item->cart_items)?$item->cart_items->id : ''}}" name="cart_items_ids[]">
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