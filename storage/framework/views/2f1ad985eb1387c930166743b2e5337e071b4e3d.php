
<?php $__env->startSection('content'); ?>

<main class="mb-8 main-new-detail main-child">
<section class="bread-crumb" style="background: linear-gradient(0deg, rgba(0,0,0,0.8), rgba(0,0,0,0.3)),  url(//bizweb.dktcdn.net/100/485/131/themes/906771/assets/breadcrumb.jpg?1686556941849) no-repeat center;">
        <div class="container">
            <div class="title-bread-crumb">
                Thực đơn giảm cân 1 tháng, bí kíp giảm cân hiệu quả, an toàn
            </div>
            <nav class="bg-grey-light w-full" aria-label="breadcrumb">
                  <ol class="list-reset flex flex-wrap">
                  <li><a href="<?php echo url('') ?>" class="text-gray-500 hover:text-gray-600 "><?php echo e(trans('index.home')); ?></a></li>
                  <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><span class="text-gray-500 mx-2">/</span></li>
                  <li><a href="<?php echo route('routerURL', ['slug' => $v->slug]) ?>" class="text-gray-500 hover:text-gray-600  "><?php echo e($v->title); ?></a></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <li><span class="text-gray-500 mx-2">/</span></li>
                  <li><a href="<?php echo route('routerURL', ['slug' => $detail->slug]) ?>" class="text-[#3bb77e] hover:text-gray-600  "><?php echo e($detail->title); ?></a></li>
               </ol>
                </nav>
            
        </div>
    </section>
   <div class="container px-4">
   <div class="grid md:grid-cols-12 gap-5">
      <div class="md:col-span-9">
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
         </div>
      </div>
      <div class="md:col-span-3 space-y-8">
         <aside class="sidebar-blog">
            <div class="item-sb filter-box flex flex-col pb-6 border-b">
               <div class="title-title">
                  <h3 class="title-primary font-semibold">Danh mục sản phâm<span class="icon"><img src="../frontend/images/iq.png" alt=""></span></h3>
               </div>
               <div class="nav-item">
                  <div class="acc">
                     <div class="acc__card">
                        <div class="acc__title">Rau lá các loại</div>
                        <div class="acc__panel">
                           <ul>
                              <li>
                                 <a href="">Các loại ớt</a>
                              </li>
                              <li>
                                 <a href="">Các loại ớt</a>
                              </li>
                              <li>
                                 <a href="">Các loại ớt</a>
                              </li>
                              <li>
                                 <a href="">Các loại ớt</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="acc__card">
                        <div class="acc__title">Accordion Title #2</div>
                        <div class="acc__panel">
                           I am the content found under accordion #2.
                           You can't see me while "active" is not present.
                        </div>
                     </div>
                     <div class="acc__card">
                        <div class="acc__title">Accordion Title #3</div>
                        <div class="acc__panel">
                           I am the content found under accordion #3.
                           You can't see me while "active" is not present.
                        </div>
                     </div>
                     <div class="acc__card">
                        <div class="acc__title">Accordion Title #4</div>
                        <div class="acc__panel">
                           I am the content found under accordion #4.
                           You can't see me while "active" is not present.
                        </div>
                     </div>
                     <div class="acc__card">
                        <div class="acc__title">Accordion Title #5</div>
                        <div class="acc__panel">
                           I am the content found under accordion #5.
                           You can't see me while "active" is not present.
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="item-sb-new filter-box flex flex-col pb-6 border-b">
               <div class="title-title">
                  <h3 class="title-primary font-semibold">Tin tức nổi bật<span class="icon"><img src="../frontend/images/iq.png" alt=""></span></h3>
               </div>
               <div class="nav-item">
                  <div class="item">
                     <div class="img hover-box">
                        <a href="">
                        <img src="https://crmorder.tamphat.edu.vn/upload/images/rau-cu/rau-cai.jpg" alt="">
                        </a>
                     </div>
                     <div class="nav-img">
                        <h4 class="title-4"><a href="">9 'siêu thực phẩm' cần có trong chế độ ăn uống của người cao tuổi</a></h4>
                     </div>
                  </div>
                  <div class="item">
                     <div class="img hover-box">
                        <a href="">
                        <img src="https://crmorder.tamphat.edu.vn/upload/images/rau-cu/rau-cai.jpg" alt="">
                        </a>
                     </div>
                     <div class="nav-img">
                        <h4 class="title-4"><a href="">9 'siêu thực phẩm' cần có trong chế độ ăn uống của người cao tuổi</a></h4>
                     </div>
                  </div>
                  <div class="item">
                     <div class="img hover-box">
                        <a href="">
                        <img src="https://crmorder.tamphat.edu.vn/upload/images/rau-cu/rau-cai.jpg" alt="">
                        </a>
                     </div>
                     <div class="nav-img">
                        <h4 class="title-4"><a href="">9 'siêu thực phẩm' cần có trong chế độ ăn uống của người cao tuổi</a></h4>
                     </div>
                  </div>
                  <div class="item">
                     <div class="img hover-box">
                        <a href="">
                        <img src="https://crmorder.tamphat.edu.vn/upload/images/rau-cu/rau-cai.jpg" alt="">
                        </a>
                     </div>
                     <div class="nav-img">
                        <h4 class="title-4"><a href="">9 'siêu thực phẩm' cần có trong chế độ ăn uống của người cao tuổi</a></h4>
                     </div>
                  </div>
                  <div class="item">
                     <div class="img hover-box">
                        <a href="">
                        <img src="https://crmorder.tamphat.edu.vn/upload/images/rau-cu/rau-cai.jpg" alt="">
                        </a>
                     </div>
                     <div class="nav-img">
                        <h4 class="title-4"><a href="">9 'siêu thực phẩm' cần có trong chế độ ăn uống của người cao tuổi</a></h4>
                     </div>
                  </div>
               </div>
         </aside>
         <!-- <?php if(!$asideArticle->isEmpty()): ?>
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
            <?php endif; ?> -->
         </div>
      </div>
      <div class="new-home new-other">
         <?php if(!$sameArticle->isEmpty()): ?>
         <div>
            <div class="bg-[#f0f0f0] p-[10px] rounded-[5px] my-4 uppercase text-f18 font-bold">
               <?php echo e(trans('index.RelatedPosts')); ?>

            </div>
            <div class="slider-other-new swiper mySwiper">
               <div class="swiper-wrapper">
                 
                  <?php $__currentLoopData = $sameArticle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="swiper-slide ">
                     <div class="hover-box ">
                        <div class=" img-box overflow-hidden">
                           <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>">
                           <img alt="<?php echo e($item->title); ?>" class="lazy w-full h-auto lg:h-full" src="<?php echo e(asset($item->image)); ?>" style="display: block;">
                           </a>
                        </div>
                        <div class="nav-img">
                           <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" class="text-f15 md:text-f18 font-bold leading-6 clamp-2 "><?php echo e($item->title); ?></a>
                           <div class="content-nav">
                              <span class="text-f13 text-[#fff] italic"><?php echo e($detail->created_at); ?></span>
                              <div class="clamp-3 text-f13 lg:text-f15">
                                 <?php echo $item->description; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
               </div>
            </div>
            
         </div>
         <?php endif; ?>
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
<script>
 
   var swiper2 = new Swiper(".slider-other-new", {
        slidesPerView: 5,
        spaceBetween: 20,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".mySwiper-productSale .swiper-button-next",
            prevEl: ".mySwiper-productSale .swiper-button-prev",
        },
        breakpoints: {
            300: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            500: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/article/frontend/article/index.blade.php ENDPATH**/ ?>