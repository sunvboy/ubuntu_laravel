@extends('dashboard.layout.dashboard')
@section('title')
<title>Thêm mới nhóm thành viên</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách nhóm thành viên",
        "src" => route('roles.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, 'Thêm mới nhóm thành viên');
?>
@endsection
@section('content')
<form role="form" action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label fw-bold">Tên nhóm thành viên</label>
                                <?php echo Form::text('title', '', ['class' => 'form-control']); ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label fw-bold">Mô tả</label>
                                <?php echo Form::text('description', '', ['class' => 'form-control w-full ']); ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    @foreach($permissions as $k=>$v)
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="mb-0 flex-grow-1 fw-semibold">{{config('permissions.modules')[$v->title]}}</div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach($v->permissionsChildren as $val)
                        @if($val->title != 'Copy hình ảnh' && $val->title != 'Di chuyển hình ảnh')
                        <div class="form-check col-lg-3">
                            <input name="permission_id[]" class="form-check-input" type="checkbox" value="{{$val->id}}" id="check{{$val->id}}">
                            <label class="form-check-label" for="check{{$val->id}}">
                                {{!empty(config('permissions.actions')[$val->title])?config('permissions.actions')[$val->title]:$val->title}}
                            </label>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

    </div>
    @endforeach
    <div class="row">
        <div class="col-md-12 mb-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-secondary waves-effect waves-light">Lưu thay đổi</button>
        </div>
    </div>
</form>
@endsection