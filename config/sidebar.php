<?php
return [
    //Khách hàng
    'customers' => [
        'title' => 'Khách hàng',
        'icon' => 'ri-shield-user-fill',
        'data' => [
            'customer_categories' =>  [
                'title' => 'Nhóm khách hàng',
                'can' => 'customer_categories',
                'route' => 'customer_categories.index',
                'menu' => ['customer-categories'],
                'dropdown' => false,
                'active' => true
            ],
            'customers' =>  [
                'can' => 'customers',
                'route' => 'customers.index',
                'menu' => ['customers'],
                'dropdown' => true,
                'active' => true
            ]
        ]
    ],
    //Bài viết
    'articles' => [
        'title' => 'Bài viết',
        'icon' => 'ri-article-fill',
        'data' => [
            'category_articles' =>  [
                'can' => 'category_articles',
                'route' => 'category_articles.index',
                'menu' => ['category-articles'],
                'dropdown' => true,
                'active' => true
            ],
            'articles' =>  [
                'can' => 'articles',
                'route' => 'articles.index',
                'menu' => ['articles'],
                'dropdown' => true,
                'active' => true
            ],
        ]
    ],
    //Sản phẩm
    'brands' => [
        'title' => "Nhà cung cấp",
        'icon' => 'ri-product-hunt-fill',
        'data' => [
            //Thương hiệu
            'brands' => [
                'can' => 'brands_index',
                'route' => 'brands.index',
                'menu' => ['brands'],
                'dropdown' => true,
                'active' => true
            ],
        ]
    ],
    //Sản phẩm
    'products' => [
        'title' => "Sản phẩm",
        'icon' => 'ri-product-hunt-fill',
        'data' => [
            // Cấu hình sản phẩm
            'product_configs' => [
                'can' => 'product_configs',
                'route' => 'product_configs.index',
                'menu' => ['product-configs'],
                'dropdown' => true,
                'active' => true
            ],
            //Danh mục sản phẩm
            'category_products' => [
                'can' => 'category_products_index',
                'route' => 'category_products.index',
                'menu' => ['category-products'],
                'dropdown' => true,
                'active' => true
            ],
            //Sản phẩm
            'products' => [
                'can' => 'products_index',
                'route' => 'products.index',
                'menu' => ['products'],
                'dropdown' => true,
                'active' => true

            ],
            // Mã giảm giá
            'coupons' => [
                'can' => 'coupons',
                'route' => 'coupons.index',
                'menu' => ['coupons'],
                'dropdown' => true,
                'active' => true
            ],
            //Thuộc tính
            'category_attributes' => [
                'title' => 'Nhóm thuộc tính',
                'can' => 'category_attributes_index',
                'route' => 'category_attributes.index',
                'menu' => ['category-attributes'],
                'dropdown' => true,
                'active' => true
            ],
            'attributes' => [
                'title' => 'Thuộc tính',
                'can' => 'attributes',
                'route' => 'attributes.index',
                'menu' => ['attributes'],
                'dropdown' => true,
                'active' => true
            ],

        ]
    ],
    //Đơn hàng
    'orders' => [
        'title' => "Đơn hàng",
        'icon' => 'ri-luggage-cart-fill',
        'data' => [
            'orders' => [
                'title' => 'Danh sách đơn hàng',
                'can' => 'orders_index',
                'route' => 'orders.index',
                'menu' => ['orders'],
                'dropdown' => true,
                'active' => true
            ],
            // 'orders_returns' => [
            //     'title' => 'Hoàn/trả hàng',
            //     'route' => 'orders.returns',
            //     'menu' => ['orders-returns'],
            //     'dropdown' => false,
            //     'active' => true
            // ],
            //Lịch sử thanh toán
            'orders_payment' => [
                'title' => 'Lịch sử thanh toán',
                'can' => 'orders_payment',
                'route' => 'orders.payment',
                'menu' => ['orders-payment'],
                'dropdown' => true,
                'active' => true
            ],
        ]
    ],
    //Media
    'media' => [
        'title' => "Quản lý Media",
        'data' => [
            'category_media' => [
                'title' => 'Danh mục media',
                'can' => 'category_media_index',
                'route' => 'category_media.index',
                'menu' => ['category-media'],
                'dropdown' => true,
                'active' => true
            ],
            'media' => [
                'title' => 'Danh sách',
                'can' => 'media',
                'route' => 'media.index',
                'menu' => ['media'],
                'dropdown' => true,
                'active' => true
            ],

        ]
    ],
    //Quản lý Trang
    'pages' => [
        'title' => "Trang",
        'icon' => 'ri-pages-line',
        'route' => 'pages.index',
        'can' => 'pages_index',
        'menu' => ['pages'],
        'dropdown' => true,
        'active' => true

    ],
    //Liên hệ
    'contacts' => [
        'title' => "Liên hệ",
        'icon' => 'ri-contacts-book-fill',
        'data' => [
            'contacts' => [
                'title' => 'Danh sách liên hệ',
                'can' => 'contacts_index',
                'route' => 'contacts.index',
                'menu' => ['contacts'],
                'dropdown' => true,
                'active' => true
            ],
            // 'subscribers' => [
            //     'title' => 'Đăng ký gửi email',
            //     'can' => 'contacts_index',
            //     'route' => 'subscribers.index',
            //     'menu' => ['subscribers'],
            //     'dropdown' => false,
            //     'active' => true
            // ],
            // 'books' => [
            //     'title' => 'Đăng kí đại lý',
            //     'can' => 'contacts_index',
            //     'route' => 'books.index',
            //     'menu' => ['books'],
            //     'dropdown' => false,
            //     'active' => true
            // ],
        ]
    ],
    //Tag
    'tags' => [
        'title' => "Tags",
        'can' => 'tags_index',
        'route' => 'tags.index',
        'active' => true,
    ],
    //Quản lý Comment
    'comments' => [
        'title' => "Comment",
        'icon' => 'ri-file-list-fill',
        'data' => [
            'comments' => [
                'title' => 'Sản phẩm',
                'can' => 'comments_index',
                'route' => 'comments.index',
                'menu' => ['comments/index/products'],
                'dropdown' => true,
                'active' => true,
                'type' => 'products'
            ]
        ]
    ],
    //Quản lý slide
    'slides' => [
        'title' => "Banner & Slide",
        'can' => 'slides_index',
        'route' => 'slides.index',
        'active' => true,
    ],
    //Quản lý Menu
    'menus' => [
        'title' => "Menu",
        'icon' => 'ri-list-settings-line',
        'can' => 'menus_index',
        'route' => 'menus.index',
        'active' => true,
    ],
    //Quản lý thành viên
    'users' => [
        'title' => "Thành viên",
        'icon' => 'ri-account-pin-box-fill',
        'data' => [
            'users' => [
                'title' => 'Nhóm thành viên',
                'can' => 'roles_index',
                'route' => 'roles.index',
                'menu' => ['roles'],
                'dropdown' => true,
                'active' => true,
            ],
            'roles' => [
                'title' => 'Thành viên',
                'can' => 'users_index',
                'route' => 'users.index',
                'menu' => ['users'],
                'dropdown' => true,
                'active' => true,
            ],
        ]
    ],
];
