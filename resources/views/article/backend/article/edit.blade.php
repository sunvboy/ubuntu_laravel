@extends('dashboard.layout.dashboard')

@section('title')
<title>Cập nhập bài viết</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách bài viết",
        "src" => route('articles.index'),
    ],
    [
        "title" => "Cập nhập",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Cập nhập bài viết");
?>
@endsection
@section('content')
<form role="form" action="{{route('articles.update',['id' => $detail->id])}}" method="post" enctype="multipart/form-data">
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
                                <?php echo Form::text('title', $detail->title, ['class' => 'form-control title']); ?>
                            </div>
                            <div class="mt-3">
                                <label for="basiInput" class="form-label">Đường dẫn</label>
                                <div class="input-group">
                                    <div class="input-group-text vertical-1"><span class="vertical-1"><?php echo url(''); ?></span>
                                    </div>
                                    <?php echo Form::text('slug', $detail->slug, ['class' => 'form-control canonical', 'data-flag' => 0]); ?>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Mô tả</label>
                                <div class="mt-2">
                                    <?php echo Form::textarea('description', $detail->description, ['id' => 'ckDescription', 'class' => 'ck-editor', 'style' => 'height:60px;font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Nội dung</label>
                                <div class="mt-2">
                                    <?php echo Form::textarea('content', $detail->content, ['id' => 'ckContent', 'class' => 'ck-editor', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
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
                        <button type="submit" class="btn btn-primary w-24">Cập nhập</button>
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
                        <div class="mt-3">
                            <label class="form-label">Chọn danh mục chính</label>
                            <?php echo Form::select('catalogue_id', $htmlCatalogue, !empty(old('catalogue_id')) ? old('catalogue_id') : (!empty($detail->catalogue_id) ? $detail->catalogue_id : ''), ['class' => 'tom-select tom-select-field', 'data-placeholder' => "Select your favorite actors"]); ?>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Chọn danh mục phụ</label>
                            <?php echo Form::select('catalogue[]', $htmlCatalogue, $getCatalogue, ['multiple', 'class' => 'tom-select tom-select-multiple', 'data-placeholder' => "Select your favorite actors"]); ?>
                        </div>
                        @include('components.image',['action' => 'update','name' => 'image','title'=> 'Ảnh đại diện'])
                        @include('components.tag',['module' => $module])
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
@endsection
@include('article.backend.script')