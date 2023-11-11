@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách sản phẩm</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách sản phẩm",
        "src" => route('products.index'),
    ]
);
echo breadcrumb_backend($array, "Danh sách sản phẩm");

?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between py-3 px-2">
                <button id="ajax-delete-all" disabled="true" type="button" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-all-product fs-sm-14" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="{{$module}}">
                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> <span class="">Xóa tất cả</span>
                </button>
                <div>
                    @can('products_create')
                    <!-- Buttons with Label -->
                    <a href="{{route('products.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                    </a>
                    @endcan
                    <a class="btn btn-primary btn-label waves-effect waves-light ms-1 full-search" href="javascript:void(0);">
                        <i class="ri-search-2-line label-icon align-middle fs-16 me-2"></i>
                        Tìm kiếm nâng cao
                    </a>
                </div>
            </div>
            <div class="px-2 mb-3">
                <div class="row gy-2">
                    <div class="col-md-4">
                        <?php echo Form::select('catalogue_id', $htmlOption, request()->get('catalogue_id'), ['class' => 'tom-select tom-select-field filter catalogue_id', 'data-placeholder' => "Select your favorite actors"]); ?>
                    </div>
                    <div class="col-md-4">
                        <input type="search" name="keyword" class="keyword form-control filter" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="<?php echo request()->get('keyword') ?>">
                    </div>
                    <div class="col-md-2 d-none">
                        <button class="btn btn-primary btn-label waves-effect waves-light" type="submit">
                            <i class="ri-search-2-line label-icon align-middle fs-16 me-2"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
            </div>
            <!-- START: tìm kiếm -->
            <div class="px-2 mb-3 row filter-more row d-none">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nhập khoảng giá</label>
                    <div class="row">
                        <div class="col-md-6 input-group w-50">
                            <div class="input-group-text">Từ</div>
                            <input type="text" class="form-control int filter h-10" name="start_price" value="">
                        </div>
                        <div class="col-md-6 input-group w-50">
                            <div class="input-group-text">Đến</div>
                            <input type="text" class="form-control int filter h-10" name="end_price" value="">
                        </div>
                    </div>
                </div>
                <div class="col-md-4  <?php if (!in_array('tags', $dropdown)) { ?>d-none<?php } ?>">
                    <label class="form-label fw-semibold">Tags</label>
                    <select class="tom-select tom-select-tag filter" data-placeholder="Tìm kiếm tag..." data-header="Tags" multiple="multiple" name="tags[]" tabindex="-1" hidden="hidden">
                        @if(isset($tags))
                        @foreach($tags as $k=>$tag)
                        <option value="{{$tag->id}}">
                            {{$tag->title}}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-4 <?php if (!in_array('brands', $dropdown)) { ?>d-none<?php } ?>">
                    <label class="form-label fw-semibold">Thương hiệu</label>
                    <select class="tom-select tom-select-brand filter" data-placeholder="Tìm kiếm thương hiệu..." data-header="Thương hiệu" multiple="multiple" name="brands[]" tabindex="-1" hidden="hidden">
                        @if(isset($brands))
                        @foreach($brands as $k=>$brand)
                        <option value="{{$brand->id}}">
                            {{$brand->title}}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-12" id="selected_attr"></div>
                <div class="col-md-12 mt-3">
                    <div id="choose_attr">
                        <label class="form-label fw-semibold">Thuộc tính</label>
                        <input type="text" class="d-none filter" name="attr" value="">
                        <ul class="list_attr_catalogue bg-white ps-0 row" style="display: none;list-style: none;">
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: tìm kiếm -->
            <div id="data_product" class="col-span-12 overflow-auto lg:overflow-visible">
                @include('product.backend.product.index.data')
            </div>

        </div>
    </div>
    <!-- end col -->
</div>
@endsection
@push('javascript')

@include('product.backend.product.index.script')

@endpush