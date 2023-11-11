<?php $__env->startSection('title'); ?>
<title>Logs đơn hàng</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Logs đơn hàng",
        "src" => route('orders.index'),
    ]
);
echo breadcrumb_backend($array);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Logs đơn hàng
    </h1>
    <form action="" class="grid grid-cols-12 gap-1 space-x-2  mt-5" id="search" style="margin-bottom: 0px;">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_logs_destroy')): ?>
        <div class="col-span-2">
            <select class="form-control ajax-delete-all  " data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="<?php echo e($module); ?>">
                <option>Hành động</option>
                <option value="">Xóa</option>
            </select>
        </div>
        <?php endif; ?>
        <div class="col-span-3">
            <?php echo Form::text('date', request()->get('date'), ['class' => 'form-control',  'autocomplete' => 'off']); ?>
        </div>
        <div class="col-span-3 flex">
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
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_logs_destroy')): ?>
                        <th style="width:40px;">
                            <input type="checkbox" id="checkbox-all">
                        </th>
                        <?php endif; ?>
                        <th class="whitespace-nowrap">STT</th>
                        <th class="whitespace-nowrap">Nội dung</th>
                        <th class="whitespace-nowrap">Thành viên</th>
                        <th class="whitespace-nowrap">Ngày tạo</th>
                        <th class="whitespace-nowrap text-center">#</th>
                    </tr>
                </thead>

                <tbody id="table_data" role="alert" aria-live="polite" aria-relevant="all">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="odd " id="post-<?php echo $v->id; ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_logs_destroy')): ?>
                        <td>
                            <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item">
                        </td>
                        <?php endif; ?>
                        <td>
                            <?php echo e($data->firstItem()+$loop->index); ?>

                        </td>
                        <td>
                            <?php echo $v->note ?>
                        </td>
                        <td>
                            <?php echo $v->user->name ?>
                        </td>
                        <td>
                            <?php echo e($v->created_at); ?>

                        </td>

                        <td class="">
                            <div class="flex justify-center items-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_logs_destroy')): ?>
                                <a class="flex items-center text-danger ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa đơn hàng, đơn hàng sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/order/domains/order.tamphat.edu.vn/public_html/resources/views/order/logs/index.blade.php ENDPATH**/ ?>