@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách page</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách page",
        "src" => route('pages.index'),
    ]
);
echo breadcrumb_backend($array, "Danh sách page");
?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-3">
                @if(env('APP_ENV') == "local")
                @can('pages_create')
                <!-- Buttons with Label -->
                <a href="{{route('pages.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                @endcan
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TIÊU ĐỀ</th>
                            <th>NGƯỜI TẠO</th>
                            <th>NGÀY TẠO</th>
                            <th>HIỂN THỊ</th>
                            <th class="text-end">#</th>
                        </tr>
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
                                @can('pages_edit')
                                <a href="{{ route('pages.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                @endcan
                                @if(env('APP_ENV') == "local")
                                @can('pages_destroy')
                                <a href="javascript:;" class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa page, trang sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
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
            <div class="d-flex justify-content-end mt-3 px-3">
                {{$data->links()}}
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
@endsection