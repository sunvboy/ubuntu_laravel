<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script>
        var BASE_URL = '<?php echo url(''); ?>/';
        var BASE_URL_AJAX = '<?php echo url(''); ?>/<?php echo env('APP_ADMIN') ?>/';
    </script>
    <?php echo $__env->yieldContent('title'); ?>
    <!-- head-->
    <?php echo $__env->make('dashboard.common.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body class="main">
    <?php /*<div class="flex">
        <!-- sidebar -->
        @include('dashboard.common.sidebar')
        <!--right-side -->
        <aside class="wrapper">
            <!-- header-->
            @include('dashboard.common.header')
            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </aside>
    </div>
    <!-- footer -->*/ ?>
    <div id="layout-wrapper">
        <?php echo $__env->make('dashboard.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <?php echo $__env->yieldContent('breadcrumb'); ?>
                    <!-- end page title -->
                    <?php echo $__env->make('components.alert-error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('components.alert-success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <?php echo $__env->make('dashboard.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <?php echo $__env->make('dashboard.common.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('javascript'); ?>
    <style>
        .no-print {
            top: 50% !important;
        }
    </style>
</body>

</html><?php /**PATH D:\xampp\htdocs\order.local\resources\views/dashboard/layout/dashboard.blade.php ENDPATH**/ ?>