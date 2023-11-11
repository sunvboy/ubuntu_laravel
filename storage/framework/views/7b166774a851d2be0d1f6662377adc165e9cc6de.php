<?php $dropdown = getFunctions(); ?>
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex align-items-center">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?php echo e(asset('backend/assets/images/logo-sm.png')); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(asset('backend/assets/images/logo-dark.png')); ?>" alt="" height="17">
                        </span>
                    </a>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?php echo e(asset('backend/assets/images/logo-sm.png')); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(asset('backend/assets/images/logo-light.png')); ?>" alt="" height="17">
                        </span>
                    </a>
                </div>
                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>
            <div class="d-flex align-items-center">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('carts_index')): ?>
                <div>
                    <a href="<?php echo e(route('carts.index')); ?>" class="btn btn-success">Đơn hàng</a>
                </div>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands_index')): ?>
                <?php
                $today = \Carbon\Carbon::now()->format('d-m-Y');
                $mo = \Carbon\Carbon::now()->startOfWeek()->format('d-m-Y');
                $tu = \Carbon\Carbon::now()->startOfWeek()->addDays(1)->format('d-m-Y'); //thứ 3
                $we = \Carbon\Carbon::now()->startOfWeek()->addDays(2)->format('d-m-Y'); //thứ 4
                $th = \Carbon\Carbon::now()->startOfWeek()->addDays(3)->format('d-m-Y'); //thứ 5
                $fr = \Carbon\Carbon::now()->startOfWeek()->addDays(4)->format('d-m-Y'); //thứ 6
                $sa = \Carbon\Carbon::now()->startOfWeek()->addDays(5)->format('d-m-Y'); //thứ 7
                $su = \Carbon\Carbon::now()->startOfWeek()->addDays(6)->format('d-m-Y'); //chủ nhật
                $chunhat = \Carbon\Carbon::now()->startOfWeek()->addDays(6);
                if ($today >= $mo && $today <= $we) {
                    $dateEnd =  $th;
                } else if ($today >= $th && $today <= $sa) {
                    $dateEnd =  $su;
                } else if ($today == $su) {
                    $dateEnd = $chunhat->addDays(4)->format('d-m-Y');
                }
                ?>
                <div class="ms-1">
                    <a href="<?php echo e(route('share_order.index')); ?>" class="btn btn-success">Chia hàng</a>
                </div>
                <div class="ms-1">
                    <a href="<?php echo e(route('out_list.index')); ?>" class="btn btn-success">Out list</a>
                </div>
                <div class="ms-1">
                    <a href="<?php echo e(route('list_orders.index')); ?>" class="btn btn-success">List hàng</a>
                </div>
                <?php endif; ?>
                <div class="dropdown ms-1 topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo e(asset(config('language')[config('app.locale')]['image'])); ?>" alt="Header Language" height="20" class="rounded">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <?php $__currentLoopData = config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- item-->
                        <a href="<?php echo e(route('components.language', [$key])); ?>" class="dropdown-item notify-item language py-2">
                            <img src="<?php echo e(asset($item['image'])); ?>" alt="user-image" class="me-2 rounded" height="18">
                            <span class="align-middle"><?php echo e($item['title']); ?></span>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="<?php echo e(asset('backend/assets/images/users/avatar-1.jpg')); ?>" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo e(!empty(Auth::user())?Auth::user()->name:''); ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text"><?php echo e(!empty(Auth::user())?Auth::user()->email:''); ?></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome <?php echo e(!empty(Auth::user())?Auth::user()->name:''); ?>!</h6>
                        <a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Hồ sơ cá nhân</span></a>
                        <a class="dropdown-item" href="<?php echo e(route('admin.profile-password')); ?>"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Đổi mật khẩu</span></a>
                        <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(asset('backend/assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset('backend/assets/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(asset('backend/assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset('backend/assets/images/logo-light.png')); ?>" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="ri-home-4-fill"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                <?php $__currentLoopData = config('sidebar'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(''.$key.'_index')): ?>
                <?php if(in_array($key, $dropdown) && !empty($module)): ?>
                <?php if(!empty($item['data']) && count($item['data']) > 0): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(in_array($module, array_keys($item['data']))): ?> side-menu--active <?php endif; ?>" href="#<?php echo e($key); ?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="<?php echo e(!empty($item['icon'])?$item['icon']:'ri-settings-fill'); ?>"></i> <span data-key="t-authentication"><?php echo e($item['title']); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="<?php echo e($key); ?>">
                        <ul class="nav nav-sm flex-column">
                            <?php if(!empty($item['data']) && count($item['data']) > 0): ?>
                            <?php $__currentLoopData = $item['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($v['active'])): ?>
                            <?php if(!empty($v['dropdown'])): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(''.$k.'_index')): ?>
                            <?php if(in_array($k, $dropdown)): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route($v['route'])); ?>" class="nav-link <?php $__currentLoopData = $v['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(activeMenu($menu)); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
                                    <?php echo e(!empty($v['title'])?$v['title'] : config('permissions')['modules'][$k]); ?>

                                </a>
                            </li>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php else: ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route($v['route'])); ?>" class="nav-link <?php $__currentLoopData = $v['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(activeMenu($menu)); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
                                    <?php echo e(!empty($v['title'])?$v['title'] : config('permissions')['modules'][$k]); ?>

                                </a>
                            </li>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo activeMenu($key); ?>" href="<?php echo e(route($item['route'])); ?>">
                        <i class="<?php echo e(!empty($item['icon'])?$item['icon']:'ri-settings-fill'); ?>"></i> <span data-key="t-dashboards"><?php echo e($item['title']); ?></span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generals_index')): ?>
                <?php if (in_array('generals', $dropdown)) { ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php if(in_array($module, array_keys($item['data']))): ?> side-menu--active <?php endif; ?>" href="#setting" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="ri-settings-3-fill"></i> <span data-key="t-authentication">Cấu hình</span>
                        </a>
                        <div class="collapse menu-dropdown" id="setting">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('generals.general')); ?>" class="nav-link <?php echo e(activeMenu('generals')); ?>">
                                        Hệ thống
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('config_infos.edit',['id' => 1])); ?>" class="nav-link <?php echo e(activeMenu('generals')); ?>">
                                        Email ứng dụng
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php } ?>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('sitemap')); ?>">
                        <i class="ri-settings-fill"></i> <span data-key="t-dashboards">Cập nhập sitemap</span>
                    </a>
                </li>
                <?php if(env('APP_ENV') == "local" && !empty($module)): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Development" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-settings-3-fill"></i> <span data-key="t-authentication">Development</span>
                    </a>
                    <div class="collapse menu-dropdown" id="Development">
                        <ul class="nav nav-sm flex-column">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_index')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('permissions.index')); ?>" class="nav-link <?php echo e(activeMenu('permissions')); ?>">
                                    Quản lý phân quyền
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('configIs.index')); ?>" class="nav-link <?php echo e(activeMenu('config-is')); ?>">
                                    Cấu hình hiển thị
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('config_colums.index')); ?>" class="nav-link <?php echo e(activeMenu('config-colums')); ?>">
                                    Custom field
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <?php endif; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== --><?php /**PATH D:\xampp\htdocs\order.local\resources\views/dashboard/common/header.blade.php ENDPATH**/ ?>