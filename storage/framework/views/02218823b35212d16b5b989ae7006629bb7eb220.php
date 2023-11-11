<div class="offcanvas-overlay fixed inset-0 bg-black opacity-50 z-50 hidden"></div>
<div id="offcanvas-cart" class="offcanvas left-auto right-0 transform fixed font-normal text-sm top-0 z-50 h-screen w-80 lg:w-96 transition-all ease-in-out duration-300 bg-white overflow-y-auto hidden animated fadeInRight">
    <div class="p-8">
        <div class="flex flex-wrap justify-between items-center pb-6 mb-6 border-b border-solid border-gray-600">
            <h4 class="font-normal text-xl"><?php echo e(trans('index.Cart')); ?></h4>
            <button class="offcanvas-close hover:text-green-500">
                <svg class="w-4 h-4 " viewBox="0 0 16 14">
                    <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div id="cart-show-header" <?php if (empty($cart['cart'])) { ?> style="display: none" <?php } ?>>
            <ul class="h-96 overflow-y-auto cart-html-header scrollbar max-h-screen">
                <?php if(isset($cart['cart']) && is_array($cart['cart']) && count($cart['cart']) > 0 ): ?>
                <?php $__currentLoopData = $cart['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                echo htmlItemCartHeader($k, $item);
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
            <div>
                <div class="flex flex-wrap justify-between items-center py-4 my-6 border-t border-b border-solid border-gray-600 font-normal text-base text-dark capitalize">
                    <?php echo e(trans('index.TotalPrice')); ?>:<span class="cart-total"><?php echo !empty($cart['total']) ? number_format($cart['total'], 0, ',', '.') . '₫' : '' ?></span>
                </div>
                <div class="text-center">
                    <a class="py-5 px-10 block bg-white border border-solid border-gray-600 uppercase font-semibold text-base hover:bg-red-600 hover:border-red-600 hover:text-white transition-all leading-none" href="<?php echo e(route('cart.index')); ?>"><?php echo e(trans('index.Cart')); ?></a>

                    <a class="py-5 px-10 block bg-white border border-solid border-gray-600 uppercase font-semibold text-base hover:bg-red-600 hover:border-red-600  hover:text-white transition-all leading-none  mt-3" href="<?php echo e(route('cart.checkout')); ?>"><?php echo e(trans('index.Pay')); ?></a>
                </div>
            </div>
        </div>
        <div id="cart-none-header" <?php if (!empty($cart['cart'])) { ?> style="display: none" <?php } ?>>
            <div class="flex flex-col items-center justify-center space-y-4">
                <svg width="100" height="100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-gray-400">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.79166 2H1V4H4.2184L6.9872 16.6776H7V17H20V16.7519L22.1932 7.09095L22.5308 6H6.6552L6.08485 3.38852L5.79166 2ZM19.9869 8H7.092L8.62081 15H18.3978L19.9869 8Z" fill="currentColor" />
                    <path d="M10 22C11.1046 22 12 21.1046 12 20C12 18.8954 11.1046 18 10 18C8.89543 18 8 18.8954 8 20C8 21.1046 8.89543 22 10 22Z" fill="currentColor" />
                    <path d="M19 20C19 21.1046 18.1046 22 17 22C15.8954 22 15 21.1046 15 20C15 18.8954 15.8954 18 17 18C18.1046 18 19 18.8954 19 20Z" fill="currentColor" />
                </svg>
                <span class="block text-xl font-bold text-gray-400"><?php echo e(trans('index.ThereAreNo')); ?></span>

            </div>
        </div>
    </div>
</div>
<!-- functions tp -->
<script src="<?php echo e(asset('library/toastr/toastr.min.js')); ?>"></script>
<link href="<?php echo e(asset('library/toastr/toastr.min.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('frontend/library/js/products.js')); ?>"></script>
<!-- end --><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/homepage/common/cart.blade.php ENDPATH**/ ?>