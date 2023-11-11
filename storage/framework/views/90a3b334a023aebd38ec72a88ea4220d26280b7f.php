<?php $__env->startSection('title'); ?>
<title>Thêm mới nhóm thành viên</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách nhóm thành viên",
        "src" => route('customer_categories.index'),
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
<form role="form" action="<?php echo e(route('customer_categories.store')); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-3">
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Tiêu đề</label>
                                    <?php echo Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Tiêu đề']); ?>
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
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/customer/backend/category/create.blade.php ENDPATH**/ ?>