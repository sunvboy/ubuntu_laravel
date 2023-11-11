@extends('homepage.layout.home')
@section('content')
<nav class="relative w-full flex flex-wrap items-center justify-between py-2 bg-[#f9f9f9] text-gray-500 hover:text-gray-700 focus:text-gray-700 navbar navbar-expand-lg navbar-light">
    <div class="container px-4 mx-auto w-full flex flex-wrap items-center justify-between">
        <nav class="bg-grey-light w-full" aria-label="breadcrumb">
            <ol class="list-reset flex">
                <li><a href="<?php echo url('') ?>" class="text-gray-500 hover:text-gray-600 text-f13">{{trans('index.home')}}</a></li>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li><a href="javascript:void(0)" class="text-gray-500 hover:text-gray-600 text-f13">{{$page->title}}</a></li>
            </ol>
        </nav>
    </div>
</nav>
<main class="py-8 ">
    <div class=" container mx-auto px-4">
        <div class="rounded-xl overflow-hidden shadowC hidden">
            <div class=" px-6 py-4 bg-white float-left w-full flex flex-col space-y-2">
                <h1 class="text-3xl font-bold">{{$page->title}}</h1>
            </div>
        </div>
        <div class="flex flex-col md:flex-row md:space-x-4 relative " id="scrollTop">
            <div class="tp_scroll w-full md:w-[274px] side-left h-[100vh] sticky inset-0 overflow-auto pr-1 hidden md:block" style="z-index: 99999999;" id="tp-col-filter">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 pb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        <span class="font-bold text-gray-600">{{trans('index.Filter')}}</span>
                    </div>
                    <div class="cursor-pointer js_close_filter_mobile block md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col pb-6">
                    <div class="w-full py-4">
                        <div class="flex justify-between items-center ">
                            <h4 class="text-base font-bold uppercase">{{trans('index.PriceRange')}}</h4>
                        </div>
                    </div>
                    <div>
                        <input type="text" class="js-range-slider" name="my_range" value="" />
                        <div class="mt-1">
                            <div class="flex  gap-4">
                                <div class="w-1/2">
                                    <label class="">{{trans('index.Start')}} (tr)</label>
                                    <input placeholder=".000" type="text" value="" class="filter border w-full h-11 px-2 focus:outline-none  hover:outline-none" name="price_start">
                                </div>
                                <div class="w-1/2">
                                    <label class="">{{trans('index.End')}} (tr)</label>
                                    <input placeholder=".000" type="text" value="" class="filter border w-full h-11 px-2 focus:outline-none  hover:outline-none " name="price_end">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!$brands->isEmpty())
                <div class="filter-box flex flex-col pb-6 border-b">
                    <div class="w-full py-4">
                        <div class="flex justify-between items-center ">
                            <h4 class="text-base font-bold uppercase">{{trans('index.Brands')}}</h4>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($brands as $item)
                        <label for="brand-{{$item->id}}" class="js_brand relative px-4 py-2 text-center bg-white hover:bg-red-100 hover:border-red-100 rounded-md cursor-pointer border">
                            <input id="brand-{{$item->id}}" type="checkbox" data-title="{{$item->title}}" value="{{$item->id}}" class="js_input_brand filter hidden" name="brands[]">
                            <span class="">{{$item->title}}</span>
                            <div class="product-filter-tick">
                                <svg enable-background="new 0 0 12 12" viewBox="0 0 12 12" x="0" y="0" class="shopee-svg-icon icon-tick-bold">
                                    <g>
                                        <path d="m5.2 10.9c-.2 0-.5-.1-.7-.2l-4.2-3.7c-.4-.4-.5-1-.1-1.4s1-.5 1.4-.1l3.4 3 5.1-7c .3-.4 1-.5 1.4-.2s.5 1 .2 1.4l-5.7 7.9c-.2.2-.4.4-.7.4 0-.1 0-.1-.1-.1z"></path>
                                    </g>
                                </svg>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(!$category_attribute->isEmpty())
                @foreach ($category_attribute as $key=>$item)
                @if(count($item->listAttr) > 0)
                <div class="filter-box flex flex-col pb-6 border-b">
                    <div class="w-full py-4">
                        <div class="flex justify-between items-center ">
                            <h4 class="text-base font-bold uppercase">{{$item->title}}</h4>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($item->listAttr as $val)
                        <label for="attr-{{$val['id']}}" class="js_attr relative px-4 py-2 text-center bg-white hover:bg-red-100 hover:border-red-100 rounded-md cursor-pointer border">
                            <input id="attr-{{$val['id']}}" type="checkbox" value="{{$val['id']}}" data-title="{{$val['title']}}" data-keyword="{{$item->keyword}}" class="js_input_attr filter hidden" name="attr[]">
                            <span>{{$val['title']}}</span>
                            <div class="product-filter-tick">
                                <svg enable-background="new 0 0 12 12" viewBox="0 0 12 12" x="0" y="0" class="shopee-svg-icon icon-tick-bold">
                                    <g>
                                        <path d="m5.2 10.9c-.2 0-.5-.1-.7-.2l-4.2-3.7c-.4-.4-.5-1-.1-1.4s1-.5 1.4-.1l3.4 3 5.1-7c .3-.4 1-.5 1.4-.2s.5 1 .2 1.4l-5.7 7.9c-.2.2-.4.4-.7.4 0-.1 0-.1-.1-.1z"></path>
                                    </g>
                                </svg>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif
                @endforeach
                @endif
                <input id="choose_attr" class="w-full hidden" type="text" name="attr">
            </div>
            <div class="flex-1 pb-6">
                <div class="flex flex-col md:flex-row justify-between space-y-2 md:space-y-0">
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute top-1/2 left-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="transform: translateY(-50%);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input placeholder="{{trans('index.SearchPlaceholder')}}" type="text" value="" class="filter rounded-full border w-full md:w-[421px] h-11 px-8 focus:outline-none focus:ring focus:ring-red-300 focus:rounded-full hover:outline-none hover:ring hover:ring-red-300 hover:rounded-full" name="keywordFilter">
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex md:hidden items-center space-x-1 cursor-pointer js-handle-filter-mobile">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                            </svg>
                            <span>
                                {{trans('index.Filter')}}
                            </span>
                        </div>
                        <select name="sortBy" class="filter rounded-full border h-11 px-8 focus:outline-none focus:ring focus:ring-red-300 focus:rounded-full hover:outline-none hover:ring hover:ring-red-300 hover:rounded-full">
                            <option value="">{{trans('index.SortedBy')}}</option>
                            <option value="id|desc">{{trans('index.Latest')}}</option>
                            <option value="id|asc">{{trans('index.Oldest')}}</option>
                            <option value="title|asc">{{trans('index.NameAZ')}}</option>
                            <option value="title|desc">{{trans('index.NameZA')}}</option>
                            <option value="price|asc">{{trans('index.PricesGoUp')}}</option>
                            <option value="price|desc">{{trans('index.PricesGoDown')}}</option>
                        </select>
                    </div>

                </div>
                <section class="p-5 bg-red-50 rounded-2xl mt-6">
                    <h3 class="font-normal text-base">
                        @if(config('app.locale') == 'vi')
                        Có <strong class="js_total_filter"><?php echo $data->total() ?></strong> sản phẩm phù hợp với tiêu chí của bạn
                        @elseif(config('app.locale') == 'en')
                        There is <strong class="js_total_filter"><?php echo $data->total() ?></strong> product that matches your criteria
                        @elseif(config('app.locale') == 'gm')
                        Es gibt <strong class="js_total_filter"><?php echo $data->total() ?></strong> Produkt, das Ihren Kriterien entspricht
                        @elseif(config('app.locale') == 'tl')
                        มี <strong class="js_total_filter"><?php echo $data->total() ?></strong> ผลิตภัณฑ์ที่ตรงกับเกณฑ์ของคุณ
                        @endif
                    </h3>
                    <div class="mt-2 t-flex-gap">
                        <div id="js_selected_attr" class="flex flex-wrap gap-4 hidden">
                        </div>
                    </div>
                </section>

                <div class="mt-4">
                    <div class="grid grid-cols-2 md:grid-cols-3  lg:grid-cols-4 gap-4" id="js_data_product_filter">
                        @if($data)
                        @foreach ($data as $key=>$item)
                        <?php echo htmlItemProduct($key, $item); ?>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="mt-5">
                    <div class="flex justify-center js_pagination_filter">
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@include('product.frontend.category.script')