<?php $dropdown = getFunctions(); ?>
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex align-items-center">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('backend/assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('backend/assets/images/logo-dark.png')}}" alt="" height="17">
                        </span>
                    </a>
                    <a href="{{route('admin.dashboard')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('backend/assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('backend/assets/images/logo-light.png')}}" alt="" height="17">
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
                @can('carts_index')
                <div>
                    <a href="{{route('carts.index')}}" class="btn btn-success">Đơn hàng</a>
                </div>
                @endcan
                @can('brands_index')
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
                    <a href="{{route('share_order.index')}}" class="btn btn-success">Chia hàng</a>
                </div>
                <div class="ms-1">
                    <a href="{{route('out_list.index')}}" class="btn btn-success">Out list</a>
                </div>
                <div class="ms-1">
                    <a href="{{route('list_orders.index')}}" class="btn btn-success">List hàng</a>
                </div>
                @endcan
                <div class="dropdown ms-1 topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset(config('language')[config('app.locale')]['image'])}}" alt="Header Language" height="20" class="rounded">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        @foreach(config('language') as $key=>$item)
                        <!-- item-->
                        <a href="{{ route('components.language', [$key]) }}" class="dropdown-item notify-item language py-2">
                            <img src="{{asset($item['image'])}}" alt="user-image" class="me-2 rounded" height="18">
                            <span class="align-middle">{{$item['title']}}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{asset('backend/assets/images/users/avatar-1.jpg')}}" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{!empty(Auth::user())?Auth::user()->name:''}}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{!empty(Auth::user())?Auth::user()->email:''}}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{!empty(Auth::user())?Auth::user()->name:''}}!</h6>
                        <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Hồ sơ cá nhân</span></a>
                        <a class="dropdown-item" href="{{route('admin.profile-password')}}"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Đổi mật khẩu</span></a>
                        <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
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
        <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('backend/assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('backend/assets/images/logo-dark.png')}}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('backend/assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('backend/assets/images/logo-light.png')}}" alt="" height="17">
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
                    <a class="nav-link menu-link" href="{{route('admin.dashboard')}}">
                        <i class="ri-home-4-fill"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                @foreach (config('sidebar') as $key=>$item)
                @can(''.$key.'_index')
                @if (in_array($key, $dropdown) && !empty($module))
                @if(!empty($item['data']) && count($item['data']) > 0)
                <li class="nav-item">
                    <a class="nav-link menu-link @if(in_array($module, array_keys($item['data']))) side-menu--active @endif" href="#{{$key}}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="{{!empty($item['icon'])?$item['icon']:'ri-settings-fill'}}"></i> <span data-key="t-authentication">{{$item['title']}}</span>
                    </a>
                    <div class="collapse menu-dropdown" id="{{$key}}">
                        <ul class="nav nav-sm flex-column">
                            @if(!empty($item['data']) && count($item['data']) > 0)
                            @foreach($item['data'] as $k=>$v)
                            @if(!empty($v['active']))
                            @if(!empty($v['dropdown']))
                            @can(''.$k.'_index')
                            @if (in_array($k, $dropdown))
                            <li class="nav-item">
                                <a href="{{ route($v['route']) }}" class="nav-link @foreach($v['menu'] as $menu) {{activeMenu($menu)}} @endforeach">
                                    {{!empty($v['title'])?$v['title'] : config('permissions')['modules'][$k]}}
                                </a>
                            </li>
                            @endcan
                            @endif
                            @else
                            <li class="nav-item">
                                <a href="{{ route($v['route']) }}" class="nav-link @foreach($v['menu'] as $menu) {{activeMenu($menu)}} @endforeach">
                                    {{!empty($v['title'])?$v['title'] : config('permissions')['modules'][$k]}}
                                </a>
                            </li>
                            @endif
                            @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo activeMenu($key); ?>" href="{{route($item['route'])}}">
                        <i class="{{!empty($item['icon'])?$item['icon']:'ri-settings-fill'}}"></i> <span data-key="t-dashboards">{{$item['title']}}</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                @endif
                @endif
                @endcan
                @endforeach
                @can('generals_index')
                <?php if (in_array('generals', $dropdown)) { ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link @if(in_array($module, array_keys($item['data']))) side-menu--active @endif" href="#setting" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="ri-settings-3-fill"></i> <span data-key="t-authentication">Cấu hình</span>
                        </a>
                        <div class="collapse menu-dropdown" id="setting">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('generals.general')}}" class="nav-link {{ activeMenu('generals') }}">
                                        Hệ thống
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('config_infos.edit',['id' => 1])}}" class="nav-link {{ activeMenu('generals') }}">
                                        Email ứng dụng
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php } ?>
                @endcan
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('sitemap')}}">
                        <i class="ri-settings-fill"></i> <span data-key="t-dashboards">Cập nhập sitemap</span>
                    </a>
                </li>
                @if(env('APP_ENV') == "local" && !empty($module))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Development" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-settings-3-fill"></i> <span data-key="t-authentication">Development</span>
                    </a>
                    <div class="collapse menu-dropdown" id="Development">
                        <ul class="nav nav-sm flex-column">
                            @can('users_index')
                            <li class="nav-item">
                                <a href="{{route('permissions.index')}}" class="nav-link {{ activeMenu('permissions') }}">
                                    Quản lý phân quyền
                                </a>
                            </li>
                            @endcan
                            <li class="nav-item">
                                <a href="{{route('configIs.index')}}" class="nav-link {{ activeMenu('config-is') }}">
                                    Cấu hình hiển thị
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('config_colums.index')}}" class="nav-link {{ activeMenu('config-colums') }}">
                                    Custom field
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                @endif
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
<!-- ============================================================== -->