<?php $__env->startSection('title'); ?>
<title>Thêm mới nhóm thành viên</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách nhóm thành viên",
        "src" => route('roles.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, 'Thêm mới nhóm thành viên');
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form role="form" action="<?php echo e(route('roles.store')); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label fw-bold">Tên nhóm thành viên</label>
                                <?php echo Form::text('title', '', ['class' => 'form-control']); ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label fw-bold">Mô tả</label>
                                <?php echo Form::text('description', '', ['class' => 'form-control w-full ']); ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="mb-0 flex-grow-1 fw-semibold"><?php echo e(config('permissions.modules')[$v->title]); ?></div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <?php $__currentLoopData = $v->permissionsChildren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($val->title != 'Copy hình ảnh' && $val->title != 'Di chuyển hình ảnh'): ?>
                        <div class="form-check col-lg-3">
                            <input name="permission_id[]" class="form-check-input" type="checkbox" value="<?php echo e($val->id); ?>" id="check<?php echo e($val->id); ?>">
                            <label class="form-check-label" for="check<?php echo e($val->id); ?>">
                                <?php echo e(!empty(config('permissions.actions')[$val->title])?config('permissions.actions')[$val->title]:$val->title); ?>

                            </label>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="row">
        <div class="col-md-12 mb-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-secondary waves-effect waves-light">Lưu thay đổi</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/user/backend/role/create.blade.php ENDPATH**/ ?>