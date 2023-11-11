@extends('dashboard.layout.dashboard')
@section('title')
<title>Thêm mới thành viên</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách thành viên",
        "src" => route('users.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, 'Thêm mới');
?>
@endsection
@section('content')
<form role="form" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-3">
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Tên thành viên</label>
                                    <?php echo Form::text('name', '', ['class' => 'form-control']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Email</label>
                                    <?php echo Form::text('email', '', ['class' => 'form-control']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Số điện thoại</label>
                                    <?php echo Form::text('phone', '', ['class' => 'form-control']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Địa chỉ</label>
                                    <?php echo Form::text('address', '', ['class' => 'form-control']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control" placeholder="" value="">
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Nhập lại mật khẩu</label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="" value="">
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Chọn nhóm thành viên</label>
                                    <select class="form-control" data-placeholder="Search..." name="role_id[]" tabindex="-1">
                                        <option value="">Chọn nhóm thành viên</option>
                                        @foreach($roles as $k=>$v)
                                        <option value="{{$v->id}}" {{ (collect(old('role_id'))->contains($v->id)) ? 'selected':'' }}>
                                            {{$v->title}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                @include('user.backend.user.image',['action' => 'create'])
                            </div>
                            <div class="col-xxl-12 col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary w-24">Thêm mới</button>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
@endsection