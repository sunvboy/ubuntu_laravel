@extends('homepage.layout.home')
@section('content')
<main class="main-home">
    @if($slideHome && count($slideHome->slides) > 0)
    <section class="banner">
        <div class="container px-4 mx-auto ">
            <div class="swiper mySwiper mySwiper-slideHome">
                <div class="swiper-wrapper">
                    @foreach($slideHome->slides as $slide)
                    <div class="swiper-slide">
                        <img src="{{asset($slide->src)}}" alt="{{$slide->title}}" class="w-full">
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    @endif
    @if(!empty(Auth::guard('customer')->user()))
    <?php $routeDH = route('pages.products'); ?>
    @else
    <?php $routeDH = route('customer.login'); ?>
    @endif
    <section class="main-example">
        <div class="container px-4 ">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="flex flex-col justify-center items-center ">
                    <h2 class="w-full bg-red-500 text-white uppercase rounded-md py-2 text-center font-bold">{{trans('index.OrderFor2')}}</h2>
                    <div class="font-bold w-full text-center text-xl mt-3">{{trans('index.TimeRemaining')}}</div>
                    <div class="countdown-container mt-3" id="main-example"></div>
                    <a href="{{$routeDH}}" class="order-cart bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded neonShadow mt-10 js_order_2 ">
                        {{trans('index.Order')}}
                    </a>
                </div>
                <div class="flex flex-col justify-center items-center ">
                    <h2 class="w-full bg-red-500 text-white uppercase rounded-md py-2 text-center font-bold">{{trans('index.OrderFor5')}}</h2>
                    <div class="font-bold w-full text-center text-xl mt-3">{{trans('index.TimeRemaining')}}</div>
                    <div class="countdown-container mt-3" id="main-example-5"></div>
                    <a href="{{$routeDH}}" class="order-cart bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded neonShadow mt-10 js_order_5">
                        {{trans('index.Order')}}
                    </a>
                </div>
            </div>
        </div>
        </div>
    </section>
    @if(!$ishomeProduct->isEmpty())
    <section class="Product-Feature">
        <div class="container px-4">
            <div class="">
                <div class="title-title">
                    <h2 class="title-primary font-semibold">{{$fcSystem['title_1']}} <span class="icon"><img src="../frontend/images/iq.png" alt=""></span></h2>
                    <p class="text-f15 font-normal desc">{{$fcSystem['title_2']}}</p>
                </div>
                <div class="nav-Product-Feature">
                    <div class="swiper mySwiper mySwiper-productSale">
                        <div class="swiper-wrapper">
                            @foreach ($ishomeProduct as $key=>$item)
                            <?php echo htmlItemProduct($key, $item, 'group swiper-slide bg-white rounded-2xl'); ?>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(!$ishomeCategoryProduct->isEmpty())
    @foreach($ishomeCategoryProduct as $item)
    @if(count($item->posts) > 0)
    <section class="pt-8 section-product">
        <div class="container px-4">
            <div class="flex items-center justify-between flex-col lg:flex-row space-y-4 lg:space-y-0">
               <div class="title-title">
                    <h2 class="title-primary font-semibold"><a href="{{route('routerURL',['slug' => $item->slug])}}" class="text-f22 font-bold hover:text-[#3bb77e]">{{$item->title}}</a><span class="icon"><img src="../frontend/images/iq.png" alt=""></span></h2>
                    
                </div>

               
                @if(count($item->children) > 0)
                <div>
                    <ul class="js_ul_menu_home flex flex-wrap space-x-2 ">
                        @foreach($item->children as $child)
                        <li class="mb-2 md:mb-0"><a href="javascript:void(0)" class="float-left bg-[#eee] hover:bg-red-500 hover:text-white text-black font-medium py-2 px-4 rounded neonShadow">{{ $child->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="mt-5 nav-section-product">
                <div class="flex flex-wrap mx-[-15px]">
                    <div class="w-full md:w-1/4 px-[15px]">
                        <div class="img-box overflow-hidden rounded-2xl">
                            <img class="lazy rounded-2xl w-full h-full shadowC object-cover" data-src="{{asset($item->banner)}}">
                        </div>
                    </div>
                    <div class="w-full md:w-3/4 px-[15px]">
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4">
                    
                            @foreach($item->posts as $key=>$val)
                            @if(!empty($val->getProduct))
                            <?php echo htmlItemProduct($key, $val->getProduct); ?>
                            @endif
                            @endforeach
                        </div>
                        <div class="link-link">
                            <a href="" class="order-cart bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded neonShadow mt-10 js_order_5">
                            Xem tất cả
                            </a>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    @endif
    @endforeach
    @endif
    @if($ishomeCategoryArticle && count($ishomeCategoryArticle->posts) > 0)
    <section class="pt-8 new-home">
        <div class="container px-4">
            <div class="title-title">
                <h2 class="title-primary font-semibold"><a href="{{route('routerURL',['slug' => $ishomeCategoryArticle->slug])}}" class="text-f22 font-bold">{{$ishomeCategoryArticle->title}}</a><span class="icon"><img src="../frontend/images/iq.png" alt=""></span></h2>
            </div>
          
            <div class="mt-5">
                <div class="grid gap-5 md:grid-cols-4">
                    @foreach($ishomeCategoryArticle->posts as $item)
                    <div class="hover-box ">
                        <div class=" img-box overflow-hidden">
                            <a href="{{route('routerURL',['slug' => $item->slug])}}">
                                @if(svl_ismobile() == 'is mobile')
                                <img data-src="<?php echo getImageUrl('articles', $item->image, 'small'); ?>" alt="<?php echo $item->title; ?>" class="lazy w-full h-auto lg:h-full">
                                @else
                                <img data-src="<?php echo getImageUrl('articles', $item->image, 'medium'); ?>" alt="<?php echo $item->title; ?>" class="lazy w-full h-auto lg:h-full">
                                @endif
                            </a>
                        </div>
                
                        <div class="nav-img">
                            <a href="{{route('routerURL',['slug' => $item->slug])}}" class="text-f15 md:text-f18 font-bold leading-6 clamp-2 "><?php echo $item->title; ?></a>
                            <div class="content-nav">
                                <span class="text-f13 text-[#fff] italic"><?php echo \Carbon\Carbon::parse($item->created_at)->format('l, m d Y') ?></span>
                                <div class="clamp-3 text-f13 lg:text-f15">
                                    <?php echo $item->description; ?>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-center items-center mt-5">
                <a href="{{route('routerURL',['slug' => $ishomeCategoryArticle->slug])}}" class="news-content-more">{{trans('index.ViewAll')}} {{$ishomeCategoryArticle->title}}</a>
            </div>
        </div>
    </section>
    @endif
</main>
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}" />
@endpush
@push('javascript')
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
                slidesPerView: 2,
                spaceBetween: 10,
            },
            500: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
        }
    });
</script>
@endpush