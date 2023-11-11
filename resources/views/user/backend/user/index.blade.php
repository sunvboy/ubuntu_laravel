@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách thành viên</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách thành viên",
        "src" => route('users.index'),
    ]
);
echo breadcrumb_backend($array, 'Danh sách thành viên');
?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-3">
                @can('users_create')
                <!-- Buttons with Label -->
                <a href="{{route('users.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                @endcan
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên thành viên </th>
                            <th scope="col">Email </th>
                            <th scope="col">Nhóm thành viên </th>
                            <th scope="col" class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $v)
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td><span><span class="fw-semibold">{{$data->firstItem()+$loop->index}}</span></span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img alt="{{$v->name}}" class="rounded-circle" style="width: 75px;height: 75px;" src="<?php echo File::exists(base_path($v->image)) ? asset($v->image) : 'https://ui-avatars.com/api/?name=' . $detail->name ?>">
                                    <div class="ms-2">
                                        {{$v->name}}
                                        @can('users_edit')
                                        <div>
                                            <a data-url="{{ route('users.reset-password',['id'=>$v->id])}}" href="javascript:void(0)" class="p-reset text-warning" data-userid="{{$v->id}}">RESET mật khẩu</a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                            <td> {{$v->email}}</td>
                            <td>
                                @foreach($v->roles as $v1)
                                <a href="{{ route('roles.edit',['id'=>$v1->id]) }}" class="btn btn-warning btn-sm">{{$v1->title}}</a>
                                @endforeach
                            </td>
                            <td class="text-end">
                                @can('users_edit')
                                <a href="{{ route('users.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                @endcan
                                @can('users_destroy')
                                <a href="javascript:;" class="btn btn-danger btn-label waves-effect waves-light p-destroy" data-url="{{ route('users.destroy',['id'=>$v->id]) }}" data-id="{{ $v->id }}">
                                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> Delete
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3 px-3">
                {{$data->links()}}
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
@endsection
@push('javascript')
<script src="{{ asset('backend/library/users.js') }}"></script>
@endpush