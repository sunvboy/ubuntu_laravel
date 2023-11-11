<?php $__env->startSection('title'); ?>
<title>Thêm mới media</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách menu",
        "src" => route('menus.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Thêm mới menu");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('menus.store')); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 mb-3">
                        <label for="firstNameinput" class="form-label">Tên menu</label>
                        <?php echo Form::text('title', '', ['class' => 'form-control w-full title', 'required']); ?>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="firstNameinput" class="form-label">Từ khóa</label>
                        <?php echo Form::text('slug', '', ['class' => 'form-control canonical', 'data-flag' => 0, 'required']); ?>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Cập nhập</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?php echo $__env->make('components.publish', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/menu/backend/create.blade.php ENDPATH**/ ?>