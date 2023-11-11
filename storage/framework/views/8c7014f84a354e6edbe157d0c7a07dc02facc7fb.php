<?php $__env->startSection('title'); ?>
<title>Hình ảnh</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Hình ảnh",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Danh sách module
    </h1>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class=" col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <?php if(env('APP_ENV') == "local"): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generals_index')): ?>
            <a href="<?php echo e(route('config_images.create')); ?>" class="btn btn-primary shadow-md mr-2">Thêm mới</a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <!-- BEGIN: Data List -->
        <div class=" col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">TIÊU ĐỀ</th>
                        <th class="whitespace-nowrap" style="text-align: center">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="odd " id="post-<?php echo $v->id; ?>">

                        <td class="text-left" style="text-align:left">
                            <?php echo $v->module; ?>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="<?php echo e(route('config_images.edit',['id'=>$v->id])); ?>">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/order/domains/order.tamphat.edu.vn/public_html/resources/views/config/images/index.blade.php ENDPATH**/ ?>