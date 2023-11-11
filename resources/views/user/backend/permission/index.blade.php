@extends('dashboard.layout.dashboard')

@section('title')
<title>Danh sách nhóm phân quyền</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách nhóm phân quyền",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách nhóm phân quyền");
?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end py-3 px-2">
                <a href="{{route('permissions.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên module</th>
                            <th class="text-end">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $k=>$v)
                        <tr class="odd " id="post-<?php echo $v->id; ?>">
                            <td>
                                {{$k+1}}
                            </td>
                            <td>{{config('permissions.modules')[$v->title]}}</td>
                            <td class="d-flex justify-content-end">
                                @include('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                                $v->id])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- end col -->
</div>
@endsection