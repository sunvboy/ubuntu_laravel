<?php $__env->startSection('content'); ?>
<?php
$listAlbums = json_decode($detail->image_json, true);
$price = getPrice(array('price' => $detail->price, 'price_sale' => $detail->price_sale, 'price_contact' => $detail->price_contact));
if (count($detail->product_versions) > 0) {
    $type = 'variable';
} else {
    $type = 'simple';
}

$version = json_decode(base64_decode($detail['version_json']), true);
$attribute_tmp = [];
$attributesID =  [];
if (!empty($version) && !empty($version[2])) {
    foreach ($version[2] as $item) {
        foreach ($item as $val) {
            $attributesID[] = $val;
        }
    }
    if (!empty($attributesID)) {
        $attribute_tmp = \App\Models\Attribute::whereIn('id', $attributesID)->select('id', 'title', 'catalogueid')->with('catalogue')->get();
    }
}
$attributes = [];
if (!empty($attribute_tmp)) {
    foreach ($attribute_tmp as $item) {
        $attributes[] = array(
            'id' => $item->id,
            'title' => $item->title,
            'titleC' => $item->catalogue->title,
        );
    }
}
$attributes = collect($attributes)->groupBy('titleC')->all();
$ishomeCategoryArticle = Cache::remember('ishomeCategoryArticle', 600, function () {
    $ishomeCategoryArticle =
        \App\Models\CategoryArticle::select('id', 'title', 'slug')
        ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'ishome' => 1])
        ->orderBy('order', 'asc')
        ->orderBy('order', 'asc')
        ->with('posts')
        ->first();
    return $ishomeCategoryArticle;
});
$slideSame = Cache::remember('slideSame', 600, function () {
    $slideSame = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'same'])->with('slides')->first();
    return $slideSame;
});
?>
<input type="hidden" value="<?php echo $detail->id ?>" id="detailProductID">
<nav class="relative w-full flex flex-wrap items-center justify-between py-3 bg-gray-100 text-gray-500 hover:text-gray-700 focus:text-gray-700 navbar navbar-expand-lg navbar-light">
    <div class="container px-4 mx-auto w-full flex items-center justify-between">
        <nav class="bg-grey-light w-full" aria-label="breadcrumb">
            <ol class="list-reset flex">
                <li><a href="<?php echo url('') ?>" class="text-blue font-bold text-f13"><?php echo e(trans('index.home')); ?></a></li>
                <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li><a href="<?php echo route('routerURL', ['slug' => $v->slug]) ?>" class="text-gray-500 hover:text-gray-600  text-f13"><?php echo e($v->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li><a href="<?php echo route('routerURL', ['slug' => $detail->slug]) ?>" class="text-[#3bb77e] hover:text-green-500  text-f13"><?php echo e($detail->title); ?></a></li>
            </ol>
        </nav>
    </div>
</nav>
<main class="py-8">
    <div class=" container mx-auto px-4">
        <section class="grid grid-cols-1 md:grid-cols-12 space-y-8 md:space-y-0 md:gap-8">
            <div class="md:col-span-12">
                <h1 class="font-semibold text-2xl border-b border-[#e5e5e5] pb-2"><?php echo e($detail->title); ?></h1>
            </div>
            <div class="col-span-1 md:col-span-12 lg:col-span-4">
                <!-- START: slide images product PC-->
                <div class="overflow-hidden ">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2 mySwiperProduct2 overflow-hidden">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide ">
                                <img src="<?php echo e(asset($detail->image)); ?>" alt="<?php echo e($detail->title); ?>" class="w-full object-cover h-full" />
                            </div>
                            <?php if(!empty($listAlbums)): ?>
                            <?php $__currentLoopData = $listAlbums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide ">
                                <img src="<?php echo e($item); ?>" alt="<?php echo e($detail->title); ?>" class="w-full object-cover h-full" />
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper mySwiperProduct mt-2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide ">
                                <img src="<?php echo e(asset($detail->image)); ?>" alt="<?php echo e($detail->title); ?>" />
                            </div>
                            <?php if(!empty($listAlbums)): ?>
                            <?php $__currentLoopData = $listAlbums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide ">
                                <img src="<?php echo e($item); ?>" alt="<?php echo e($detail->title); ?>" />
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                </div>
                <!-- Swiper JS -->
            </div>
            <div class="col-span-1 md:col-span-6 lg:col-span-5">
                <div class="flex-1 overflow-auto">
                    <div class="flex flex-col space-y-4">
                        <div class="flex flex-col space-y-3">
                            <div class="flex flex-col">
                                <div class="section-subtitle flex text-gray-20 mt-1 flex-wrap divide">
                                    <span class="mr-3 text-ui">
                                        <?php echo e(trans('index.Code')); ?>: <span class="js_product_code text-d61c1f"><?php echo e(!empty($detail->code)?$detail->code:trans('index.Updating').'...'); ?></span>
                                    </span>
                                    <?php if($brand): ?>
                                    <span class="mr-3 text-ui">
                                        <?php echo e(trans('index.Brands')); ?>: <a href="<?php echo e(route('brandURL',['slug' => $brand->slug])); ?>" class=" text-d61c1f"><?php echo e($brand->title); ?></a>
                                    </span>
                                    <?php endif; ?>
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <a href="javascript:void(0)" class="text-blue-400 cursor-pointer scrollCmt">
                                                <?php echo e($comment_view['totalComment']); ?> <?php echo e(trans('index.Comment')); ?>

                                            </a>
                                        </div>

                                    </div>
                                </div>
                                <?php if(!empty(Auth::guard('customer')->user())): ?>
                                <!-- Giá sản phẩm -->
                                <div class="mt-1 flex items-center">
                                    <span class="text-red-600 text-2xl font-extrabold js_product_price_final">
                                        <?php echo e($price['price_final']); ?><?php if (!empty($detail->unit)) { ?>/<?php echo e($detail->unit); ?><?php } ?>
                                    </span>
                                    <div class="ml-2">
                                        <span class="line-through text-lg js_product_price_old">
                                            <?php echo e($price['price_old']); ?>

                                        </span>

                                        <span class="text-2xl text-red-600 ml-1 js_product_percent">
                                            <?php if(!empty($price['percent'])): ?>
                                            -<?php echo e($price['percent']); ?>

                                            <?php endif; ?>
                                        </span>

                                    </div>
                                </div>
                                <!--END: Giá sản phẩm -->
                                <?php else: ?>
                                <div class="mt-1 flex items-center">
                                    <span class="text-red-600 text-2xl font-extrabold js_product_price_final">
                                        <?php echo e(trans('index.Contact')); ?>

                                    </span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php if($detail->description): ?>
                            <div class="bg-red-50 rounded-lg px-4 py-3">
                                <?php echo $detail->description ?>
                            </div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="mt-3 <?php if(empty(Auth::guard('customer')->user())): ?> disabledLogin <?php endif; ?>">
                        <!--START: product version -->
                        <?php if ($type == 'variable' && !empty($attributes)) { ?>
                            <?php $i = 0;
                            foreach ($attributes as $key => $item) {
                                $i++;
                            ?>
                                <?php if (count($item) > 0) { ?>
                                    <div class="box-variable mb-3">
                                        <div class="font-bold text-base mb-1"><?php echo e($key); ?></div>
                                        <div class="flex flex-wrap space-x-2">
                                            <?php foreach ($item as $k => $val) { ?>
                                                <a href="javascript:void(0)" class="js_item_variable js_item_variable_<?php echo e($val['id']); ?> py-1 px-5 border 
                                                <?php if ($k == 0) { ?>checked<?php } ?> " data-id="<?php echo e($val['id']); ?>" data-stt="<?php echo !empty($i == count($attributes)) ? 1 : 0 ?>">
                                                    <?php echo e($val['title']); ?>

                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php
                            } ?>
                        <?php } ?>
                        <?php if ($type == 'simple') { ?>
                            <?php
                            $hiddenAddToCart = 0;
                            $product_stock_title = '';
                            $quantityStock = '';
                            if ($detail->inventory == 1) {
                                if ($detail->inventoryPolicy == 0) {
                                    if ($detail->inventoryQuantity == 0) {
                                        $hiddenAddToCart = 1;
                                        $product_stock_title =  '<span class="product_stock">' . trans('index.OutOfStock') . '</span>';
                                    } else {
                                        $quantityStock = $detail->inventoryQuantity;
                                        $product_stock_title = '<span class="product_stock">' . $detail->inventoryQuantity . '</span> ' . trans('index.InOfStock');
                                    }
                                } else {
                                    $product_stock_title = '<span class="product_stock"></span> ' . trans('index.InOfStock');
                                }
                            } else {
                                $product_stock_title = '<span class="product_stock"></span> ' . trans('index.InOfStock');
                            }
                            ?>
                        <?php } ?>
                        <!--END: product version -->
                    </div>

                    <div class="product-details w-full py-4">
                        <div class="<?php if(empty(Auth::guard('customer')->user())): ?> disabledLogin <?php endif; ?>">
                            <div class="font-black mb-2"><?php echo e(trans('index.Amount')); ?></div>
                            <div class="flex items-center">
                                <div class="custom-number-input h-10 w-32 flex flex-row rounded-lg relative bg-transparent mt-1">
                                    <button class="card-dec bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none flex items-center justify-center">
                                        <span class="m-auto text-2xl font-thin">−</span>
                                    </button>
                                    <input type="number" max="<?php echo e(!empty($quantityStock)?$quantityStock:''); ?>" class="card-quantity outline-none focus:outline-none text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" value="1"></input>
                                    <button class="card-inc bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer flex items-center justify-center">
                                        <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                                <div class="ml-2 text-red-600 font-bold">
                                    <?php if($type == 'simple'): ?>
                                    <?php
                                    echo $product_stock_title;
                                    ?>
                                    <?php else: ?>
                                    <span class="js_product_stock"><?php echo e(trans('index.InOfStock')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php if(!empty(Auth::guard('customer')->user())): ?>
                        <div class="mt-5 flex items-center w-full space-x-2">
                            <button data-quantity="1" data-id="<?php echo e($detail->id); ?>" data-title="<?php echo e($detail->title); ?>" data-price="<?php echo !empty($price['price_final_none_format']) ? $price['price_final_none_format'] : 0 ?>" data-cart="0" data-src="" data-type="<?php echo e($type); ?>" class="addtocart uppercase font-black h-12 w-1/2 text-white bg-red-600 flex-1 cursor-pointer items-center inline-flex rounded-md px-6 justify-center">
                                <?php echo e(trans('index.AddToCart')); ?>

                            </button>
                            <button data-quantity="1" data-id="<?php echo e($detail->id); ?>" data-title="<?php echo e($detail->title); ?>" data-price="<?php echo !empty($price['price_final_none_format']) ? $price['price_final_none_format'] : 0 ?>" data-cart="1" data-src="" data-type="<?php echo e($type); ?>" class="addtocart uppercase font-black h-12 w-1/2 text-white bg-black flex-1 cursor-pointer items-center inline-flex rounded-md px-6 justify-center">
                                <?php echo e(trans('index.BuyNow')); ?>

                            </button>
                        </div>
                        <?php else: ?>
                        <div class="mt-5 flex items-center float-left">
                            <a href="<?php echo e(route('customer.login')); ?>" class=" uppercase font-black h-12 w-1/2 text-white bg-red-600 flex-1 cursor-pointer items-center inline-flex rounded-md px-6 justify-center">
                                <?php echo e(trans('index.Login')); ?>

                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <style>
                .svg-bg {
                    filter: drop-shadow(rgba(0, 0, 0, 0.15) 0px 1px 3px);
                    width: 100%;
                    height: 104px;
                }
            </style>
            <?php if($slideSame && count($slideSame->slides) > 0): ?>
            <div class="col-span-1 md:col-span-6 lg:col-span-3">
                <div class="bg-[#f4f6f8] p-[10px] rounded-md">
                    <div class="text-[#2F80ED] text-f15 font-font uppercase text-center flex items-center">
                        <img height="24" width="24" class="lazy" data-src="<?php echo e(asset('frontend/images/product_promotion_title_img.svg' )); ?>" alt="<?php echo e($slideSame->title); ?>">
                        <span><?php echo e($slideSame->title); ?></span>
                    </div>
                    <div class="flex flex-col space-y-5 lg:space-y-0 mt-5 lg:mt-0">

                        <?php $__currentLoopData = $slideSame->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class=" relative">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 524 145.001" class="svg-bg">
                                <path d="M110,144H12A12,12,0,0,1,0,132V12A12,12,0,0,1,12,0h98a12.02,12.02,0,0,0,12,11.971A12.02,12.02,0,0,0,134,0H511a12,12,0,0,1,12,12V132a12,12,0,0,1-12,12H134v-.03a12,12,0,0,0-24,0V144Z" transform="translate(0.5 0.5)" fill="#fff" stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1"></path>
                            </svg>
                            <div class="flex items-center absolute top-1/2 left-0 -translate-y-1/2">
                                <div class="w-[100px] lg:w-[75px] h-[104px] flex justify-center items-center p-[5px] pl-0 relative text-center">

                                    <?php if($key == 0): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 104.554 125.395" class="w-full overflow-hidden">
                                        <path d="M95.424,124.4H47.593l-33.592,0a12,12,0,0,1-12-12V12A12,12,0,0,1,14,0H80.785l.255,0H95.424a10.364,10.364,0,0,0,10.129,10.165l-.005,4.374a2.907,2.907,0,1,0,0,5.813v2.324a2.907,2.907,0,1,0,0,5.814v2.324a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.912v2.324a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.911v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.912,2.912,0,0,0,2.915,2.9V55.22a2.907,2.907,0,1,0,0,5.813v2.324a2.907,2.907,0,1,0,0,5.813V71.5a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.912v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.912,2.912,0,0,0,2.915,2.9v2.324a2.907,2.907,0,1,0,0,5.814V95.9a2.907,2.907,0,1,0,0,5.814v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.916,2.916,0,0,0,2.915,2.911l0,3.987A10.328,10.328,0,0,0,95.423,124.2c0,.065,0,.131,0,.2h0Z" transform="translate(-1.501 0.499)" fill="#23c16b" stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1"></path>
                                    </svg>
                                    <?php elseif($key == 1): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 104.554 125.395" class="w-full overflow-hidden">
                                        <path d="M95.424,124.4H47.593l-33.592,0a12,12,0,0,1-12-12V12A12,12,0,0,1,14,0H80.785l.255,0H95.424a10.364,10.364,0,0,0,10.129,10.165l-.005,4.374a2.907,2.907,0,1,0,0,5.813v2.324a2.907,2.907,0,1,0,0,5.814v2.324a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.912v2.324a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.911v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.912,2.912,0,0,0,2.915,2.9V55.22a2.907,2.907,0,1,0,0,5.813v2.324a2.907,2.907,0,1,0,0,5.813V71.5a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.912v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.912,2.912,0,0,0,2.915,2.9v2.324a2.907,2.907,0,1,0,0,5.814V95.9a2.907,2.907,0,1,0,0,5.814v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.916,2.916,0,0,0,2.915,2.911l0,3.987A10.328,10.328,0,0,0,95.423,124.2c0,.065,0,.131,0,.2h0Z" transform="translate(-1.501 0.499)" fill="#48a7f8" stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1"></path>
                                    </svg>
                                    <?php elseif($key == 2): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 104.554 125.395" class="w-full overflow-hidden">
                                        <path d="M95.424,124.4H47.593l-33.592,0a12,12,0,0,1-12-12V12A12,12,0,0,1,14,0H80.785l.255,0H95.424a10.364,10.364,0,0,0,10.129,10.165l-.005,4.374a2.907,2.907,0,1,0,0,5.813v2.324a2.907,2.907,0,1,0,0,5.814v2.324a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.912v2.324a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.911v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.912,2.912,0,0,0,2.915,2.9V55.22a2.907,2.907,0,1,0,0,5.813v2.324a2.907,2.907,0,1,0,0,5.813V71.5a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.912v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.912,2.912,0,0,0,2.915,2.9v2.324a2.907,2.907,0,1,0,0,5.814V95.9a2.907,2.907,0,1,0,0,5.814v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.916,2.916,0,0,0,2.915,2.911l0,3.987A10.328,10.328,0,0,0,95.423,124.2c0,.065,0,.131,0,.2h0Z" transform="translate(-1.501 0.499)" fill="#6b4eff" stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1"></path>
                                    </svg>
                                    <?php else: ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 104.554 125.395" class="w-full overflow-hidden">
                                        <path d="M95.424,124.4H47.593l-33.592,0a12,12,0,0,1-12-12V12A12,12,0,0,1,14,0H80.785l.255,0H95.424a10.364,10.364,0,0,0,10.129,10.165l-.005,4.374a2.907,2.907,0,1,0,0,5.813v2.324a2.907,2.907,0,1,0,0,5.814v2.324a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.912v2.324a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.911v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.912,2.912,0,0,0,2.915,2.9V55.22a2.907,2.907,0,1,0,0,5.813v2.324a2.907,2.907,0,1,0,0,5.813V71.5a2.907,2.907,0,0,0-2.06.852,2.874,2.874,0,0,0-.855,2.05,2.917,2.917,0,0,0,2.915,2.912v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.912,2.912,0,0,0,2.915,2.9v2.324a2.907,2.907,0,1,0,0,5.814V95.9a2.907,2.907,0,1,0,0,5.814v2.324a2.906,2.906,0,0,0-2.06.852,2.876,2.876,0,0,0-.855,2.051,2.916,2.916,0,0,0,2.915,2.911l0,3.987A10.328,10.328,0,0,0,95.423,124.2c0,.065,0,.131,0,.2h0Z" transform="translate(-1.501 0.499)" fill="#f53d2d" stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1"></path>
                                    </svg>
                                    <?php endif; ?>
                                    <img class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 lg:w-[30px] lg:h-[30px] lazy" data-src="<?php echo e(asset($item->src)); ?>" alt="<?php echo e($item->title); ?>">
                                </div>
                                <div class="flex-1">
                                    <div class="uppercase font-bold text-f13"><?php echo e($item->title); ?></div>
                                    <div class="text-f12"><?php echo strip_tags($item->description) ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>

        </section>
        <section class="mt-8">
            <div class="grid grid-cols-1 md:grid-cols-12 md:gap-8 space-y-8 md:space-y-0">
                <div class="col-span-1 md:col-span-8 section-description">
                    <div class="flex flex-wrap items-center space-x-5">
                        <h3 class="changeActiveTab uppercase font-medium cursor-pointer  tab-1 py-2 mb-2 inline-block active" onclick="changeActiveTab(event,'tab-1')"><?php echo e(trans('index.ProductInformation')); ?></h3>
                    </div>
                    <div class="content-detail-product mt-2 relative overflow-hidden tab-content">
                        <div class="space-y-2 tab" id="tab-1">
                            <?php echo $detail->content ?>
                        </div>
                    </div>
                    <!-- START: đánh giá sản phẩm -->
                    <?php echo $__env->make('product.frontend.product.comment.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- END: đánh giá sản phẩm -->
                </div>
                <div class="col-span-1 md:col-span-4">
                    <picture>
                        <img class="lazy w-full" data-src="<?php echo e($fcSystem['banner_1']); ?>" alt="banner">
                    </picture>
                    <?php if($ishomeCategoryArticle && count($ishomeCategoryArticle->posts) > 0): ?>
                    <div class="mt-5">
                        <h2 class="text-f18 font-bold mb-[15px]"><?php echo e($ishomeCategoryArticle->title); ?></h2>
                        <div class="space-y-4">

                            <?php $__currentLoopData = $ishomeCategoryArticle->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex space-x-4 img-box">
                                <div class="w-[105px] overflow-hidden">
                                    <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>">
                                        <img data-src="<?php echo e(asset($item->image)); ?>" alt="<?php echo e($item->title); ?>" class="lazy h-[74px] object-cover">
                                    </a>
                                </div>
                                <div class="flex-1">
                                    <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" class="font-semibold"><?php echo e($item->title); ?></a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <section class="mt-8">
            <h2 class="font-bold text-2xl mb-5"><?php echo e(trans('index.RelatedProducts')); ?></h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <?php $__currentLoopData = $productSame; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo htmlItemProduct($k, $item); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link rel="stylesheet" href="<?php echo e(asset('frontend/library/css/products.css')); ?>" />

<?php $__env->stopPush(); ?>
<?php $__env->startPush('javascript'); ?>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo e(asset('frontend/library/js/common.js')); ?>"></script>
<script>
    var swiper = new Swiper(".mySwiperProduct", {
        loop: false,
        spaceBetween: 15,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiper2 = new Swiper(".mySwiperProduct2", {
        loop: false,
        spaceBetween: 5,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
</script>
<style>
    .mySwiperProduct .swiper-button-next:after,
    .mySwiperProduct .swiper-button-prev:after {
        font-size: 25px;
    }

    .content-detail-product img {
        height: auto !important;
        max-width: 100% !important;
    }

    .content-detail-product p {
        margin-bottom: 10px;
    }

    .content-detail-product ul {
        list-style: disc;
        padding-left: 20px;
    }

    .content-detail-product h2 {
        font-size: 18px;
    }

    .content-detail-product h3 {
        font-size: 17px;
    }

    .content-detail-product h4 {
        font-size: 16px;
    }

    .content-detail-product h5 {
        font-size: 15px;
    }

    .disabledLogin {
        opacity: 0.2
    }
</style>
<script>
    $(".disabledLogin").click(function(event) {
        event.stopPropagation();
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/order/domains/order.tamphat.edu.vn/public_html/resources/views/product/frontend/product/index.blade.php ENDPATH**/ ?>