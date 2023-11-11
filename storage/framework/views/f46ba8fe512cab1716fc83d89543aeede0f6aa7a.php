<?php $__env->startSection('title'); ?>
<title>Hồ sơ cá nhân</title>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Hồ sơ cá nhân",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Thông tin tài khoản");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="position-relative mx-n4">
    <div class="profile-wid-bg profile-setting-img">
        <img src="<?php echo e(asset('backend/assets/images/profile-bg.jpg')); ?>" class="profile-wid-img" alt="">
    </div>
</div>
<div class="row">
    <?php echo $__env->make('user.backend.user.profile_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--end col-->
    <div class="col-md-9">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('admin.profile')); ?>">
                            <i class="fas fa-home"></i> Cập nhập thông tin cá nhân
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.profile-password')); ?>">
                            <i class="far fa-user"></i> Thay đổi mật khẩu
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                        <form action="<?php echo e(route('admin.profile-store' , ['id' => Auth::user()->id])); ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo $__env->make('components.alert-error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo csrf_field(); ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="firstnameInput" class="form-label">Email</label>
                                        <?php echo Form::text('email', Auth::user()->email, ['class' => 'form-control', 'disabled']); ?>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="lastnameInput" class="form-label">Họ và tên</label>
                                        <?php echo Form::text('name', Auth::user()->name, ['class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">Số điện thoại</label>
                                        <?php echo Form::text('phone', Auth::user()->phone, ['class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">Địa chỉ</label>
                                        <?php echo Form::text('address', Auth::user()->address, ['class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Cập nhập</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/user/backend/user/profile.blade.php ENDPATH**/ ?>