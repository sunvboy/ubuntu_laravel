<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var BASE_URL = '<?php echo url(''); ?>/';
        var BASE_URL_AJAX = '<?php echo url(''); ?>/<?php echo env('APP_ADMIN') ?>/';
    </script>
    @yield('title')
    <!-- head-->
    @include('dashboard.common.head')
    @stack('css')
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
        @include('dashboard.common.header')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    @yield('breadcrumb')
                    <!-- end page title -->
                    @include('components.alert-error')
                    @include('components.alert-success')
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('dashboard.common.footer')
        </div>
    </div>
    @include('dashboard.common.script')
    @stack('javascript')
    <style>
        .no-print {
            top: 50% !important;
        }
    </style>
</body>

</html>