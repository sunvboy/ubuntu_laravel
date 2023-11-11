<?php $__env->startSection('content'); ?>

<nav class="relative w-full flex flex-wrap items-center justify-between py-2 bg-[#f9f9f9] text-gray-500 hover:text-gray-700 focus:text-gray-700 navbar navbar-expand-lg navbar-light">
    <div class="container px-4 mx-auto w-full flex flex-wrap items-center justify-between">
        <nav class="bg-grey-light w-full" aria-label="breadcrumb">
            <ol class="list-reset flex flex-wrap">
                <li><a href="<?php echo url('') ?>" class="text-gray-500 hover:text-gray-600 text-f13"><?php echo e(trans('index.home')); ?></a></li>
                <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li><a href="<?php echo route('routerURL', ['slug' => $v->slug]) ?>" class="text-gray-500 hover:text-gray-600  text-f13"><?php echo e($v->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li><a href="<?php echo route('routerURL', ['slug' => $detail->slug]) ?>" class="text-[#3bb77e] hover:text-gray-600  text-f13"><?php echo e($detail->title); ?></a></li>
            </ol>
        </nav>
    </div>
</nav>
<main class="my-8">
    <div class="container px-4">
        <div class="grid md:grid-cols-12 gap-5">
            <div class="md:col-span-8">
                <div class="space-y-2">
                    <h1 class="leading-8 text-f22 md:text-f25 font-semibold text-center"><?php echo e($detail->title); ?></h1>
                    <div class="text-center  text-f13 text-[#999]">
                        <span><?php echo \Carbon\Carbon::parse($detail['created_at'])->format('l, m d Y') ?></span>&nbsp;-&nbsp;
                        <span><?php echo e($detail->viewed); ?> <?php echo e(trans('index.viewed')); ?></span>
                    </div>
                    <div class="font-bold italic">
                        <?php echo $detail->description; ?>
                    </div>
                    <div class="box_content">
                        <?php echo $detail->content; ?>
                    </div>
                    <?php if(!$sameArticle->isEmpty()): ?>
                    <div>
                        <div class="bg-[#f0f0f0] p-[10px] rounded-[5px] my-4 uppercase text-f18 font-bold">
                            <?php echo e(trans('index.RelatedPosts')); ?>

                        </div>
                        <div class="grid md:grid-cols-4 space-y-5 md:space-y-0 md:gap-5">
                            <?php $__currentLoopData = $sameArticle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="group img-box space-y-2">
                                <div class="overflow-hidden">
                                    <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>">
                                        <img data-src="<?php echo e(asset($item->image)); ?>" alt="<?php echo e($item->title); ?>" class="lazy h-auto md:h-[110px] object-cover w-full">
                                    </a>
                                </div>
                                <div>
                                    <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" class="clamp-2 text-f15 md:text-f14 font-bold group-hover:text-[#3bb77e]"><?php echo e($item->title); ?></a>
                                </div>
                                <span class="text-f13 text-[#999] italic"><?php echo e($detail->created_at); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
            <div class="md:col-span-4 space-y-8">
                <?php if(!$asideArticle->isEmpty()): ?>
                <?php $__currentLoopData = $asideArticle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($item->posts) > 0): ?>
                <div class="">
                    <div class="bg-[#f0f0f0] p-[10px] rounded-[5px] mb-4">
                        <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" class="uppercase text-f18 font-bold"><?php echo e($item->title); ?></a>
                    </div>
                    <?php $__currentLoopData = $item->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($k == 0): ?>
                    <div class="group first overflow-hidden">
                        <a href="<?php echo e(route('routerURL',['slug' => $val->slug])); ?>" class=" space-y-3 overflow-hidden">
                            <img data-src="<?php echo e(asset($val->image)); ?>" alt="<?php echo e($val->title); ?>" class="lazy rounded mb-3">
                        </a>
                        <h3 class="text-f17 font-bold overflow-hidden leading-5 group-hover:text-[#3bb77e] hover:text-[#3bb77e]"><a href="<?php echo e(route('routerURL',['slug' => $val->slug])); ?>"><?php echo e($val->title); ?></a></h3>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <ul class="space-y-1 list-disc mt-3 pl-5">
                        <?php $__currentLoopData = $item->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($k > 0): ?>
                        <li>
                            <a href="<?php echo e(route('routerURL',['slug' => $val->slug])); ?>" title="<?php echo e($val->title); ?>" class="hover:text-[#3bb77e]"><?php echo e($val->title); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<style>
    .box_content img {
        margin: 10px auto;
        max-width: 100%;
        height: auto !important;
    }

    .box_content ul {
        list-style: disc;
        padding-left: 20px;
        margin-bottom: 10px;
    }

    .box_content p {
        margin-bottom: 10px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/order/domains/order.tamphat.edu.vn/public_html/resources/views/article/frontend/article/index.blade.php ENDPATH**/ ?>