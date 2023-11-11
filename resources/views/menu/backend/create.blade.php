@extends('dashboard.layout.dashboard')
@section('title')
<title>Thêm mới media</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách menu",
        "src" => route('menus.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Thêm mới menu");
?>
@endsection
@section('content')
<form action="{{route('menus.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 mb-3">
                        <label for="firstNameinput" class="form-label">Tên menu</label>
                        <?php echo Form::text('title', '', ['class' => 'form-control w-full title', 'required']); ?>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="firstNameinput" class="form-label">Từ khóa</label>
                        <?php echo Form::text('slug', '', ['class' => 'form-control canonical', 'data-flag' => 0, 'required']); ?>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Cập nhập</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('components.publish')
        </div>
    </div>
</form>
@endsection