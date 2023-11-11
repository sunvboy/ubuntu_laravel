<?php $__env->startSection('content'); ?>
<nav class=" relative w-full flex flex-wrap items-center justify-between py-2 bg-[#f9f9f9] text-gray-500 hover:text-gray-700 focus:text-gray-700 navbar navbar-expand-lg navbar-light">
    <div class="container px-4 mx-auto w-full flex flex-wrap items-center justify-between">
        <nav class="bg-grey-light w-full" aria-label="breadcrumb">
            <ol class="list-reset flex">
                <li><a href="<?php echo url('') ?>" class="text-gray-500 hover:text-gray-600"><?php echo e(trans('index.home')); ?></a></li>
                <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li><a href="<?php echo route('routerURL', ['slug' => $v->slug]) ?>" class="text-gray-500 hover:text-gray-600"><?php echo e($v->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </nav>
    </div>
</nav>
<main class="pt-3">
    <div class="container px-4">
        <h1 class="text-2xl my-[10px] font-bold"><?php echo e($detail->title); ?></h1>
        <?php if(count($detail->children) > 0): ?>
        <ul class="flex flex-wrap space-x-4">
            <?php $__currentLoopData = $detail->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class=" mb-2 md:mb-0">
                <a class="hover:border-b-2 pb-1 hover:border-[#3bb77e] hover:text-[#3bb77e] font-semibold" href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>"><?php echo e($item->title); ?></a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php endif; ?>

        <div class="mt-[30px]">
            <?php if($data): ?>
            <div class="grid md:grid-cols-2 space-y-8 md:space-y-0 md:gap-8">
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($k <= 1): ?> <div class="group img-box space-y-2">
                    <div class="overflow-hidden">
                        <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>">
                            <img data-src="<?php echo e(asset($item->image)); ?>" alt="<?php echo e($item->title); ?>" class="lazy h-auto md:h-[354px] object-cover w-full">
                        </a>
                    </div>
                    <div>
                        <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" class="clamp-2 text-f15 md:text-f18 font-bold group-hover:text-[#3bb77e]"><?php echo e($item->title); ?></a>
                    </div>
                    <span class="text-f13 text-[#999] italic"><?php echo \Carbon\Carbon::parse($item['created_at'])->format('l, m d Y') ?></span>
                    <div class="clamp-3 text-f13 lg:text-f15">
                        <?php echo $item->description ?>
                    </div>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 space-y-8 md:space-y-0 md:gap-8 mt-8">
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($k > 1): ?> <div class="group img-box space-y-2">
                <div class="overflow-hidden">
                    <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>">
                        <img data-src="<?php echo e(asset($item->image)); ?>" alt="<?php echo e($item->title); ?>" class="lazy h-auto md:h-[250px] object-cover w-full">
                    </a>
                </div>
                <div>
                    <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" class="clamp-2 text-f15 md:text-f18 font-bold group-hover:text-[#3bb77e]"><?php echo e($item->title); ?></a>
                </div>
                <span class="text-f13 text-[#999] italic"><?php echo \Carbon\Carbon::parse($item['created_at'])->format('l, m d Y') ?></span>
                <div class="clamp-3 text-f13 lg:text-f15">
                    <?php echo $item->description ?>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-10 flex justify-center">
            <?php echo $data->links() ?>
        </div>
        <?php endif; ?>
    </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/order/domains/order.tamphat.edu.vn/public_html/resources/views/article/frontend/category/index.blade.php ENDPATH**/ ?>