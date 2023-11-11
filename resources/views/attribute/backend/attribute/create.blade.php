@extends('dashboard.layout.dashboard')

@section('title')
<title>Thêm mới thuộc tính</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách thuộc tính",
        "src" => route('attributes.index'),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách thuộc tính");
?>
@endsection
@section('content')
<form role="form" action="{{route('attributes.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row mt-3">
        <div class="col-md-9">
            <div class="card">

                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active show" id="tab1" role="tabpanel">
                            <div>
                                <label for="basiInput" class="form-label">Tiêu đề</label>
                                <?php echo Form::text('title', '', ['class' => 'form-control title']); ?>
                            </div>
                            <div class="mt-3">
                                <label for="basiInput" class="form-label">Đường dẫn</label>
                                <div class="input-group">
                                    <div class="input-group-text vertical-1"><span class="vertical-1"><?php echo url(''); ?></span>
                                    </div>
                                    <?php echo Form::text('slug', '', ['class' => 'form-control canonical', 'data-flag' => 0]); ?>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Mô tả</label>
                                <div class="mt-2">
                                    <?php echo Form::textarea('description', '', ['id' => 'ckDescription', 'class' => 'ck-editor', 'style' => 'height:60px;font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                                </div>
                            </div>
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
                        <div class="mt-3">
                            <label class="form-label ">Chọn nhóm thuộc tính</label>
                            <?php echo Form::select('catalogueid', $htmlOption, old('catalogueid'), ['class' => 'tom-select tom-select-field w-full', 'data-placeholder' => "Select your favorite actors"]); ?>
                        </div>
                        <div class="mt-3 d-none">
                            <label class="form-label ">Màu sắc</label>
                            <?php echo Form::text('color', old('color'), ['placeholder' => '', 'class' => 'form-control ', 'autocomplete' => 'off']); ?>

                        </div>
                        <div class="mt-3">
                            <label class="form-label">Khoảng giá</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <?php echo Form::text('price_start', old('price_start'), ['placeholder' => 'Từ', 'class' => 'form-control int', 'autocomplete' => 'off', 'style' => 'width: calc(100% - 30px);']); ?>
                                <span style="margin: 0px 5px;">-</span>
                                <?php echo Form::text('price_end',  old('price_end'), ['placeholder' => 'đến', 'class' => 'form-control int', 'autocomplete' => 'off', 'style' => 'width: calc(100% - 30px);']); ?>
                            </div>
                        </div>
                        @include('components.image',['action' => 'create','name' => 'image','title'=> 'Ảnh đại diện'])

                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
@endsection
@include('article.backend.script')