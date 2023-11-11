@extends('dashboard.layout.dashboard')
@section('title')
<title>Cập nhập nhóm thuộc tính</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Nhóm thuộc tính",
        "src" => route('category_attributes.index'),
    ],
    [
        "title" => "Cập nhập",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Cập nhập");
?>
@endsection
@section('content')
<form role="form" action="{{route('category_attributes.update',['id' => $detail->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row mt-3">
        <div class="col-md-9">
            <div class="card">

                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active show" id="tab1" role="tabpanel">
                            <div>
                                <label for="basiInput" class="form-label">Tên nhóm thuộc tính</label>
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
                        @include('components.image',['action' => 'update','name' => 'image','title'=> 'Ảnh đại diện'])
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
@endsection