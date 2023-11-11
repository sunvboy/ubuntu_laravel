
<?php $__env->startSection('content'); ?>
<main>
    <?php if($slideHome && count($slideHome->slides) > 0): ?>
    <section class="banner">
        <div class="container px-4 mx-auto mt-4">
            <div class="swiper mySwiper mySwiper-slideHome">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $slideHome->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <img src="<?php echo e(asset($slide->src)); ?>" alt="<?php echo e($slide->title); ?>" class="w-full">
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if(!empty(Auth::guard('customer')->user())): ?>
    <?php $routeDH = route('pages.products'); ?>
    <?php else: ?>
    <?php $routeDH = route('customer.login'); ?>
    <?php endif; ?>
    <section class="main-example pt-8">
        <div class="container px-4 ">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="flex flex-col justify-center items-center ">
                    <h2 class="w-full bg-red-500 text-white uppercase rounded-md py-2 text-center font-bold"><?php echo e(trans('index.OrderFor2')); ?></h2>
                    <div class="font-bold w-full text-center text-xl mt-3"><?php echo e(trans('index.TimeRemaining')); ?></div>
                    <div class="countdown-container mt-3" id="main-example"></div>
                    <a href="<?php echo e($routeDH); ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded neonShadow mt-10 js_order_2 ">
                        <?php echo e(trans('index.Order')); ?>

                    </a>
                </div>
                <div class="flex flex-col justify-center items-center ">
                    <h2 class="w-full bg-red-500 text-white uppercase rounded-md py-2 text-center font-bold"><?php echo e(trans('index.OrderFor5')); ?></h2>
                    <div class="font-bold w-full text-center text-xl mt-3"><?php echo e(trans('index.TimeRemaining')); ?></div>
                    <div class="countdown-container mt-3" id="main-example-5"></div>
                    <a href="<?php echo e($routeDH); ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded neonShadow mt-10 js_order_5">
                        <?php echo e(trans('index.Order')); ?>

                    </a>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php if(!$ishomeProduct->isEmpty()): ?>
    <section class="pt-8">
        <div class="container px-4">
            <div class="">
                <div class="flex flex-col p-[10px] bg-[#ff463b] rounded-t-2xl">
                    <h2 class="text-white text-f22 font-semibold"><?php echo e($fcSystem['title_1']); ?></h2>
                    <span class="text-white text-f15 font-normal"><?php echo e($fcSystem['title_2']); ?></span>
                </div>
                <div class="bg-[#ff685f] py-[10px] rounded-b-2xl ">
                    <div class="swiper mySwiper mySwiper-productSale px-[10px]">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $ishomeProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo htmlItemProduct($key, $item, 'group swiper-slide bg-white rounded-2xl'); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if(!$ishomeCategoryProduct->isEmpty()): ?>
    <?php $__currentLoopData = $ishomeCategoryProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(count($item->posts) > 0): ?>
    <section class="pt-8">
        <div class="container px-4">
            <div class="flex items-center justify-between flex-col lg:flex-row space-y-4 lg:space-y-0">
                <h2><a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" class="text-f22 font-bold hover:text-[#3bb77e]"><?php echo e($item->title); ?></a></h2>
                <?php if(count($item->children) > 0): ?>
                <div>
                    <ul class="js_ul_menu_home flex flex-wrap space-x-2 ">
                        <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mb-2 md:mb-0"><a href="javascript:void(0)" class="float-left bg-[#eee] hover:bg-red-500 hover:text-white text-black font-medium py-2 px-4 rounded neonShadow"><?php echo e($child->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
            <div class="mt-5">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 md:gap-5">
                    <div class="img-box overflow-hidden rounded-2xl">
                        <img class="lazy rounded-2xl w-full h-full shadowC object-cover" data-src="<?php echo e(asset($item->banner)); ?>">
                    </div>
                    <?php $__currentLoopData = $item->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo htmlItemProduct($key, $val->getProduct); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if($ishomeCategoryArticle && count($ishomeCategoryArticle->posts) > 0): ?>
    <section class="pt-8">
        <div class="container px-4">
            <h2><a href="<?php echo e(route('routerURL',['slug' => $ishomeCategoryArticle->slug])); ?>" class="text-f22 font-bold"><?php echo e($ishomeCategoryArticle->title); ?></a></h2>
            <div class="mt-5">
                <div class="grid gap-5 md:grid-cols-2">
                    <?php $__currentLoopData = $ishomeCategoryArticle->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="hover-box flex space-x-3 md:space-x-5 ">
                        <div class="w-[150px] lg:w-[250px] img-box overflow-hidden">
                            <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>">
                                <img data-src="<?php echo asset($item->image); ?>" alt="<?php echo $item->title; ?>" class="lazy w-full h-auto lg:h-full">
                            </a>
                        </div>
                        <div class="flex-1 flex flex-col space-y-1">
                            <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" class="text-f15 md:text-f18 font-bold leading-6 clamp-2 hover:text-green-500"><?php echo $item->title; ?></a>
                            <span class="text-f13 text-[#999] italic"><?php echo \Carbon\Carbon::parse($item->created_at)->format('l, m d Y') ?></span>
                            <div class="clamp-3 text-f13 lg:text-f15">
                                <?php echo $item->description; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="flex justify-center items-center mt-5">
                <a href="<?php echo e(route('routerURL',['slug' => $ishomeCategoryArticle->slug])); ?>" class="news-content-more"><?php echo e(trans('index.ViewAll')); ?> <?php echo e($ishomeCategoryArticle->title); ?></a>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/home.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('javascript'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>
<script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
<script type="text/template" id="main-example-template">
    <div class="time <%= label %>">
  <span class="count curr top"><%= curr %></span>
  <span class="count next top"><%= next %></span>
  <span class="count next bottom"><%= next %></span>
  <span class="count curr bottom"><%= curr %></span>
  <span class="label"><%= label.length < 6 ? label : label.substr(0, 3)  %></span>
</div>
</script>
<script type="text/javascript">
    function getMonday(d, number) {
        d = new Date(d);
        var day = d.getDay(),
            diff = d.getDate() - day + (day == 0 ? -6 : 1); // adjust when day is sunday
        var sunday = new Date(d.setDate(diff));
        var thursday = d.setDate(sunday.getDate() + number);
        return new Date(thursday)
    }
    var today = new Date();
    var mo = getMonday(today, 0); //thứ 2
    var tu = getMonday(today, 1); //thứ 3
    var we = getMonday(today, 2); //thứ 4
    var th = getMonday(today, 3); // thứ 5
    var fr = getMonday(today, 4); // thứ 6
    var sa = getMonday(today, 5); // thứ 7
    var su = getMonday(today, 6); // chủ nhật
    var countDownDate5 = countDownDate2 = today;
    if (today >= mo && today <= we) {
        countDownDate2 = th.getFullYear() +
            '/' +
            ((th.getMonth() > 8) ? (th.getMonth() + 1) : ('0' + (th.getMonth() + 1))) +
            '/' +
            ((th.getDate() > 9) ? th.getDate() : ('0' + th.getDate()));
        $('.js_order_5').addClass('cursor-not-allowed');
        $('.js_order_5').attr('href', 'javascript:void(0)');
    } else if (today >= th && today <= sa) {
        countDownDate5 = su.getFullYear() +
            '/' +
            ((su.getMonth() > 8) ? (su.getMonth() + 1) : ('0' + (su.getMonth() + 1))) +
            '/' +
            ((su.getDate() > 9) ? su.getDate() : ('0' + su.getDate()));
        $('.js_order_2').addClass('cursor-not-allowed');
        $('.js_order_2').attr('href', 'javascript:void(0)');
    } else {
        var suNew = new Date(su.setDate(su.getDate() + 3))
        countDownDate2 = suNew.getFullYear() +
            '/' +
            ((suNew.getMonth() > 8) ? (suNew.getMonth() + 1) : ('0' + (suNew.getMonth() + 1))) +
            '/' +
            ((suNew.getDate() > 9) ? suNew.getDate() : ('0' + suNew.getDate()));
        $('.js_order_5').addClass('cursor-not-allowed');
        $('.js_order_5').attr('href', 'javascript:void(0)');
    }
    /*countdown date 2*/
    $(window).on('load', function() {
        var labels = ['<?php echo trans('index.Date') ?>', '<?php echo trans('index.Hours') ?>', '<?php echo trans('index.Minute') ?>', '<?php echo trans('index.Second') ?>'],
            nextYear = countDownDate2,
            template = _.template($('#main-example-template').html()),
            currDate = '00:00:00:00:00',
            nextDate = '00:00:00:00:00',
            parser = /([0-9]{2})/gi,
            $example = $('#main-example');

        function strfobj(str) {
            var parsed = str.match(parser),
                obj = {};
            labels.forEach(function(label, i) {
                obj[label] = parsed[i]
            });
            return obj;
        }

        function diff(obj1, obj2) {
            var diff = [];
            labels.forEach(function(key) {
                if (obj1[key] !== obj2[key]) {
                    diff.push(key);
                }
            });
            return diff;
        }
        var initData = strfobj(currDate);
        labels.forEach(function(label, i) {
            $example.append(template({
                curr: initData[label],
                next: initData[label],
                label: label
            }));
        });
        $example.countdown(nextYear, function(event) {
            var newDate = event.strftime('%d:%H:%M:%S'),
                data;
            if (newDate !== nextDate) {
                currDate = nextDate;
                nextDate = newDate;
                // Setup the data
                data = {
                    'curr': strfobj(currDate),
                    'next': strfobj(nextDate)
                };
                // Apply the new values to each node that changed
                diff(data.curr, data.next).forEach(function(label) {
                    var selector = '.%s'.replace(/%s/, label),
                        $node = $example.find(selector);
                    // Update the node
                    $node.removeClass('flip');
                    $node.find('.curr').text(data.curr[label]);
                    $node.find('.next').text(data.next[label]);
                    // Wait for a repaint to then flip
                    _.delay(function($node) {
                        $node.addClass('flip');
                    }, 50, $node);
                });
            }
        });
    });
    /*countdown date 5*/
    $(window).on('load', function() {
        var labels5 = ['<?php echo trans('index.Date') ?>', '<?php echo trans('index.Hours') ?>', '<?php echo trans('index.Minute') ?>', '<?php echo trans('index.Second') ?>'],
            nextYear = countDownDate5,
            template = _.template($('#main-example-template').html()),
            currDate = '00:00:00:00:00',
            nextDate = '00:00:00:00:00',
            parser = /([0-9]{2})/gi,
            $example5 = $('#main-example-5');

        function strfobj5(str) {
            var parsed = str.match(parser),
                obj = {};
            labels5.forEach(function(label, i) {
                obj[label] = parsed[i]
            });
            return obj;
        }

        function diff5(obj1, obj2) {
            var diff = [];
            labels5.forEach(function(key) {
                if (obj1[key] !== obj2[key]) {
                    diff.push(key);
                }
            });
            return diff;
        }
        var initData5 = strfobj5(currDate);
        labels5.forEach(function(label, i) {
            $example5.append(template({
                curr: initData5[label],
                next: initData5[label],
                label: label
            }));
        });
        $example5.countdown(nextYear, function(event) {
            var newDate = event.strftime('%d:%H:%M:%S'),
                data;
            if (newDate !== nextDate) {
                currDate = nextDate;
                nextDate = newDate;
                data = {
                    'curr': strfobj5(currDate),
                    'next': strfobj5(nextDate)
                };
                diff5(data.curr, data.next).forEach(function(label) {
                    var selector = '.%s'.replace(/%s/, label),
                        $node = $example5.find(selector);
                    $node.removeClass('flip');
                    $node.find('.curr').text(data.curr[label]);
                    $node.find('.next').text(data.next[label]);
                    _.delay(function($node) {
                        $node.addClass('flip');
                    }, 50, $node);
                });
            }
        });
    });
</script>
<script>
    var swiper1 = new Swiper(".mySwiper-slideHome", {
        slidesPerView: 1,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".mySwiper-slideHome .swiper-button-next",
            prevEl: ".mySwiper-slideHome .swiper-button-prev",
        },
    });
    var swiper2 = new Swiper(".mySwiper-productSale", {
        slidesPerView: 5,
        spaceBetween: 10,
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
                slidesPerView: 2
            },
            500: {
                slidesPerView: 2
            },
            640: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            1024: {
                slidesPerView: 5
            },
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/homepage/home/index.blade.php ENDPATH**/ ?>