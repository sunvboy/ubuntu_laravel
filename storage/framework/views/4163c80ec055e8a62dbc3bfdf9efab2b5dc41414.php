<?php $__env->startSection('title'); ?>
<title>Thay đổi mật khẩu</title>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Thay đổi mật khẩu",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
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
                        <a class="nav-link" href="<?php echo e(route('admin.profile')); ?>">
                            <i class="fas fa-home"></i> Cập nhập thông tin cá nhân
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('admin.profile-password')); ?>">
                            <i class="far fa-user"></i> Thay đổi mật khẩu
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">

                    <div class="tab-pane active" id="changePassword" role="tabpanel">
                        <form action="<?php echo e(route('admin.profile-password-store' , ['id' => Auth::user()->id])); ?>" method="post" enctype="multipart/form-data">
                            <div class="row g-2">
                                <div class="col-lg-12">
                                    <?php echo $__env->make('components.alert-error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo csrf_field(); ?>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div>
                                        <label for="newpasswordInput" class="form-label">Mật khẩu mới*</label>
                                        <input type="password" name="password" class="form-control" placeholder="" value="" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div>
                                        <label for="confirmpasswordInput" class="form-label">Xác nhận mật khẩu mới*</label>
                                        <input type="password" name="confirm_password" class="form-control" placeholder="" value="" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
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
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/user/backend/user/profile_password.blade.php ENDPATH**/ ?>