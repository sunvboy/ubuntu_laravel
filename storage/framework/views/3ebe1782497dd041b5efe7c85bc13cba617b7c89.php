 <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-secondary" id="accordionBordered">
     <?php if(!empty($cart_items)): ?>
     <?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <div class="accordion-item mt-2">
         <h2 class="accordion-header" id="accordionborderedExample2">
             <button class="accordion-button collapsed fw-bold fs-4" type="button">
                 <?php echo e($key); ?> <span class="text-danger">&nbsp;(Tổng = <?php
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
                                 <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <td class="fw-bold px-3"><?php echo e(!empty($val->carts)?$val->carts->customer->code:''); ?></td>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td class="col fw-bold px-3">Số lượng</td>
                                 <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <td class="fw-medium px-3 text-center"><?php echo e((!empty($val->quantity)?$val->quantity:0) + (!empty($val->quantity_add)?$val->quantity_add:0)); ?></td>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <?php endif; ?>

 </div><?php /**PATH D:\xampp\htdocs\order.local\resources\views/brand/backend/share-order/data.blade.php ENDPATH**/ ?>