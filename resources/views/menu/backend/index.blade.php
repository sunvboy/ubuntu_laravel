@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách menu</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách menu",
        "src" => route('menus.index'),
    ]
);
echo breadcrumb_backend($array, "Danh sách menu");
?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            @if( env('APP_ENV') == "local")
            <div class="d-flex justify-content-end p-2">
                <div class="d-flex">
                    @can('menus_create')
                    <!-- Buttons with Label -->
                    <a href="{{route('menus.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                    </a>
                    @endcan
                </div>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <th>ID</th>
                        <th>TIÊU ĐỀ</th>
                        <th>NGƯỜI TẠO</th>
                        <th>NGÀY TẠO</th>
                        <th>HIỂN THỊ</th>
                        <th class="text-end">#</th>
                    </thead>
                    <tbody>
                        @foreach($data as $v)
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td>
                                {{$v->id}}
                            </td>
                            <td>
                                <?php echo $v->title; ?>
                            </td>
                            <td>
                                {{$v->user->name}}
                            </td>
                            <td>
                                @if($v->created_at)
                                {{Carbon\Carbon::parse($v->created_at)->diffForHumans()}}
                                @endif
                            </td>
                            <td class="w-40">
                                @include('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                                $v->id])
                            </td>
                            <td class="text-end">
                                @can('menus_edit')
                                <a class="btn btn-primary btn-label waves-effect waves-light" href="{{ route('menus.edit',['id'=>$v->id]) }}">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                @endcan
                                @if( env('APP_ENV') == "local")
                                @can('menus_destroy')
                                <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa thương hiệu, thương hiệu sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> Delete
                                </a>
                                @endcan
                                @endif
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