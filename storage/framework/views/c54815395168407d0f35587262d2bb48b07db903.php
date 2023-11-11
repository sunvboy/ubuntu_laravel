<?php $__env->startSection('title'); ?>
<title>Danh sách đơn hoàn/trả</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách đơn trả/hoàn hàng",
        "src" => route('orders.index'),
    ]
);
echo breadcrumb_backend($array);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Danh sách đơn hoàn/trả
    </h1>

    <form action="" class="grid grid-cols-12 gap-1 space-x-2  mt-5" id="search" style="margin-bottom: 0px;">

        <?php
        $status = ['0' => 'Trạng thái'];
        $status = array_merge($status, config('cart')['status']);
        ?>
        <div class="col-span-4">
            <?php echo Form::select('customerid', $customers, request()->get('customerid'), ['class' => 'form-control tom-select tom-select-custom tomselected', 'data-placeholder' => "Select your favorite actors"]); ?>
        </div>
        <div class="col-span-2">
            <?php echo Form::select('status', array('' => 'Chọn trạng thái', '0' => 'Đang chờ duyệt', '1' => 'Đã duyệt'), request()->get('status'), ['class' => 'form-control']); ?>
        </div>
        <div class="col-span-3">
            <?php echo Form::text('date', request()->get('date'), ['class' => 'form-control',  'autocomplete' => 'off']); ?>
        </div>
        <div class="col-span-3 flex">
            <input type="search" name="keyword" class="keyword form-control filter w-full mr-1" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="<?php echo request()->get('keyword') ?>">
            <button class="btn btn-primary btn-sm">
                <i data-lucide="search"></i>
            </button>
        </div>
    </form>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Data List -->
        <div class=" col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>

                        <th class="whitespace-nowrap">STT</th>
                        <th class="whitespace-nowrap">Thông tin</th>
                        <th class="whitespace-nowrap">Sản phẩm hoàn/trả</th>
                        <th class="whitespace-nowrap">Tổng tiền hoàn</th>
                        <th class="whitespace-nowrap">Tổng tiền hàng</th>
                        <th class="whitespace-nowrap">Ngày tạo</th>
                        <th class="whitespace-nowrap">Trạng thái</th>
                        <th class="whitespace-nowrap text-center">#</th>
                    </tr>
                </thead>

                <tbody id="table_data" role="alert" aria-live="polite" aria-relevant="all">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    if ($v->status == '0') {
                        $class = 'wait';
                    } else if ($v->status == '1') {
                        $class = 'pending';
                    }
                    ?>
                    <tr class="odd " id="post-<?php echo $v->id; ?>">
                        <td>
                            <?php echo e($data->firstItem()+$loop->index); ?>

                        </td>
                        <td>
                            <a href="<?php echo e(route('orders.edit',['id'=>$v->id])); ?>">
                                <p class="text-danger font-bold"><b>CODE:</b> #<?php echo $v->code; ?></p>
                                <p><?php echo $v->fullname; ?></p>
                                <p><?php echo $v->phone; ?></p>
                                <p><?php echo $v->address; ?></p>
                                <p><?php echo $v->email; ?></p>
                                <p class="text-primary"><?php echo config('cart')['payment'][$v->payment] ?></p>
                            </a>
                        </td>

                        <td style="box-shadow: 0px 0px 0px transparent !important;">
                            <?php $cart = json_decode($v->cart, TRUE); ?>
                            <table class="table_product">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $totalReturn = 0 ?>
                                    <?php if($cart): ?>
                                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item['quantity_return'] > 0): ?>
                                    <?php
                                    $options = !empty($item['options']['title_version']) ? '- ' . $item['options']['title_version'] : '';
                                    $totalReturn = $totalReturn + ($item['quantity_return'] * $item['price']);
                                    $unit = !empty($item['unit']) ? $item['unit'] : '';
                                    ?>
                                    <tr>
                                        <td><span class="text-danger font-bold"><?php echo e($item['title']); ?></span> <span class="text-xs"><?php echo e($options); ?></span></td>
                                        <td><?php echo e(number_format($item['price'])); ?>₫</td>
                                        <td class="text-center"> <?php echo e($item['quantity_return']); ?> <?php echo e($unit); ?></td>
                                        <td><?php echo e(number_format($item['quantity_return']*$item['price'])); ?>₫</td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <?php echo number_format($totalReturn); ?>₫
                        </td>
                        <td>
                            <?php echo number_format($v->total_price - $v->total_price_coupon + $v->fee_ship); ?>₫
                        </td>
                        <td>
                            <?php echo e($v->order_returns->created_at); ?>

                        </td>
                        <td>
                            <?php if($v->status == 0): ?>
                            <span class="text-white btn btn-sm btn-danger">Đang chờ duyệt</span>
                            <?php else: ?>
                            <span class="text-white btn btn-sm btn-success">Đã duyệt</span>
                            <?php endif; ?>
                        </td>
                        <td class="">
                            <div class="flex justify-center items-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders_edit')): ?>
                                <a class="flex items-center mr-3" href="javascript:void(0)" <?php if($v->status == 0): ?> onclick="showModalOrderReturn(<?php echo e($v->id); ?>)" <?php else: ?> onclick="alert('Đơn hàng đã được hoàn/trả')" <?php endif; ?>>
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                    Xem chi tiết
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center">
            <?php echo e($data->links()); ?>

        </div>
        <!-- END: Pagination -->
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<!-- Main modal -->
<div id="createOrderReturn" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full  flex justify-center items-center " style="background: #808080cc;height:100vh">
    <div class="relative p-4 h-full md:h-auto modal-dialog custom-modal-900">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" onclick="handleCloseReturn()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form id="form-addReturn" class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" action="">
                <h3 class="text-black font-bold text-xl">Hoàn trả</h3>
                <?php echo csrf_field(); ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2 print-error-msg text-sm" style="display: none">
                    <strong class="font-bold">ERROR!</strong>
                    <span class="block sm:inline"></span>
                </div>
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-2 print-success-msg text-sm" style="display: none">
                    <div class="flex items-center">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold"></span>
                        </div>
                    </div>
                </div>
                <div class="loadDataHtmlReturn space-y-6 ">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="handleCloseReturn()" class="btn btn-md btn-danger">Hủy</button>
                    <button type="submit" class="js_submit_return_order btn btn-md btn-primary">
                        Hoàn trả
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END -->
<script type="text/javascript" src="<?php echo e(asset('library/daterangepicker/moment.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('library/daterangepicker/daterangepicker.min.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('library/daterangepicker/daterangepicker.css')); ?>" />
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
<script src="<?php echo e(asset('library/toastr/toastr.min.js')); ?>"></script>
<link href="<?php echo e(asset('library/toastr/toastr.min.css')); ?>" rel="stylesheet">
<script type="text/javascript">
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function handleCloseReturn() {
        $('#createOrderReturn').toggleClass('hidden');
    }

    function showModalOrderReturn(id) {
        $.post("<?php echo route('orders.returnsEdit') ?>", {
                id: id,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                if (data.data.status == 200) {
                    $('.loadDataHtmlReturn').html(data.html);
                    $('#createOrderReturn').toggleClass('hidden');

                } else {
                    toastr.error(data.data.error, 'Error!')
                    return false;
                }

            });

    }
    $(document).ready(function() {
        $('#form-addReturn').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo route('orders.returnsUpdate') ?>",
                type: 'POST',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr("content"),
                    order_id: $('#form-addReturn input[name="order_id"]').val(),
                    price_return: $('#form-addReturn input[name="price_return"]').val(),
                    return_stock: $('#form-addReturn input[name="return_stock"]:checked').val()
                },
                success: function(data) {
                    if (data.status == 200) {
                        $("#form-addReturn .print-error-msg").css('display', 'none');
                        $("#form-addReturn .print-success-msg").css('display', 'block');
                        $("#form-addReturn .print-success-msg span").html("Hoàn/trả đơn hàng thành công");
                        swal({
                            title: "Hoàn/trả đơn hàng thành công",
                            type: "success"
                        }, function() {
                            location.reload();
                        });
                    } else {
                        $("#form-addReturn .print-error-msg").css('display', 'block');
                        $("#form-addReturn .print-success-msg").css('display', 'none');
                        $("#form-addReturn .print-error-msg span").html('ERROR');
                        return false;
                    }
                }
            });
        });
    });
</script>
<style>
    .custom-modal-900 {
        width: 900px;
    }

    #createOrderReturn {
        z-index: 999;
    }

    @media (max-width: 1024px) {
        .custom-modal-900 {
            width: 100%;
        }
    }

    .scrollbar {
        max-height: 400px;
    }

    .scrollbar {
        overflow-y: overlay;
    }

    .scrollbar::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .scrollbar::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }

    .scrollbar::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #D62929;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/order/domains/order.tamphat.edu.vn/public_html/resources/views/order/backend/return.blade.php ENDPATH**/ ?>