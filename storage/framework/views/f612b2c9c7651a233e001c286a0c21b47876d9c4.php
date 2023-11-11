<?php
$menu_footer = getMenus('menu-footer');
$slideServices = Cache::remember('slideServices', 600, function () {
    $slideServices = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'services'])->with('slides')->first();
    return $slideServices;
});
?>
<footer class="bg-[#252b33] pt-5 text-white mt-8">
    <div class="container px-4">
        <?php if($slideServices && !empty($slideServices->slides)): ?>
        <div class="grid md:grid-cols-3 pb-[15px] border-b border-[#38414d] space-y-3 md:space-y-0 gap-4">
            <?php $__currentLoopData = $slideServices->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center text-f16">
                <img width="35" height="35" data-src="<?php echo e(asset($item->src)); ?>" alt="<?php echo e($item->title); ?>" class="lazy mr-[15px]">
                <?php echo e($item->title); ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
        <div class="mt-10 grid md:grid-cols-2 lg:grid-cols-4 gap-5 pb-8">
            <div class="text-f14">
                <img width="238" height="42" data-src="<?php echo e(asset($fcSystem['homepage_logo'])); ?>" alt="<?php echo e($fcSystem['homepage_company']); ?>" class="lazy">
                <div class="mb-5 flex items-center  mt-6" style="padding: 12px 15px 15px 20px;">
                    <img width="24" height="24" data-src="<?php echo e(asset('frontend/images/footer-address.webp')); ?>" alt="<?php echo e($fcSystem['homepage_company']); ?>" class="lazy mr-[15px]">
                    <?php echo e($fcSystem['contact_address']); ?>

                </div>
                <div class="text-[#96AAC3]">
                    <?php echo $fcSystem['contact_time'] ?>
                </div>
            </div>
            <div>
                <h4 class="font-semibold text-f17 mb-5"><?php echo e(trans('index.CustomerSupport')); ?></h4>
                <div class="flex items-center mb-4 pb-4 border-b border-[#38414d]">
                    <img width="24" height="24" data-src="<?php echo e(asset('frontend/images/footer-phone.webp')); ?>" alt="<?php echo e($fcSystem['homepage_company']); ?>" class="lazy mr-[15px]">
                    <div class="flex flex-col">
                        <a href="tel:<?php echo e($fcSystem['contact_hotline']); ?>" class="text-f20 font-bold"><?php echo e($fcSystem['contact_hotline']); ?></a>
                        <span class="text-f14 text-[#96AAC3]"><?php echo strip_tags($fcSystem['contact_time']) ?></span>
                    </div>
                </div>
                <div class="flex items-center mb-5">
                    <img width="24" height="24" data-src="<?php echo e(asset('frontend/images/footer-email.webp')); ?>" alt="<?php echo e($fcSystem['homepage_company']); ?>" class="lazy mr-[15px]">
                    <a href="mailto:<?php echo e($fcSystem['contact_email']); ?>"><?php echo e($fcSystem['contact_email']); ?></a>
                </div>
                <div class="flex space-x-3">
                    <a href="<?php echo e($fcSystem['social_facebook']); ?>" target="_blank" aria-label="Facebook" title="Theo dõi <?php echo e($fcSystem['homepage_company']); ?> trên Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25px" height="25px" viewBox="0 0 96.124 96.123" style="enable-background:new 0 0 96.124 96.123;" xml:space="preserve">
                            <path d="M72.089,0.02L59.624,0C45.62,0,36.57,9.285,36.57,23.656v10.907H24.037c-1.083,0-1.96,0.878-1.96,1.961v15.803   c0,1.083,0.878,1.96,1.96,1.96h12.533v39.876c0,1.083,0.877,1.96,1.96,1.96h16.352c1.083,0,1.96-0.878,1.96-1.96V54.287h14.654   c1.083,0,1.96-0.877,1.96-1.96l0.006-15.803c0-0.52-0.207-1.018-0.574-1.386c-0.367-0.368-0.867-0.575-1.387-0.575H56.842v-9.246   c0-4.444,1.059-6.7,6.848-6.7l8.397-0.003c1.082,0,1.959-0.878,1.959-1.96V1.98C74.046,0.899,73.17,0.022,72.089,0.02z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#EBE7E7"></path>
                        </svg>
                    </a>
                    <a href="<?php echo e($fcSystem['social_twitter']); ?>" target="_blank" aria-label="Twitter" title="Theo dõi <?php echo e($fcSystem['homepage_company']); ?> trên Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="25px" height="25px">
                            <path d="M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016    c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992    c0,8.32,0.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056    c0,36.352,18.72,68.576,46.624,87.232c-16.864-0.32-33.408-5.216-47.424-12.928c0,0.32,0,0.736,0,1.152    c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-0.384-19.872-1.792    c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-0.384-25.12-1.44    C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-0.16-9.12-0.384-13.568    C480.224,136.96,497.728,118.496,512,97.248z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#EBE7E7"></path>
                        </svg>
                    </a>
                    <a href="<?php echo e($fcSystem['social_youtube']); ?>" target="_blank" aria-label="Youtube" title="T">
                        <svg class="w-6 h-6 text-white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <path fill="#fff" d="M490.24,113.92c-13.888-24.704-28.96-29.248-59.648-30.976C399.936,80.864,322.848,80,256.064,80
									 c-66.912,0-144.032,0.864-174.656,2.912c-30.624,1.76-45.728,6.272-59.744,31.008C7.36,138.592,0,181.088,0,255.904
									 C0,255.968,0,256,0,256c0,0.064,0,0.096,0,0.096v0.064c0,74.496,7.36,117.312,21.664,141.728
									 c14.016,24.704,29.088,29.184,59.712,31.264C112.032,430.944,189.152,432,256.064,432c66.784,0,143.872-1.056,174.56-2.816
									 c30.688-2.08,45.76-6.56,59.648-31.264C504.704,373.504,512,330.688,512,256.192c0,0,0-0.096,0-0.16c0,0,0-0.064,0-0.096
									 C512,181.088,504.704,138.592,490.24,113.92z M192,352V160l160,96L192,352z"></path>
                        </svg>
                    </a>
                    <a href="<?php echo e($fcSystem['social_instagram']); ?>" target="_blank" aria-label="Instagram" title="Theo dõi <?php echo e($fcSystem['homepage_company']); ?> trên Instagram">
                        <svg class="w-6 h-6 text-white" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#fff" d="m75 512h362c41.355469 0 75-33.644531 75-75v-362c0-41.355469-33.644531-75-75-75h-362c-41.355469 0-75 33.644531-75 75v362c0 41.355469 33.644531 75 75 75zm-45-437c0-24.8125 20.1875-45 45-45h362c24.8125 0 45 20.1875 45 45v362c0 24.8125-20.1875 45-45 45h-362c-24.8125 0-45-20.1875-45-45zm0 0"></path>
                            <path fill="#fff" d="m256 391c74.4375 0 135-60.5625 135-135s-60.5625-135-135-135-135 60.5625-135 135 60.5625 135 135 135zm0-240c57.898438 0 105 47.101562 105 105s-47.101562 105-105 105-105-47.101562-105-105 47.101562-105 105-105zm0 0"></path>
                            <path fill="#fff" d="m406 151c24.8125 0 45-20.1875 45-45s-20.1875-45-45-45-45 20.1875-45 45 20.1875 45 45 45zm0-60c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"></path>
                        </svg>
                    </a>

                </div>
            </div>
            <?php echo getHtmlMenusFooter($menu_footer, array(
                'class' => '',
                'class_title' => 'font-semibold text-f17 mb-5',
                'class_ul' => '',
                'class_li' => '',
                'class_a' => 'hover:text-[#3bb77e]',
            )); ?>
        </div>
    </div>
</footer>
<div class="bg-[#333] flex items-center py-[10px] justify-center text-center text-f13">
    <span style="color:rgba(255,255,255,0.6)"><?php echo $fcSystem['homepage_copyright'] ?></span>
</div><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/homepage/common/footer.blade.php ENDPATH**/ ?>