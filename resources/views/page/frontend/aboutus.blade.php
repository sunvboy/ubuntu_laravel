@extends('homepage.layout.home')
@section('content')
<main class="">
    <section class="relative">
        <img src="<?php echo asset($page->image) ?>" alt="{{$page->title}}" class="w-full h-[170px] md:h-auto object-cover">
        <div class="absolute w-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 md:space-y-3 text-center">
            <h1 class="w-full text-2xl md:text-f40 font-bold text-white uppercase">{{$page->title}}</h1>
            <nav class="bg-grey-light w-full" aria-label="breadcrumb">
                <ol class="flex justify-center">
                    <li><a href="{{url('')}}" class="text-white hover:text-[#a82cb9]">Trang chủ</a></li>
                    <li><span class="text-white mx-2">/</span></li>
                    <li><a href="javascript:void(0)" class="text-white hover:text-[#a82cb9]">{{$page->title}}</a></li>
                </ol>
            </nav>

        </div>
    </section>
    <section class="onyx_box_3 mt-11 md:mt-[100px]">
        <div class="container px-4 md:px-0">
            <div class="grid lg:grid-cols-3 relative">
                <div class="lg:col-span-2  wow fadeInLeft">
                    <img class="hidden lg:block" src="{{asset('frontend/images/image-1.png')}}" alt="">
                    <img class="block lg:hidden" src="{{asset('frontend/images/image-1-mobile.png')}}" alt="">
                </div>
                <div class="lg:col-span-1 space-y-3">
                    <div class="flex items-center space-x-2">
                        <img src="{{asset('frontend/images/icon-logo.png')}}" alt="">
                        <span class="gray9 uppercase font-black ">WHO WE ARE</span>
                    </div>
                    <h2 class="text-[30px] font-black leading-10">
                        Lorem ipsum dolor
                        sit amet, consectetur
                    </h2>
                    <div>
                        Vivamus finibus sit amet ipsum id semper. Suspendisse potenti. Aliquam molestie orci sit amet aliquet egestas. Integer consequat faucibus elit, ut ultrices tortor volutpat rhoncus. Integer finibus, risus gravida dapibus gravida, magna lacus ultricies diam, at aliquet velit arcu nec velit.
                    </div>
                    <div class="space-y-3 lg:space-y-0">
                        <div class="onyx_box_3_item lg:absolute">
                            <h2 class="text-lg font-bold ">
                                Lorem ipsum dolor
                                sit amet, consectetur
                            </h2>
                            <div class="lg:text-sm clamp-2">
                                Vivamus finibus sit amet ipsum id semper. Suspendisse potenti. Aliquam molestie orci sit amet aliquet egestas. Integer consequat faucibus elit, ut ultrices tortor volutpat rhoncus. Integer finibus, risus gravida dapibus gravida, magna lacus ultricies diam, at aliquet velit arcu nec velit.
                            </div>
                        </div>

                        <div class="onyx_box_3_item lg:absolute">
                            <h2 class="text-lg font-bold ">
                                Lorem ipsum dolor
                                sit amet, consectetur
                            </h2>
                            <div class="lg:text-sm clamp-2">
                                Vivamus finibus sit amet ipsum id semper. Suspendisse potenti. Aliquam molestie orci sit amet aliquet egestas. Integer consequat faucibus elit, ut ultrices tortor volutpat rhoncus. Integer finibus, risus gravida dapibus gravida, magna lacus ultricies diam, at aliquet velit arcu nec velit.
                            </div>
                        </div>
                        <div class="onyx_box_3_item lg:absolute">
                            <h2 class="text-lg font-bold ">
                                Lorem ipsum dolor
                                sit amet, consectetur
                            </h2>
                            <div class="lg:text-sm clamp-2">
                                Vivamus finibus sit amet ipsum id semper. Suspendisse potenti. Aliquam molestie orci sit amet aliquet egestas. Integer consequat faucibus elit, ut ultrices tortor volutpat rhoncus. Integer finibus, risus gravida dapibus gravida, magna lacus ultricies diam, at aliquet velit arcu nec velit.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <section class="onyx_box_2 relative z-50 mt-10  wow fadeInUp py-5 lg:py-0">
        <div class="container">
            <div class="page_about_us_0 grid md:grid-cols-3 gap-8 p-5 bg-white lg:pt-0 md:rounded-lg" style="background: url(frontend/images/bg-vct.png) no-repeat;">
                <?php for ($i = 1; $i <= 3; $i++) { ?>
                    <div class="lg:-mt-5 rounded-lg">
                        <div class="flex items-end mb-5">
                            <div class="onyx_stt w-[100px] h-[100px] flex justify-center items-center text-white text-[28px] font-bold">
                                0<?php echo $i ?>
                            </div>
                            <div class="flex-1 ml-5 text-xl font-bold">
                                Lorem ipsum dolor
                                sit amet, consectetur
                            </div>
                        </div>
                        <div>
                            Our people truly care for our work and for each other.
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="onyx_box_4 mt-10 lg:mt-[100px] -mb-5 wow fadeInLeft">
        <div class="container px-4 md:px-0">
            <div class="page_about_us grid md:grid-cols-2 relative gap-8 pb-[250px]" style="background: url(frontend/images/about-us.png) no-repeat; background-size: unset;background-position-x: right; background-position-y: bottom;">
                <div class="col-span-1 space-y-10 wow fadeInLeft">
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2 ">
                            <img src="{{asset('frontend/images/icon-logo.png')}}" alt="">
                            <span class="gray9 uppercase font-black">WHY choose us</span>
                        </div>
                        <h2 class="text-[30px] font-black leading-10">
                            Lorem ipsum dolor sit amet, consectetur
                        </h2>
                        <div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque non aliquet nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                            Integer ac egestas lectus. Etiam vitae nibh aliquam neque vulputate dignissim suscipit quis mi. Aliquam luctus pellentesque mi sed fringilla. Suspendisse ultricies, leo nec suscipit vulputate, magna dolor consectetur lectus, sed tempor libero magna vel ligula. Vestibulum ornare purus a lectus consequat, non euismod velit sagittis. Phasellus pellentesque egestas erat, id suscipit arcu elementum et. Ut congue vestibulum sapien, nec auctor ex porttitor sed. Mauris in turpis sollicitudin nulla porttitor ultrices a id ligula. Donec eleifend mauris sit amet nulla aliquet hendrerit. Morbi elementum luctus sem vel finibus. Quisque sollicitudin nulla et sem elementum consequat. Curabitur egestas urna massa. Nam at metus sed purus vehicula mollis.
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</main>
@endsection