

<?php $__env->startSection('title'); ?>
<title>Thêm mới phân quyền</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách nhóm phân quyền",
        "src" => route('permissions.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Thêm mới");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form role="form" action="<?php echo e(route('permissions.store')); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-3">
                            <div>
                                <label for="basiInput" class="form-label fw-bold">Tên module</label>
                                <select class="tom-select tom-select-field" data-placeholder="Search..." name="title" tabindex="-1">
                                    <option value=""></option>
                                    <?php $__currentLoopData = config('permissions.modules'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k); ?>" <?php echo e((collect(old('title'))->contains($k)) ? 'selected':''); ?>> <?php echo e($v); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="basiInput" class="form-label fw-bold">Mô tả</label>
                                <?php echo Form::textarea('description', '', ['class' => 'form-control w-full ']); ?>
                            </div>
                            <div class="mt-3">
                                <label for="basiInput" class="form-label fw-bold">Quyền module</label>
                                <div class="row">
                                    <?php $__currentLoopData = config('permissions.actions'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3 col-lg-3">
                                        <label for="check<?php echo e($k); ?>">
                                            <input name="permission_id[]" type="checkbox" class="form-check-input" value="<?php echo e($k); ?>" id="check<?php echo e($k); ?>" />
                                            <?php echo e($v); ?>

                                        </label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary w-24">Thêm mới</button>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('article.backend.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/user/backend/permission/create.blade.php ENDPATH**/ ?>