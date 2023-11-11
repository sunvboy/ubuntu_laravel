<?php $__env->startSection('content'); ?>
<?php
$today = \Carbon\Carbon::now();
if (config('app.locale') == 'en') {
    $_status = config('cart.status_en');
    $_payment = config('cart.payment_en');
} else if (config('app.locale') == 'tl') {
    $_status = config('cart.status_tl');
    $_payment = config('cart.payment_tl');
} else if (config('app.locale') == 'gm') {
    $_status = config('cart.status_gm');
    $_payment = config('cart.payment_gm');
} else {
    $_status = config('cart.status');
    $_payment = config('cart.payment');
}

?>
<div class="bg-amber-500 bg-sky-500 bg-green-500 bg-red-500 bg-orange-600 hidden"></div>
<nav class=" relative w-full flex flex-wrap items-center justify-between py-2 bg-[#f9f9f9] text-gray-500 hover:text-gray-700 focus:text-gray-700 navbar navbar-expand-lg navbar-light">
    <div class="container px-4 mx-auto w-full flex flex-wrap items-center justify-between">
        <nav class="bg-grey-light w-full" aria-label="breadcrumb">
            <ol class="list-reset flex">
                <li><a href="<?php echo url('') ?>" class="text-gray-500 hover:text-gray-600 text-f13"><?php echo e(trans('index.home')); ?></a></li>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li><a href="javascript:void(0)" class="text-gray-500 hover:text-gray-600 text-f13"><?php echo e(trans('index.PurchaseHistory')); ?></a></li>
            </ol>
        </nav>
    </div>
</nav>
<main class="">
    <div class="container px-4 mx-auto">
        <div class="mt-4 flex flex-col md:flex-row items-start md:space-x-4">
            <?php echo $__env->make('customer/frontend/auth/common/sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="flex-1 w-full md:w-auto order-1 md:order-1">
                <div class="overflow-x-hidden  rounded-xl md:p-6 space-y-4">
                    <div class=" bg-white">
                        <h1 class="text-black font-bold text-xl"><?php echo e(trans('index.PurchaseHistory')); ?></h1>
                        <!-- Slider main container -->
                        <?php if($data): ?>
                        <div class="mt-5 space-y-2">
                            <div class="flex flex-wrap md:flex-nowrap">
                                <a href="<?php echo e(route('customer.orders')); ?>" class="menu_order flex-auto text-center font-medium hover:text-red-500 mb-5 mr-5 md:mb-0 md:mr-0"><?php echo e(trans('index.All')); ?></a>
                                <?php $__currentLoopData = config('cart.status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('customer.orders',['status' => $key])); ?>" class="menu_order flex-auto text-center font-medium hover:text-red-500 mb-5 mr-5 md:mb-0 md:mr-0 <?php if(request()->get('status') == $key): ?> active <?php endif; ?>">
                                    <?php echo $_status[$key] ?>
                                </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="">
                                <form method="GET" action="" class="relative flex space-x-2">
                                    <input class="rounded-lg border h-11 flex-1 px-3 focus:outline-none hover:outline-none" placeholder="" name="date" value="<?php echo e(request()->get('date')); ?>">
                                    <input class="hidden" type="hidden" value="<?php echo e(request()->get('status')); ?>" name="status">
                                    <button type="submit" class="w-[100px] h-11 bg-red-600 text-white px-3 rounded-lg">
                                        <?php echo e(trans('index.Search')); ?>

                                    </button>
                                </form>
                            </div>
                            <div class="listItem">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $edited_at =  Carbon\Carbon::parse($item->edited_at); ?>
                                <?php $cart = json_decode($item->cart, TRUE); ?>
                                <div class="itemCart mb-5 shadow p-2">
                                    <div class="flex md:items-center flex-col md:flex-row justify-between border-b pb-2">
                                        <div>
                                            <b>#<?php echo e($item->code); ?></b>
                                            <span class="text-xs"><?php echo e(trans('index.BookingDate')); ?>: <?php echo e($item->created_at); ?></span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <span class="text-white font-bold rounded-xl p-1 text-xs <?php echo config('cart.class')[$item->status] ?>">
                                                #<?php echo e($_status[$item->status]); ?>

                                            </span>
                                            <?php if($item->status == 'returns'): ?>
                                            <?php if(!empty($item->order_returns->status) == 1): ?>
                                            <span class="text-white font-bold rounded-xl p-1 text-xs bg-green-500">
                                                #<?php echo e(trans('index.SuccessApproved')); ?>

                                            </span>
                                            <?php else: ?>
                                            <span class="text-white font-bold rounded-xl p-1 text-xs bg-red-500">
                                                #<?php echo e(trans('index.PendingApproved')); ?>

                                            </span>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <?php $total = 0 ?>
                                        <?php if($cart): ?>
                                        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                        $slug = !empty($val['slug']) ? $val['slug'] : '';
                                        $options = !empty($val['options']['title_version']) ?  $val['options']['title_version'] : '';
                                        $unit = !empty($val['unit']) ? $val['unit'] : '';
                                        ?>
                                        <div class="grid grid-cols-5 mb-3 items-center">
                                            <div class="col-span-4">
                                                <div class="flex">
                                                    <div>
                                                        <a href="<?php echo e(route('routerURL',['slug' => $slug])); ?>" target="_blank"><img src="<?php echo e(asset($val['image'])); ?>" alt="<?php echo e($val['title']); ?>" class="w-20 h-20 object-cover"></a>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p><a class="font-semibold text-blue-500" href="<?php echo e(route('routerURL',['slug' => $slug])); ?>" target="_blank"><?php echo e($val['title']); ?></a></p>
                                                        <?php if($options): ?>
                                                        <p class="text-sm"><?php echo e(trans('index.Classify')); ?>: <?php echo e($options); ?></p>
                                                        <?php endif; ?>
                                                        <p class="text-sm"><?php echo e(trans('index.Amount')); ?>: x <?php echo e($val['quantity']); ?> <?php echo e($unit); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-1 flex justify-end">
                                                <span class="font-bold"><?php echo e(number_format($val['price'],0,',','.')); ?>₫</span>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="bg-[#f3eedf67] py-2 float-left w-full">
                                        <div class="p-2">
                                            <div class="flex justify-between flex-col md:flex-row">
                                                <div class="text-sm"><?php echo e(trans('index.PaymentMethods')); ?>: <?php echo e($_payment[$item->payment]); ?></div>
                                                <div class="flex flex-col">
                                                    <?php if($item->payment == 'wallet'): ?>
                                                    <div class="flex justify-between">
                                                        <?php echo e(trans('index.TotalAmount')); ?>:
                                                        <span class=""><?php echo number_format($item->total_price - $item->total_price_coupon + $item->fee_ship); ?>₫</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <?php echo e(trans('index.Paid')); ?>:<span class=""><?php echo number_format($item->wallet); ?>₫</span>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="flex justify-between">
                                                        <?php echo e(trans('index.TotalMoneyPayment')); ?>:<span class="text-red-500 font-bold"><?php echo number_format($item->total_price - $item->total_price_coupon + $item->fee_ship - $item->wallet); ?>₫</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3 flex space-x-2 justify-between md:justify-end">
                                                <a href="<?php echo e(route('customer.detailOrder',['id' => $item->id])); ?>" class="text-xs float-right font-bold h-9 leading-9  text-black bg-gray-300 cursor-pointer items-center rounded-md px-3"><?php echo e(trans('index.ViewMore')); ?></a>
                                                <a href="<?php echo e(route('customer.copyOrder',['id' => $item->id])); ?>" class="text-xs float-right font-bold h-9 leading-9  text-white bg-green-600 cursor-pointer items-center rounded-md px-3"><?php echo e(trans('index.Repurchase')); ?></a>
                                                <?php if ($today >= $item->created_at && $today < $edited_at && $item->status == 'wait') { ?>
                                                    <a href="<?php echo e(route('customer.editOrder',['id' => $item->id])); ?>" class="text-xs float-right font-bold h-9 leading-9  text-white bg-orange-400 cursor-pointer items-center rounded-md px-3"><?php echo e(trans('index.Edit')); ?></a>
                                                    <a href="javascript:void(0)" class="text-xs float-right font-bold h-9 leading-9  text-white bg-global cursor-pointer items-center rounded-md px-3 js_delete_customer_cart" data-id="<?php echo e($item->id); ?>"><?php echo e(trans('index.DeleteCart')); ?></a>
                                                <?php } ?>
                                                <?php if($item->status == 'completed'): ?>
                                                <a href="javascript:void(0)" onclick="showModalOrderReturn(<?php echo e($item->id); ?>)" class="text-xs float-right font-bold h-9 leading-9  text-white bg-orange-400 cursor-pointer items-center rounded-md px-3"><?php echo e(trans('index.ToReturn')); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex justify-center">
                                    <?php echo $data->links() ?>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="flex flex-col items-center ml-4  bg-white  rounded-xl mt-4 space-y-3">
                            <div class="bg-gray-100 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-global" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <strong class="font-bold mb-2"><?php echo e(trans('index.NoOrdersYet')); ?></strong>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('library/daterangepicker/moment.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('library/daterangepicker/daterangepicker.min.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('library/daterangepicker/daterangepicker.css')); ?>">
<script type="text/javascript">
    $(function() {
        $('input[name="date"]').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                separator: " to "
            }
        });
    });
</script>
<link href="<?php echo e(asset('library/sweetalert/sweetalert.css')); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo e(asset('library/sweetalert/sweetalert.min.js')); ?>"></script>
<style>
    .menu_order.active {
        border-bottom: 1px solid red;
        color: red;
        font-weight: bold;
    }
</style>
<script>
    var aurl = window.location.href; // Get the absolute url
    $('.menu_order').filter(function() {
        return $(this).prop('href') === aurl;
    }).addClass('active');
    $(".menu_item_auth:eq(2)").addClass('active');
    $(document).on('click', '.js_delete_customer_cart', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        swal({
                title: "<?php echo trans('index.AreYouSure') ?>",
                text: '',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo trans('index.Perform') ?>",
                cancelButtonText: "<?php echo trans('index.Cancel') ?>",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(isConfirm) {
                if (isConfirm) {
                    let formURL = "<?php echo route('customer.deleteOrder') ?>";
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        url: formURL,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data.status === 200) {
                                swal({
                                    title: "<?php echo trans('index.DeleteSuccessfully') ?>",
                                    text: "<?php echo trans('index.DeleteSuccessfullyInfo') ?>",
                                    type: "success"
                                }, function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: "<?php echo trans('index.DeleteSuccessfullyInfo2') ?>",
                                    text: "<?php echo trans('index.DeleteSuccessfullyInfo3') ?>",
                                    type: "error"
                                }, function() {
                                    location.reload();
                                });
                            }
                        },
                        error: function(jqXhr, json, errorThrown) {
                            var errors = jqXhr.responseJSON;
                            var errorsHtml = "";
                            $.each(errors["errors"], function(index, value) {
                                errorsHtml += value + "/ ";
                            });
                            console.log(errorsHtml)
                        },
                    });
                } else {
                    swal({
                        title: "<?php echo trans('index.Cancel') ?>",
                        text: "<?php echo trans('index.CancelInfo') ?>",
                        type: "error"
                    }, function() {
                        location.reload();
                    });
                }
            }
        );
    })
</script>
<?php echo $__env->make('customer.frontend.order.return', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/customer/frontend/order/index.blade.php ENDPATH**/ ?>