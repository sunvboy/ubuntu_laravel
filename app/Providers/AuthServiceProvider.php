<?php

namespace App\Providers;

use App\Models\ProductConfig;
use App\Policies\AddressPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\CategoryAttributePolicy;
use App\Policies\CategoryProductPolicy;
use App\Policies\AttributePolicy;
use App\Policies\BrandPolicy;
use App\Policies\CartPolicy;
use App\Policies\CategoryArticlePolicy;
use App\Policies\CategoryMediaPolicy;
use App\Policies\CommentPolicy;
use App\Policies\CouponPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\MediaPolicy;
use App\Policies\MenuPolicy;
use App\Policies\OrderPolicy;
use App\Policies\PagePolicy;
use App\Policies\ProductPolicy;
use App\Policies\RolePolicy;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use App\Policies\ContactPolicy;
use App\Policies\CustomerLogsPolicy;
use App\Policies\SlidePolicy;
use App\Policies\GeneralPolicy;
use App\Policies\OrderConfigPolicy;
use App\Policies\OrderLogPolicy;
use App\Policies\OrderPaymentPolicy;
use App\Policies\ProductConfigPolicy;
use App\Policies\ShipPolicy;
use App\Policies\WebsitePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();
        $this->gateProductCategory();
        //thuộc tính
        $this->gateAttributeCategory();
        $this->gateAttribute();
        //sản phẩm
        $this->gateProductCategory();
        $this->gateProduct();
        //tag
        $this->gateTag();
        //brand
        $this->gateBrand();
        $this->gateRole();
        $this->gateUser();
        $this->gateArticleCategory();
        $this->gateArticle();
        $this->gateCoupon();
        $this->gatePage();
        $this->gateAddress();
        $this->gateMenu();
        $this->gateOrder();
        $this->gateOrderLogs();
        $this->gateOrderConfigs();
        $this->gateOrderPayment();
        $this->gateComment();
        $this->gateCustomer();
        $this->gateCustomerLogs();
        $this->gateMedia();
        $this->gateMediaCategory();
        $this->gateContact();
        $this->gateSlide();
        $this->gateGeneral();
        $this->gateShip();
        $this->gateWebsite();
        $this->gateCart();
        $this->gateProductConfig();
        // Gate::define('category_products_index', function ($user) {
        //     return $user->checkPermissionAccess(config('permissions.category_products.index'));
        // });
        // Gate::define('category_products_create', function ($user) {
        //     return $user->checkPermissionAccess(config('permissions.category_products.create'));
        // });
        // Gate::define('category_products_edit', function ($user) {
        //     return $user->checkPermissionAccess(config('permissions.category_products.edit'));
        // });
        // Gate::define('category_products_destroy', function ($user) {
        //     return $user->checkPermissionAccess(config('permissions.category_products.destroy'));
        // });


    }
    public function gateProductConfig()
    {
        Gate::define('product_configs_index', [ProductConfigPolicy::class, 'index']);
        Gate::define('product_configs_create', [ProductConfigPolicy::class, 'create']);
        Gate::define('product_configs_edit', [ProductConfigPolicy::class, 'edit']);
        Gate::define('product_configs_destroy', [ProductConfigPolicy::class, 'destroy']);
    }
    public function gateWebsite()
    {
        Gate::define('websites_index', [WebsitePolicy::class, 'index']);
        Gate::define('websites_create', [WebsitePolicy::class, 'create']);
        Gate::define('websites_edit', [WebsitePolicy::class, 'edit']);
        Gate::define('websites_destroy', [WebsitePolicy::class, 'destroy']);
    }
    public function gateArticleCategory()
    {
        Gate::define('category_articles_index', [CategoryArticlePolicy::class, 'index']);
        Gate::define('category_articles_create', [CategoryArticlePolicy::class, 'create']);
        Gate::define('category_articles_edit', [CategoryArticlePolicy::class, 'edit']);
        Gate::define('category_articles_destroy', [CategoryArticlePolicy::class, 'destroy']);
    }
    public function gateArticle()
    {
        Gate::define('articles_index', [ArticlePolicy::class, 'index']);
        Gate::define('articles_create', [ArticlePolicy::class, 'create']);
        Gate::define('articles_edit', [ArticlePolicy::class, 'edit']);
        Gate::define('articles_destroy', [ArticlePolicy::class, 'destroy']);
    }
    public function gateAttributeCategory()
    {
        Gate::define('category_attributes_index', [CategoryAttributePolicy::class, 'index']);
        Gate::define('category_attributes_create', [CategoryAttributePolicy::class, 'create']);
        Gate::define('category_attributes_edit', [CategoryAttributePolicy::class, 'edit']);
        Gate::define('category_attributes_destroy', [CategoryAttributePolicy::class, 'destroy']);
    }
    public function gateAttribute()
    {
        Gate::define('attributes_index', [AttributePolicy::class, 'index']);
        Gate::define('attributes_create', [AttributePolicy::class, 'create']);
        Gate::define('attributes_edit', [AttributePolicy::class, 'edit']);
        Gate::define('attributes_destroy', [AttributePolicy::class, 'destroy']);
    }
    public function gateProductCategory()
    {
        Gate::define('category_products_index', [CategoryProductPolicy::class, 'index']);
        Gate::define('category_products_create', [CategoryProductPolicy::class, 'create']);
        Gate::define('category_products_edit', [CategoryProductPolicy::class, 'edit']);
        Gate::define('category_products_destroy', [CategoryProductPolicy::class, 'destroy']);
    }
    public function gateProduct()
    {
        Gate::define('products_index', [ProductPolicy::class, 'index']);
        Gate::define('products_create', [ProductPolicy::class, 'create']);
        Gate::define('products_edit', [ProductPolicy::class, 'edit']);
        Gate::define('products_destroy', [ProductPolicy::class, 'destroy']);
    }
    public function gateRole()
    {
        Gate::define('roles_index', [RolePolicy::class, 'index']);
        Gate::define('roles_create', [RolePolicy::class, 'create']);
        Gate::define('roles_edit', [RolePolicy::class, 'edit']);
        Gate::define('roles_destroy', [RolePolicy::class, 'destroy']);
    }
    public function gateUser()
    {
        Gate::define('users_index', [UserPolicy::class, 'index']);
        Gate::define('users_create', [UserPolicy::class, 'create']);
        Gate::define('users_edit', [UserPolicy::class, 'edit']);
        Gate::define('users_destroy', [UserPolicy::class, 'destroy']);
    }
    public function gateTag()
    {
        Gate::define('tags_index', [TagPolicy::class, 'index']);
        Gate::define('tags_create', [TagPolicy::class, 'create']);
        Gate::define('tags_edit', [TagPolicy::class, 'edit']);
        Gate::define('tags_destroy', [TagPolicy::class, 'destroy']);
    }
    public function gateBrand()
    {
        Gate::define('brands_index', [BrandPolicy::class, 'index']);
        Gate::define('brands_create', [BrandPolicy::class, 'create']);
        Gate::define('brands_edit', [BrandPolicy::class, 'edit']);
        Gate::define('brands_destroy', [BrandPolicy::class, 'destroy']);
    }
    public function gateCoupon()
    {
        Gate::define('coupons_index', [CouponPolicy::class, 'index']);
        Gate::define('coupons_create', [CouponPolicy::class, 'create']);
        Gate::define('coupons_edit', [CouponPolicy::class, 'edit']);
        Gate::define('coupons_destroy', [CouponPolicy::class, 'destroy']);
    }
    public function gatePage()
    {
        Gate::define('pages_index', [PagePolicy::class, 'index']);
        Gate::define('pages_create', [PagePolicy::class, 'create']);
        Gate::define('pages_edit', [PagePolicy::class, 'edit']);
        Gate::define('pages_destroy', [PagePolicy::class, 'destroy']);
    }
    public function gateAddress()
    {
        Gate::define('addresses_index', [AddressPolicy::class, 'index']);
        Gate::define('addresses_create', [AddressPolicy::class, 'create']);
        Gate::define('addresses_edit', [AddressPolicy::class, 'edit']);
        Gate::define('addresses_destroy', [AddressPolicy::class, 'destroy']);
    }
    public function gateMenu()
    {
        Gate::define('menus_index', [MenuPolicy::class, 'index']);
        Gate::define('menus_create', [MenuPolicy::class, 'create']);
        Gate::define('menus_edit', [MenuPolicy::class, 'edit']);
        Gate::define('menus_destroy', [MenuPolicy::class, 'destroy']);
    }
    public function gateOrder()
    {
        Gate::define('orders_index', [OrderPolicy::class, 'index']);
        Gate::define('orders_create', [OrderPolicy::class, 'create']);
        Gate::define('orders_edit', [OrderPolicy::class, 'edit']);
        Gate::define('orders_destroy', [OrderPolicy::class, 'destroy']);
    }
    public function gateOrderLogs()
    {
        Gate::define('order_logs_index', [OrderLogPolicy::class, 'index']);
        Gate::define('order_logs_destroy', [OrderLogPolicy::class, 'destroy']);
    }
    public function gateOrderConfigs()
    {
        Gate::define('order_configs_index', [OrderConfigPolicy::class, 'index']);
    }
    public function gateOrderPayment()
    {
        Gate::define('orders_payment_index', [OrderPaymentPolicy::class, 'index']);
    }
    public function gateComment()
    {
        Gate::define('comments_index', [CommentPolicy::class, 'index']);
        Gate::define('comments_create', [CommentPolicy::class, 'create']);
        Gate::define('comments_edit', [CommentPolicy::class, 'edit']);
        Gate::define('comments_destroy', [CommentPolicy::class, 'destroy']);
    }
    public function gateCustomer()
    {
        Gate::define('customers_index', [CustomerPolicy::class, 'index']);
        Gate::define('customers_create', [CustomerPolicy::class, 'create']);
        Gate::define('customers_edit', [CustomerPolicy::class, 'edit']);
        Gate::define('customers_destroy', [CustomerPolicy::class, 'destroy']);
    }
    public function gateCustomerLogs()
    {
        Gate::define('customer_logs_index', [CustomerLogsPolicy::class, 'index']);
        Gate::define('customer_logs_destroy', [CustomerLogsPolicy::class, 'destroy']);
    }
    public function gateMedia()
    {
        Gate::define('media_index', [MediaPolicy::class, 'index']);
        Gate::define('media_create', [MediaPolicy::class, 'create']);
        Gate::define('media_edit', [MediaPolicy::class, 'edit']);
        Gate::define('media_destroy', [MediaPolicy::class, 'destroy']);
    }
    public function gateMediaCategory()
    {
        Gate::define('category_media_index', [CategoryMediaPolicy::class, 'index']);
        Gate::define('category_media_create', [CategoryMediaPolicy::class, 'create']);
        Gate::define('category_media_edit', [CategoryMediaPolicy::class, 'edit']);
        Gate::define('category_media_destroy', [CategoryMediaPolicy::class, 'destroy']);
    }
    public function gateContact()
    {
        Gate::define('contacts_index', [ContactPolicy::class, 'index']);
    }
    public function gateSlide()
    {
        Gate::define('slides_index', [SlidePolicy::class, 'index']);
    }
    public function gateGeneral()
    {
        Gate::define('generals_index', [GeneralPolicy::class, 'index']);
    }
    public function gateShip()
    {
        Gate::define('ships_index', [ShipPolicy::class, 'index']);
        Gate::define('ships_create', [ShipPolicy::class, 'create']);
        Gate::define('ships_edit', [ShipPolicy::class, 'edit']);
        Gate::define('ships_destroy', [ShipPolicy::class, 'destroy']);
    }
    public function gateCart()
    {
        Gate::define('carts_index', [CartPolicy::class, 'index']);
        Gate::define('carts_create', [CartPolicy::class, 'create']);
        Gate::define('carts_edit', [CartPolicy::class, 'edit']);
        Gate::define('carts_destroy', [CartPolicy::class, 'destroy']);
    }
}
