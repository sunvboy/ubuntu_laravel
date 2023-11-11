@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách nhóm thành viên</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách nhóm thành viên",
        "src" => route('roles.index'),
    ]
);
echo breadcrumb_backend($array, 'Danh sách nhóm thành viên');
?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-3">
                @can('roles_create')
                <!-- Buttons with Label -->
                <a href="{{route('roles.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                @endcan
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên nhóm thành viên </th>
                            <th scope="col" class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $v)
                        <tr class="align-middle odd " id="post-<?php echo $v->id; ?>">
                            <td><span><span class="fw-semibold">{{$data->firstItem()+$loop->index}}</span></span></td>
                            <td>{{$v->title}}</td>
                            <td class="text-end">
                                @can('roles_edit')
                                <a href="{{ route('roles.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                @endcan
                                @can('roles_destroy')
                                <a href="javascript:;" class="btn btn-danger btn-label waves-effect waves-light p-destroy" data-url="{{ route('roles.destroy',['id'=>$v->id]) }}" data-id="{{ $v->id }}">
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
<script src="{{ asset('backend/library/role.js') }}"></script>
@endpush