@extends('dashboard.layout.dashboard')

@section('title')
<title>Thêm mới page</title>
@endsection
<!--START: breadcrumb -->
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách page",
        "src" => route('pages.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
<!--END: breadcrumb -->
@section('content')
<form role="form" action="{{route('pages.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row mt-3">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <div class="flex-shrink-0 ms-2">
                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tab1" role="tab" aria-selected="true">
                                    Thông tin chung
                                </a>
                            </li>
                            @if(!$field->isEmpty())
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab2" role="tab" aria-selected="false" tabindex="-1">
                                    Custom field
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active show" id="tab1" role="tabpanel">
                            <div>
                                <label for="basiInput" class="form-label">Tiêu đề</label>
                                <?php echo Form::text('title', '', ['class' => 'form-control']); ?>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Mô tả</label>
                                <div class="mt-2">
                                    <?php echo Form::textarea('description', '', ['id' => 'ckDescription', 'class' => 'ck-editor', 'style' => 'height:60px;font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2" role="tabpanel">
                            @include('components.field.index', ['module' => $module])
                        </div>
                    </div>
                </div><!-- end card-body -->
                <div class="card-body">
                    <!-- start: SEO -->
                    @include('components.seo')
                    <!-- end: SEO -->
                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-primary w-24">Lưu</button>
                    </div>
                </div>
            </div><!-- end card -->
        </div>
        <!--end col-->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        @include('components.publish')
                        @include('components.image',['action' => 'create','name' => 'image','title'=> 'Ảnh đại diện'])
                        <div class="mt-3">
                            <label class="form-label">Trang</label>
                            <div class="mt-2">
                                <?php echo Form::select('page', config('page'), old('page'), ['class' => 'tom-select tom-select-field']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
@endsection
@include('article.backend.script')