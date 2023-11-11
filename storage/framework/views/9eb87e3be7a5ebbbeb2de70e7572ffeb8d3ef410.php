<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="UTF-8">
    <title>Admin | Quên mật khẩu</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Layout config Js -->
    <script src="<?php echo e(asset('backend/assets/js/layout.js')); ?>"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('backend/assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo e(asset('backend/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo e(asset('backend/assets/css/app.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo e(asset('backend/assets/css/custom.min.css')); ?>" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="assets/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Tâm Phát Admin & Dashboard Template</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Quên mật khẩu?</h5>
                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl"></lord-icon>
                                </div>
                                <?php if(session('success')): ?>
                                <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                    <i class="ri-notification-off-line label-icon"></i><strong>Success</strong>
                                    - <?php echo e(session('success')); ?>

                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php endif; ?>
                                <?php if(session('error')): ?>
                                <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show mb-3" role="alert">
                                    <i class="ri-error-warning-line label-icon"></i><strong>ERROR</strong>
                                    - <?php echo e(session('error')); ?>

                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php endif; ?>
                                <div class="p-2">
                                    <form action="<?php echo e(route('admin.reset-password')); ?>" method="POST" id="resetform">
                                        <?php echo csrf_field(); ?>
                                        <div class="mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" type="submit">Gửi</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                        <div class="mt-4 text-center">
                            <p class="mb-0">Quay lại <a href="<?php echo e(route('admin.login')); ?>" class="fw-semibold text-primary text-decoration-underline">Đăng nhập</a> </p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> <?php echo e(env('BE_TITLE_SEO')); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
    <!-- JAVASCRIPT -->
    <script src="<?php echo e(asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/assets/libs/simplebar/simplebar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/assets/libs/node-waves/waves.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/assets/libs/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/assets/js/pages/plugins/lord-icon-2.1.0.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/assets/js/plugins.js')); ?>"></script>
    <!-- particles js -->
    <script src="<?php echo e(asset('backend/assets/libs/particles.js/particles.js')); ?>"></script>
    <!-- particles app js -->
    <script src="<?php echo e(asset('backend/assets/js/pages/particles.app.js')); ?>"></script>
    <!-- password-addon init -->
    <script src="<?php echo e(asset('backend/assets/js/pages/password-addon.init.js')); ?>"></script>
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <script>
        $("#resetform").submit(function(event) {
            $('html').attr("data-preloader", "");
        });
    </script>
</body>

</html><?php /**PATH D:\xampp\htdocs\order.local\resources\views/user/backend/auth/reset-password.blade.php ENDPATH**/ ?>