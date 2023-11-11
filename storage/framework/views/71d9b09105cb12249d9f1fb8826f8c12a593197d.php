<?php $dropdown = getFunctions(); ?>
<nav class="side-nav">
    <div class="pt-4 mb-4">
        <div class="side-nav__header flex items-center">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class=" flex items-center">
                <img alt="Rocketman Tailwind HTML Admin Template" class="side-nav__header__logo" src="<?php echo e(asset('backend/images/logo.svg')); ?>">
                <span class="side-nav__header__text text-white pt-0.5 text-lg ml-2.5"> <?php echo e(env('BE_TITLE_SEO')); ?> </span>
            </a>
            <a href="javascript:;" class="side-nav__header__toggler hidden xl:block ml-auto text-white text-opacity-70 hover:text-opacity-100 transition-all duration-300 ease-in-out pr-5">
                <i data-lucide="arrow-left-circle" class="w-5 h-5"></i>
            </a>
            <a href="javascript:;" class="mobile-menu-toggler xl:hidden ml-auto text-white text-opacity-70 hover:text-opacity-100 transition-all duration-300 ease-in-out pr-5">
                <i data-lucide="x-circle" class="w-5 h-5"></i>
            </a>
        </div>
    </div>
    <div class="scrollable">
        <ul class="scrollable__content">
            <li class="side-nav__devider mb-4">START MENU</li>
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="side-menu <?php echo e(activeMenu('dashboard')); ?>">
                    <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                    <div class="side-menu__title">
                        Dashboard
                    </div>
                </a>
            </li>
            <!-- Start: Quản lý khách hàng -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customers_index')): ?>
            <?php if (in_array('customers', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'customers' || $module === 'customer_logs'  || $module === 'customer_categories') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý khách hàng
                            <div class="side-menu__sub-icon <?php if ($module === 'customers' || $module === 'customer_logs' || $module === 'customer_categories') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'customers' || $module === 'customer_logs' ||  $module === 'customer_categories') { ?>side-menu__sub-open<?php } ?>">
                        <li>
                            <a href="<?php echo e(route('customer_categories.index')); ?>" class="side-menu <?php echo e(activeMenu('customer-categories')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Nhóm khách hàng</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('customers.index')); ?>" class="side-menu <?php echo e(activeMenu('customers')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh sách khách hàng </div>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer_logs_index')): ?>
                        <li class="">
                            <a href="<?php echo e(route('customerLogs.index')); ?>" class="side-menu <?php echo e(activeMenu('customer-logs')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Logs </div>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý khách hàng -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('articles_index')): ?>
            <?php if (in_array('articles', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php echo e(request()->routeIs('articles.index') ? 'side-menu--active' : ''); ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Bài viết
                            <div class="side-menu__sub-icon <?php if ($module === 'category_articles' || $module === 'articles') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'category_articles' || $module === 'articles') { ?>side-menu__sub-open<?php } ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_articles_index')): ?>
                        <li>
                            <a href="<?php echo e(route('category_articles.index')); ?>" class="side-menu <?php echo e(activeMenu('category-articles')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh mục bài viết</div>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('articles.index')); ?>" class="side-menu <?php echo e(activeMenu('articles')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Bài viết </div>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý bài viết -->
            <!-- Start: Quản lý product -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products_index')): ?>
            <?php if (in_array('products', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'category_products' || $module === 'products' || $module === 'brands') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Sản phẩm
                            <div class="side-menu__sub-icon <?php if ($module === 'category_products' || $module === 'products' || $module === 'brands') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'category_products' || $module === 'products' || $module === 'brands') { ?>side-menu__sub-open<?php } ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_products_index')): ?>
                        <li>
                            <a href="<?php echo e(route('category_products.index')); ?>" class="side-menu <?php echo e(activeMenu('category-products')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh mục sản phẩm</div>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('products.index')); ?>" class="side-menu <?php echo e(activeMenu('products')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh sách sản phẩm</div>
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands_index')): ?>
                        <?php if (in_array('brands', $dropdown)) { ?>
                            <li>
                                <a href="<?php echo e(route('brands.index')); ?>" class="side-menu <?php echo e(activeMenu('brands')); ?>">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Quản lý Thương hiệu</div>
                                </a>
                            </li>
                        <?php } ?>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php } ?>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders_index')): ?>
            <?php if (in_array('orders', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'orders' || $module === 'order_logs' || $module === 'orders_payment' || $module === 'coupons' || $module === 'ships') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Đơn hàng
                            <div class="side-menu__sub-icon <?php if ($module === 'orders' || $module === 'order_logs' || $module === 'orders_payment' || $module === 'coupons' || $module === 'ships') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'orders' || $module === 'order_logs' || $module === 'orders_payment' || $module === 'coupons' || $module === 'ships') { ?>side-menu__sub-open<?php } ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders_index')): ?>
                        <?php if (in_array('orders', $dropdown)) { ?>
                            <li>
                                <a href="<?php echo e(route('orders.index')); ?>" class="side-menu <?php echo e(activeMenu('orders')); ?>">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Quản lý Đơn hàng</div>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('orders.returns')); ?>" class="side-menu <?php echo e(activeMenu('orders-returns')); ?>">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Trả/hoàn hàng</div>
                                </a>
                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders_payment_index')): ?>
                            <li>
                                <a href="<?php echo e(route('orders.payment')); ?>" class="side-menu <?php echo e(activeMenu('orders-payment')); ?>">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Lịch sử thanh toán</div>
                                </a>
                            </li>
                            <?php endif; ?>
                        <?php } ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupons_index')): ?>
                        <?php if (in_array('coupons', $dropdown)) { ?>
                            <li>
                                <a href="<?php echo e(route('coupons.index')); ?>" class="side-menu <?php echo e(activeMenu('coupons')); ?>">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Quản lý Mã giảm giá</div>
                                </a>
                            </li>
                        <?php } ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ships_index')): ?>
                        <?php if (in_array('ships', $dropdown)) { ?>
                            <li>
                                <a href="<?php echo e(route('ships.index')); ?>" class="side-menu <?php echo e(activeMenu('ships')); ?>">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Quản lý Vận chuyển</div>
                                </a>
                            </li>
                        <?php } ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_configs_index')): ?>
                        <li>
                            <a href="<?php echo e(route('orders.config')); ?>" class="side-menu <?php echo e(activeMenu('orders-config')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Cấu hình đơn hàng</div>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_logs_index')): ?>
                        <li>
                            <a href="<?php echo e(route('orderLogs.index')); ?>" class="side-menu <?php echo e(activeMenu('order-logs')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title">Logs</div>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý product -->
            <!-- Start: Quản lý thuộc tính -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('attributes_index')): ?>
            <?php if (in_array('attributes', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'category_attributes' || $module === 'attributes') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Thuộc tính
                            <div class="side-menu__sub-icon <?php if ($module === 'category_attributes' || $module === 'attributes') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'category_attributes' || $module === 'attributes') { ?>side-menu__sub-open<?php } ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_attributes_index')): ?>
                        <li>
                            <a href="<?php echo e(route('category_attributes.index')); ?>" class="side-menu <?php echo e(activeMenu('category-attributes')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Nhóm thuộc tính</div>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('attributes.index')); ?>" class="side-menu <?php echo e(activeMenu('attributes')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh sách </div>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý thuộc tính -->
            <!-- Start: Quản lý media -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('media_index')): ?>
            <?php if (in_array('media', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'category_media' || $module === 'media') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Media
                            <div class="side-menu__sub-icon <?php if ($module === 'category_media' || $module === 'media') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'category_media' || $module === 'media') { ?>side-menu__sub-open<?php } ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_media_index')): ?>
                        <li>
                            <a href="<?php echo e(route('category_media.index')); ?>" class="side-menu <?php echo e(activeMenu('category-media')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh mục media</div>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('media.index')); ?>" class="side-menu <?php echo e(activeMenu('media')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh sách </div>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý media -->

            <!-- Start: Hệ thống cửa hàng -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('addresses_index')): ?>
            <?php if (in_array('addresses', $dropdown)) { ?>
                <li>
                    <a href="<?php echo e(route('addresses.index')); ?>" class="side-menu <?php echo e(activeMenu('addresses')); ?>">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Hệ thống cửa hàng </div>
                    </a>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Hệ thống cửa hàng -->
            <!-- Start: Quản lý Trang -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pages_index')): ?>
            <?php if (in_array('pages', $dropdown)) { ?>
                <li>
                    <a href="<?php echo e(route('pages.index')); ?>" class="side-menu <?php echo e(activeMenu('pages')); ?>">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý Trang </div>
                    </a>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý Trang -->
            <!-- Start: Quản lý Liên hệ -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contacts_index')): ?>
            <?php if (in_array('contacts', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'contacts') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Liên hệ
                            <div class="side-menu__sub-icon <?php if ($module === 'contacts') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'contacts') { ?>side-menu__sub-open<?php } ?>">
                        <li>
                            <a href="<?php echo e(route('contacts.index')); ?>" class="side-menu <?php echo e(activeMenu('contacts')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Quản lý Liên hệ</div>
                            </a>
                        </li>
                        <li class="hidden">
                            <a href="<?php echo e(route('subscribers.index')); ?>" class="side-menu <?php echo e(activeMenu('subscribers')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Đăng ký gửi email </div>
                            </a>
                        </li>
                        <li class="hidden">
                            <a href="<?php echo e(route('books.index')); ?>" class="side-menu <?php echo e(activeMenu('books')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Đặt lịch hẹn </div>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý Liên hệ -->
            <!-- Start: Quản lý Tag -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tags_index')): ?>
            <?php if (in_array('tags', $dropdown)) { ?>
                <li>
                    <a href="<?php echo e(route('tags.index')); ?>" class="side-menu <?php echo e(activeMenu('tags')); ?>">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý Tag </div>
                    </a>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý Tag -->
            <!-- Start: Quản lý Comment -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('comments_index')): ?>
            <?php if (in_array('comments', $dropdown)) { ?>
                <li>
                    <a href="<?php echo e(route('comments.index')); ?>" class="side-menu <?php echo e(activeMenu('comments')); ?>">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý Comment </div>
                    </a>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý Comment -->
            <!-- Start: Quản lý slide -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slides_index')): ?>
            <?php if (in_array('slides', $dropdown)) { ?>
                <li>
                    <a href="<?php echo e(route('slides.index')); ?>" class="side-menu <?php echo e(activeMenu('slides')); ?>">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý Banner & Slide </div>
                    </a>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý slide -->
            <!-- Start: Quản lý Menu -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menus_index')): ?>
            <?php if (in_array('menus', $dropdown)) { ?>
                <li>
                    <a href="<?php echo e(route('menus.index')); ?>" class="side-menu <?php echo e(activeMenu('menus')); ?>">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý Menu </div>
                    </a>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý Menu -->
            <!-- Start: Cấu hình hệ thống -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generals_index')): ?>
            <?php if (in_array('generals', $dropdown)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'generals' || $module === 'config_infos' || $module === 'config_images') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Cấu hình
                            <div class="side-menu__sub-icon <?php if ($module === 'generals' || $module === 'config_infos' || $module === 'config_images') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'generals' || $module === 'config_infos' || $module === 'config_images') { ?>side-menu__sub-open<?php } ?>">
                        <li>
                            <a href="<?php echo e(route('generals.general')); ?>" class="side-menu <?php echo e(activeMenu('generals')); ?>">
                                <div class="side-menu__icon">
                                    <i data-lucide="box"></i>
                                </div>
                                <div class="side-menu__title"> Hệ thống </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('config_infos.edit',['id' => 1])); ?>" class="side-menu <?php echo e(activeMenu('config-infos')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Email ứng dụng </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('config_images.index')); ?>" class="side-menu <?php echo e(activeMenu('config-images')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Hình ảnh </div>
                            </a>
                        </li>

                    </ul>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Cấu hình hệ thống -->
            <!-- Start: Quản lý thành viên -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_index')): ?>
            <?php if (in_array('users', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'users' || $module === 'roles') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý thành viên
                            <div class="side-menu__sub-icon <?php if ($module === 'users' || $module === 'roles') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'users' || $module === 'roles') { ?>side-menu__sub-open<?php } ?>">
                        <li>
                            <a href="<?php echo e(route('roles.index')); ?>" class="side-menu <?php echo e(activeMenu('roles')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Nhóm thành viên</div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('users.index')); ?>" class="side-menu <?php echo e(activeMenu('users')); ?>">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Thành viên </div>
                            </a>
                        </li>

                    </ul>
                </li>
            <?php } ?>
            <?php endif; ?>
            <!-- END: Quản lý thành viên -->
            <?php if(env('APP_ENV') == "local" && !empty($module)): ?>
            <li>
                <a href="javascript:void(0)" class="side-menu <?php if ($module === 'permissions' || $module === 'configis' || $module === 'config_colums') { ?>side-menu--active<?php } ?>">
                    <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                    <div class="side-menu__title">
                        Development
                        <div class="side-menu__sub-icon <?php if ($module === 'permissions' || $module === 'configis' || $module === 'config_colums') { ?>transform rotate-180<?php } ?>">
                            <i data-lucide="chevron-down"></i>
                        </div>
                    </div>
                </a>
                <ul class="<?php if ($module === 'permissions' || $module === 'configis' || $module === 'config_colums') { ?>side-menu__sub-open<?php } ?>">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_index')): ?>
                    <li>
                        <a href="<?php echo e(route('permissions.index')); ?>" class="side-menu <?php echo e(activeMenu('permissions')); ?>">
                            <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                            <div class="side-menu__title">Quản lý phân quyền</div>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo e(route('configIs.index')); ?>" class="side-menu <?php echo e(activeMenu('config-is')); ?>">
                            <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                            <div class="side-menu__title">Cấu hình hiển thị</div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('config_colums.index')); ?>" class="side-menu <?php echo e(activeMenu('config-colums')); ?>">
                            <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                            <div class="side-menu__title">Custom field</div>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <li class="">
                <a href="<?php echo e(route('sitemap')); ?>" class="side-menu" target="_blank">
                    <div class="side-menu__icon">
                        <i data-lucide="box"></i>
                    </div>
                    <div class="side-menu__title">Cập nhập sitemap</div>
                </a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('websites_index')): ?>
            <?php if (in_array('websites', $dropdown) && !empty($module) && (env('APP_ENV') == "local")) { ?>
                <li class="">
                    <a href="<?php echo e(route('websites.index')); ?>" class="side-menu" class="side-menu <?php echo e(activeMenu('websites')); ?>">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title">Giao diện website</div>
                    </a>
                </li>
            <?php } ?>
            <?php endif; ?>
        </ul>
    </div>
</nav><?php /**PATH /home/order/domains/order.tamphat.edu.vn/public_html/resources/views/dashboard/common/sidebar.blade.php ENDPATH**/ ?>