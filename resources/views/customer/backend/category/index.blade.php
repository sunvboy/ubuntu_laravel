@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách nhóm thành viên</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách nhóm thành viên",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách nhóm thành viên");
?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-3">
                @can('customers_create')
                <!-- Buttons with Label -->
                <a href="{{route('customer_categories.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                @endcan
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Ngày đăng</th>
                            <th scope="col" class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $v)
                        <tr class="align-middle odd " id="post-<?php echo $v->id; ?>">
                            <td><span><span class="fw-semibold">{{$data->firstItem()+$loop->index}}</span></span></td>
                            <td>{{$v->title}}({{$v->customers->count()}})</td>
                            <td>{{$v->created_at}}</td>
                            <td class="text-end">
                                @can('customers_edit')
                                <a href="{{ route('customer_categories.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                @endcan
                                @can('customers_destroy')
                                <a href="javascript:;" class="btn btn-danger btn-label waves-effect waves-light <?php echo !empty($v->customers->count() == 0) ? 'ajax-delete' : '' ?> <?php echo !empty($v->customers->count() == 0) ? '' : 'disabled' ?>" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa thương hiệu, thương hiệu sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
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