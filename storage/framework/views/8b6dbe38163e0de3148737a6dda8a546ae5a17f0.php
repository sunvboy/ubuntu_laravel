<?php $__env->startSection('title'); ?>
<title>Thêm mới thành viên</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách thành viên",
        "src" => route('customers.index'),
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
<form role="form" action="<?php echo e(route('customers.store')); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-3">
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Nhóm thành viên</label>
                                    <?php echo Form::select('catalogue_id', $category, old('catalogue_id'), ['class' => 'form-control', 'placeholder' => '']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Email</label>
                                    <?php echo Form::text('email', '', ['class' => 'form-control w-full', 'placeholder' => 'Email']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Số điện thoại</label>
                                    <?php echo Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'Số điện thoại']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Mật khẩu</label>
                                    <?php echo Form::text('password', '', ['class' => 'form-control w-full', 'placeholder' => 'Mật khẩu']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Họ và tên</label>
                                    <?php echo Form::text('name', '', ['class' => 'form-control w-full', 'placeholder' => 'Họ và tên']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Địa chỉ</label>
                                    <?php echo Form::text('address', '', ['class' => 'form-control w-full', 'placeholder' => 'Số 80 - Ngõ 20 - Mỹ Đình']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <?php echo $__env->make('user.backend.user.image',['action' => 'create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/customer/backend/customer/create.blade.php ENDPATH**/ ?>