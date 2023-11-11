<?php
$menu_header = getMenus('menu-header');
$recently_viewed = Session::get('products.recently_viewed');

if (!empty($recently_viewed)) {
    $recentlyProduct = \App\Models\Product::select('id', 'title', 'slug', 'price', 'price_sale', 'price_contact', 'image')
        ->where(['alanguage' => config('app.locale'), 'publish' => 0])
        ->whereIn('id', $recently_viewed)
        ->orderBy('order', 'asc')
        ->orderBy('id', 'desc')
        ->with('getTags')
        ->get();
}
?>
<?php if(svl_ismobile() == 'is desktop'): ?>
<header class="hidden lg:block">
    <div class="py-[7px] bg-[#fff] border-b border-[#ebebeb]">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-2 relative">
                <div class="topbar-left flex items-center">
                    <a href="tel:<?php echo e($fcSystem['contact_hotline']); ?>" class=" hover:text-green-500">
                        <?php echo e($fcSystem['contact_hotline']); ?>

                    </a>
                    <a href="javascript:void(0)" class="relative hover:text-green-500"><?php echo e($fcSystem['contact_address']); ?></a>
                </div>
                <div class="flex justify-end items-center space-x-5">
                    <div class="group cursor-pointer">
                        <a href="javascript:void(0)" class="relative  hover:text-green-500"><?php echo e(trans('index.ProductViewed')); ?></a>
                        <?php if(!empty($recentlyProduct)): ?>

                        <div class="group-hover:block hidden absolute top-full left-0 w-full bg-white shadowC z-10 transition-all p-2">
                            <div class="swiper mySwiper mySwiper-productHeader">
                                <div class="swiper-wrapper">
                                    <?php $__currentLoopData = $recentlyProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $price = getPrice(array('price' => $item->price, 'price_sale' => $item->price_sale, 'price_contact' =>
                                    $item->price_contact));
                                    ?>
                                    <div class="swiper-slide ">
                                        <div class="overflow-hidden img-box">
                                            <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>">
                                                <img class="lazy w-full h-[216px] object-contain" data-src="<?php echo e(asset($item->image)); ?>" alt="<?php echo e($item->title); ?>">
                                            </a>
                                        </div>
                                        <div class="text-right p-[10px] pt-0">
                                            <?php if(count($item->getTags) > 0): ?>
                                            <?php $__currentLoopData = $item->getTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a class="text-[#90908e] text-xs hover:text-green-500" href="<?php echo e(route('tagURL', ['slug' => $val->slug])); ?>">#<?php echo $val->title ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <a class="text-sm font-semibold clamp-2 hover:text-green-500" href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" title="<?php echo e($item->title); ?>"><?php echo e($item->title); ?></a>
                                            <div class="flex justify-end items-center space-x-2">
                                                <div class="flex-1">
                                                    <span class="text-green-500 font-semibold text-sm"><?php echo e($price['price_final']); ?></span>
                                                    <?php if(!empty($price['price_old'])): ?>
                                                    <span class="font-normal text-sm line-through"><?php echo e($price['price_old']); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" data-toggle="tooltip" data-placement="top" type="button" title="Thêm vào giỏ" class="hover:text-white text-green-500 rounded-full bg-[#e8f6ea] border border-green-500 w-10 h-10 text-center hover:bg-green-500 hover:border-green-500 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6   mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>

                        <?php endif; ?>
                    </div>
                    <div class="flex space-x-1 items-center">
                        <?php $__currentLoopData = config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($fcSystem['language_'.$key]); ?>"><img src="<?php echo e(asset($item['image'])); ?>" alt="<?php echo e($item['title']); ?> icon" /></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container mx-auto px-4 py-[10px]">
        <div class="grid grid-cols-12 gap-5 items-center">
            <div class="col-span-2">
                <a href="<?php echo e(url('/')); ?>" class="logo-wrapper">
                    <img width="180" height="32" src="<?php echo e(asset($fcSystem['homepage_logo'])); ?>" alt="<?php echo e($fcSystem['homepage_company']); ?>">
                </a>
            </div>
            <div class="col-span-6">
                <?php echo getHtmlFormSearch(array(
                    'action' => route('homepage.search'),
                    'placeholder' => trans('index.SearchPlaceholder'),
                    'classForm' => '',
                    'classInput' => 'bg-gray-200 rounded-lg border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300 focus:rounded-lg hover:outline-none hover:ring hover:ring-red-300 hover:rounded-lg',
                    'classButton' => 'text-black',
                    'classSvg' => 'text-black',
                )) ?>

            </div>
            <div class="col-span-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-1">
                        <img src="<?php echo e(asset('frontend/images/call_buy_img.png')); ?>" alt="icon hotline">
                        <div>
                            <span class="text-sm">Hotline</span><br>
                            <a href="tel:<?php echo e($fcSystem['contact_hotline']); ?>" class="font-bold text-f15 hover:text-green-500"><?php echo e($fcSystem['contact_hotline']); ?></a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-1 hover:text-green-500 relative cursor-pointer group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <?php if(!empty(Auth::guard('customer')->user())): ?>
                        <div>
                            <a href="<?php echo e(route('customer.dashboard')); ?>" class="font-bold w-20 clamp-1"><?php echo e(Auth::guard('customer')->user()->name); ?></a>
                        </div>
                        <div class="absolute top-full -left-1/2 w-[260px] p-[10px] group-hover:block hidden z-10 bg-white" style="box-shadow: rgb(0 0 0 / 18%) 0px 6px 12px 0px;">
                            <div class="flex flex-col space-y-[10px]">
                                <a href="<?php echo e(route('customer.dashboard')); ?>" class="w-full bg-green-500 hover:bg-green-700 rounded text-white h-10 leading-10 align-middle text-center z-10"><?php echo e(Auth::guard('customer')->user()->name); ?></a>
                                <a href="<?php echo e(route('customer.logout')); ?>" class="w-full bg-green-500 hover:bg-green-700 rounded text-white h-10 leading-10 align-middle text-center z-10"><?php echo e(trans('index.Logout')); ?></a>
                            </div>
                        </div>
                        <?php else: ?>
                        <div>
                            <a href="javascript:void(0)" class="font-bold"><?php echo e(trans('index.Account')); ?></a>
                        </div>
                        <div class="absolute top-full -left-1/2 w-[260px] p-[10px] group-hover:block hidden z-10 bg-white" style="box-shadow: rgb(0 0 0 / 18%) 0px 6px 12px 0px;">
                            <div class="flex flex-col space-y-[10px]">
                                <a href="<?php echo e(route('customer.login')); ?>" class="w-full bg-green-500 hover:bg-green-700 rounded text-white h-10 leading-10 align-middle text-center z-10"><?php echo e(trans('index.Login')); ?></a>
                                <a href="<?php echo e(route('customer.register')); ?>" class="w-full bg-green-500 hover:bg-green-700 rounded text-white h-10 leading-10 align-middle text-center z-10"><?php echo e(trans('index.Register')); ?></a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex items-center space-x-1 relative cursor-pointer tp-cart hover:text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <div>
                            <span class="font-bold"><?php echo e(trans('index.Cart')); ?></span>
                        </div>
                        <span class="absolute w-5 h-5 leading-5 rounded-full bg-[#d61c1f] text-[10px] text-white -right-[10px] -top-[15px] text-center cart-quantity"><?php echo e($cart['quantity']); ?></span>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class="border-b border-[#ebebeb]">
        <div class="container mx-auto px-4 py-[10px]">
            <?php echo getHtmlMenus($menu_header, array(
                'ul' => 'flex lg:flex-grow md:space-x-0 lg:space-x-4',
                'li' => 'text-center',
                'a' => 'px-2 uppercase flex items-center font-medium',
                'hover_color' => 'hover:text-green-500',
                'ul_2' => 'bg-white ',
                'li_2' => 'font-medium',
                'ul_3' => 'bg-white',
                'li_3' => 'font-medium',
            )); ?>
        </div>
    </div>
</header>
<?php else: ?>
<header class="block lg:hidden py-[5px] pt-2">
    <div class="container px-4">
        <div class="flex items-center">
            <div class="w-1/2">
                <a href="/" class="">
                    <img width="180" height="32" data-src="//bizweb.dktcdn.net/100/449/944/themes/855700/assets/logo.png?1664274306195" alt="Wolf Food" class="lazy">
                </a>
            </div>
            <div class="w-1/2">
                <div class="flex items-center space-x-1 justify-end">
                    <img src="<?php echo e(asset('frontend/images/call_buy_img.png')); ?>" alt="icon hotline">
                    <div>
                        <span class="text-sm">Hotline</span><br>
                        <a href="tel:<?php echo e($fcSystem['contact_hotline']); ?>" class="font-bold text-f15 hover:text-green-500"><?php echo e($fcSystem['contact_hotline']); ?></a>
                    </div>
                </div>

            </div>

        </div>
        <div class="mt-[10px]">
            <?php echo getHtmlFormSearch(array(
                'action' => route('homepage.search'),
                'placeholder' => 'Tìm kiếm sản phẩm',
                'classForm' => '',
                'classInput' => 'bg-gray-200 rounded-lg border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300 focus:rounded-lg hover:outline-none hover:ring hover:ring-red-300 hover:rounded-lg',
                'classButton' => 'text-black',
                'classSvg' => 'text-black',
            )) ?>
        </div>

    </div>
    <div class="fixed bottom-0 left-0 z-10 bg-white w-full border-t flex items-center " style="padding: 7px 0 3px;-webkit-transition: .4s;-o-transition: .4s;transition: .4s;">
        <div class="flex-auto text-center">
            <a href="javascript:void(0)" id="ham">
                <img class="w-7 mx-auto" alt="Menu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABmJLR0QA/wD/AP+gvaeTAAACz0lEQVR4nO2ay05TURRAlzCUoYnySnQI/oM6MVER/QqCID5+xYmRGCZ+gvFDQAfGxMdA4xSVgSRF6+DWR08f95ze1qTZayU3oYSz10naXuB0gYiIiIiIyP/lVMP1S8Bt4CZwHljufP8j8AF4ATwHPjX0RPfWsgDsAi2gXXP9AJ4B83onwzrwLWNj6fUVWNM7XnaoXgGlm/t9nQDbesfD+oDN7QP3gBXgdOdaBe4DBwM2WfLKiebNYoHet+13YAOYGbJuBtgEjpO1X8i7x0bzZvO0z+YuFay/3GeTT/SOxhLV2+7f4RsjzNlKZrSARb3l7CSD9xn+th3EDPAymTXsF140759FddxIHu8BP0t311mzVzM7sjebN3Q/yysNZq0ms17rLecoGTrXYNZcMutIbzc5t6x2gw3V+YbdCqJ5+y7ox+fk8XLfn8ojXZvOjuwF8p6Qd8njq9nb6SVd+1ZvOXfpvg8eMNqfgbPAq2TWlt5ylug9dt4cYc52MqNFdUShdwR2k+HHVMcDuVyh9yjhsd7Rmac6IEs3ucXwt/Ms1Ssl3dwhcFZvM9boPeNpUx0PPAAuUh1Fz3W+fkjvPbTdmXFd73jYHrDJ3OsEuKN3vKxRfTxZurlD4JreyXAGeETeh/4tql+S5/TW0zQDWgRuUWUxF+jOYt7zN4up/Q9Vr4iIiIhMDuv36fDWEq1Ct37Xm0e0Ct36XW8e0Sp063e9+USr0K3f9XYvqiNahW79rreMaBW69bvewQv6Ea1Ct37XW0a0Ct36XW850Sp063e95USr0K3f9Y5GtArd+j2y1/p9OrwiIiIi0gjr9+nw1hKtQrd+15tHtArd+l1vHtEqdOt3vflEq9Ct3/V2L6ojWoVu/a63jGgVuvW73sEL+hGtQrd+11tGtArd+l1vOdEqdOt3veVEq9Ct3/WORrQK3fo9stf6fTq8IiIiIiIiE+MXmgfcWZTutEYAAAAASUVORK5CYII=">
                Menu
            </a>
        </div>
        <div class="flex-auto text-center relative">
            <a class="tp-cart" title="<?php echo e(trans('index.Cart')); ?>" href="javascript:void(0)">
                <img class="w-7 mx-auto" alt="<?php echo e(trans('index.Cart')); ?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABmJLR0QA/wD/AP+gvaeTAAAFZElEQVR4nO2dS4sdRRTHf+ONM2N8xMA8EJ0oRkhWRjQQcJcv4cJoIKsgrvMdxHwBYYKgy2SnLpKFxAduBCEYN1mokJfgZDROJJlMMjMu+g5On37cPtX16Hv7/KAXfe9U1Zn631OnTldXNxiGUc1UagOUDIBjwHHgTeAw8ALwzPD7f4HbwDXgJ+Ay8COwGd3SCedl4CxwC9hWHreAj4ED0a2eQBaBc8AGeiHksQEsAwtR/4MJ4iTwN+2FkMdfwHsR/4+xZxr4lPoO/Qw4BRwF5oAnh8f88LNTwOfDv62qZ3lYxqjhaeAS5R34M/AuMKOobwY4AVytqPPisE2jhGnKxfgHOA080aLuAfDBsK4yUcxTSigbpq4ABz228RqZp5UNX8YuTlLspO+BfQHaeh74oaS9EwHaGksWKQbfK4QRY4c54HfR5irZpKD3nKMYM3wOU1W8DtwTbX8Sod1OswQ8JN8ppyO2/6Foe4PsqkBvOUtxattmNqVlAPwibPgoYvudYkDx2lSKwPq+sOEmcX8UneFtihm4JunzxSxwV9hyLIEdQNpfwnFx/iVZPInNOvCV+EzaFo2Ugrwlzr9JYkXGZXF+NIkVpBXkkDi/msSK8ralbb1glfy4PZfQlnlhy0pCW5Ih84/phLbMCFvWUxmSck19W5ynXt/vhD29nG93GROkY5ggHaONIL/R7mYDiY8bGLpiz68N+q8U18A1Bdwnu+xgFFkH9lIudC2uHrKAiVHHLI6LXa6CLDmW6xNOfeRLkG/JhjHNIdGW9320tee7EX3UCF+CXHesZ5KQfZBUkBuO9UwSsg+iCiLvJDdBin3gdLe9qyAvifObyvKvNPwsFj7s8eIhrlwnnwgdUZQ9CNyhmEytAK/6NTOqPUdE+WhxdQ/wSDS+X1H+AtUZ7nmvlsa1Z78o+4isr4JzQDR8T1m+bs/Hqj8zk9izJsqrhy2XGCLjhzagDxy/C4VPe2QsjSJI2xnW1zXfXVLW5QOf9niZaWk5Q94ttbfyH6J8Z9Mdit4XA5/2LIs6zmiNcfGQtknhNbIZyQWyMXeNLHi+gX767AOf9rSe+rrMAqQbukzvbgDvOJQLhS97WguSwkMmmU4IYhcW/8fLBUYNs8AW+cC1N3SjY8TOKuHOsQU8palA6yFL5NcOVsiWco2M+2Szsx2mgBc1FbgIshuLH0VaxRGtIHbZfTStksO2HmIBvUirwG5Dln+iDlkmyGhMkI4RdeVQPrzF7s8qIteL1kI1tE809JhIK2Jjxh6yvtndV881LawZsuT07fawYSPPY+AP8Vnjqa9GEIsfzXGOIyZIGJIIYklhNc7JoXlIGKJ4iF3Hao7z9SzzkDAETw6ngAfk59b2OLxqFsj31Tqe970vigYe+G5gwij7ATd6xHnTIatsuFJvaOwR2zjexdhGEKMepzhigoQjqiCWFI7GKTlsKojlIHqcchEbssJhMaRjBEsOy7awNV5w6THPEmhBTy5J3vVRaU9QL3k3GbJshuWOeqblIojFj+ao40gTQWzK64566mseEpYgHmIxxB2LIR0jioeYIM3xnhzKLWxbpHnHx7gyQ7H/are4jfIQuYXtT9K842NceUj+wf4jt7g1EWQ3FtD1qAL7KEEsB2mPKhfReogJokcV2E2Q8AQVxGKIHq8xxDykPV5zEXk9X/VUAgPInrnlZYub3MK2QZpH8I07A7K+a7TiWjdklW1h22xrXQ/ZRLHFrU4QC+j+aBzYNYJYQHencWA3QeJggnQML4L4eNilkSH7rjKo1924JVX8wtkcQ1LpIVW7oOwtbGGpfItb1ZA1j4kRklkq3o5dJYg95Sc8pX38H11PQuS9ma1PAAAAAElFTkSuQmCC">
                <?php echo e(trans('index.Cart')); ?>

                <span class="absolute w-5 h-5 leading-5 rounded-full bg-[#d61c1f] text-[10px] text-white right-0 top-0 text-center cart-quantity"><?php echo e($cart['quantity']); ?></span>
            </a>
        </div>
        <div class="flex-auto text-center">
            <?php if(!empty(Auth::guard('customer')->user())): ?>
            <a href="<?php echo e(route('customer.dashboard')); ?>" title="<?php echo e(Auth::guard('customer')->user()->name); ?>">
                <img class="w-7 mx-auto" alt="<?php echo e(Auth::guard('customer')->user()->name); ?>" src="data:image/png;base64,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">
                <span class="clamp-1"><?php echo e(Auth::guard('customer')->user()->name); ?></span>
            </a>
            <?php else: ?>
            <a href="<?php echo e(route('customer.login')); ?>" title="<?php echo e(trans('index.Account')); ?>">
                <img class="w-7 mx-auto" alt="<?php echo e(trans('index.Account')); ?>" src="data:image/png;base64,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">
                <?php echo e(trans('index.Account')); ?>

            </a>
            <?php endif; ?>
        </div>
        <div class="flex-auto text-center flex justify-center ">
            <a href="javascript:void(0)" class="js_show_language"><img src="<?php echo e(asset('images/vn-icon.png')); ?>" alt="vn icon" /></a>
            <div class="js_box_language_mobile absolute w-full bg-white -top-[45px] p-3 left-0 hidden">
                <div class="flex space-x-2 items-center justify-end">
                    <a href="<?php echo e($fcSystem['language_vi']); ?>"><img src="<?php echo e(asset('images/vn-icon.png')); ?>" alt="vn icon" /></a>
                    <a href="<?php echo e($fcSystem['language_en']); ?>"><img src="<?php echo e(asset('images/en-icon.png')); ?>" alt="en icon" /></a>
                    <a href="<?php echo e($fcSystem['language_tl']); ?>"><img src="<?php echo e(asset('images/thai-icon.png')); ?>" alt="thai icon" /></a>
                    <a href="<?php echo e($fcSystem['language_gm']); ?>"><img src="<?php echo e(asset('images/gm-icon.png')); ?>" alt="gm icon" /></a>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('homepage.common.menuMobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</header>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/homepage/common/header.blade.php ENDPATH**/ ?>