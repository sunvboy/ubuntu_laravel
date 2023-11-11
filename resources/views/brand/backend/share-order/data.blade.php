 <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-secondary" id="accordionBordered">
     @if(!empty($cart_items))
     @foreach($cart_items as $key=>$item)
     <div class="accordion-item mt-2">
         <h2 class="accordion-header" id="accordionborderedExample2">
             <button class="accordion-button collapsed fw-bold fs-4" type="button">
                 {{$key}} <span class="text-danger">&nbsp;(Tổng = <?php
                                                                    $total = 0;
                                                                    foreach ($item as $val) {
                                                                        $total += (!empty($val->quantity) ? $val->quantity : 0) + (!empty($val->quantity_add) ? $val->quantity_add : 0);
                                                                    }
                                                                    echo $total;
                                                                    ?>)</span>
             </button>
         </h2>
         <div class="accordion-collapse ">
             <div class="accordion-body">
                 <div class="table-responsive mt-4 mt-xl-0">
                     <table class="table table-success table-striped table-nowrap align-middle mb-0" style="width: auto;">
                         <thead>
                             <tr>
                                 <td class="fw-bold px-3">Tên khách hàng</td>
                                 @foreach($item as $val)
                                 <td class="fw-bold px-3">{{!empty($val->carts)?$val->carts->customer->code:''}}</td>
                                 @endforeach
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td class="col fw-bold px-3">Số lượng</td>
                                 @foreach($item as $val)
                                 <td class="fw-medium px-3 text-center">{{(!empty($val->quantity)?$val->quantity:0) + (!empty($val->quantity_add)?$val->quantity_add:0)}}</td>
                                 @endforeach
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
     @endforeach
     @endif

 </div>