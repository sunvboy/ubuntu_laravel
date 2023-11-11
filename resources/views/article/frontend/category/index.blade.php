@extends('homepage.layout.home')
@section('content')

<main class=" main-new main-child">
<section class="bread-crumb" style="background: linear-gradient(0deg, rgba(0,0,0,0.8), rgba(0,0,0,0.3)),  url(//bizweb.dktcdn.net/100/485/131/themes/906771/assets/breadcrumb.jpg?1686556941849) no-repeat center;">
        <div class="container">
            <div class="title-bread-crumb">
                Thực đơn giảm cân 1 tháng, bí kíp giảm cân hiệu quả, an toàn
            </div>
            <nav class="bg-grey-light w-full" aria-label="breadcrumb">
                        <ol class="list-reset flex">
                        <li><a href="<?php echo url('') ?>" class="text-gray-500 hover:text-gray-600">{{trans('index.home')}}</a></li>
                        @foreach($breadcrumb as $k=>$v)
                        <li><span class="text-gray-500 mx-2">/</span></li>
                        <li><a href="<?php echo route('routerURL', ['slug' => $v->slug]) ?>" class="text-gray-500 hover:text-gray-600">{{ $v->title}}</a></li>
                        @endforeach
                    </ol>
                </nav>
            
        </div>
    </section>

   <div class="container px-4">
      @if(count($detail->children) > 0)
      <ul class="flex flex-wrap space-x-4">
         @foreach($detail->children as $item)
         <li class=" mb-2 md:mb-0">
            <a class="hover:border-b-2 pb-1 hover:border-[#3bb77e] hover:text-[#3bb77e] font-semibold" href="{{route('routerURL',['slug' => $item->slug])}}">{{$item->title}}</a>
         </li>
         @endforeach
      </ul>
      @endif
      <div class="flex flex-wrap mx-[-15px] row_15">
         <div class="w-full md:w-3/4 px-[15px]">
            <div class="new-home-content new-home">
               <div class="title-title">
                  <h1 class="title-primary text-2xl font-semibold">{{$detail->title}}<span class="icon"><img src="../frontend/images/iq.png" alt=""></span></h1>
               </div>
               <div class="mt-5">
                  <div class="grid gap-5 md:grid-cols-3">
                   
                     @foreach($data as $k => $item)
                        @if($k > 1) 
                        <div class="hover-box ">
                                <div class=" img-box overflow-hidden">
                                <a href="{{route('routerURL',['slug' => $item->slug])}}">
                                <img data-src="{{asset($item->image)}}" alt="{{$item->title}}" class="lazy h-auto md:h-[250px] object-cover w-full">
                                </a>
                                </div>
                                <div class="nav-img">
                                <a href="{{route('routerURL',['slug' => $item->slug])}}" class="text-f15 md:text-f18 font-bold leading-6 clamp-2 "><?php echo $item->title; ?></a>
                                <div class="content-nav">
                                <span class="text-f13 text-[#999] italic"><?php echo \Carbon\Carbon::parse($item['created_at'])->format('l, m d Y') ?></span>
                                    <div class="clamp-3 text-f13 lg:text-f15">
                                        <?php echo $item->description ?>
                                    </div>
                                </div>
                                </div>
                            </div>


                        
                        @endif
                        @endforeach
                    
                  </div>
                  <div class="mt-10 flex justify-center">
                        <?php echo $data->links() ?>
                    </div>
               </div>
            </div>
         </div>
         <div class="w-full md:w-1/4 px-[15px]">
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
         </div>
      </div>
      
   </div>
</main>
@endsection
@push('javascript')
@endpush