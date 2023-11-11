@extends('dashboard.layout.dashboard')
@section('title')
<title>Cấu hình hiển thị</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Cấu hình hiển thị",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Cấu hình hiển thị");
?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between p-2">
                <div class="col-md-2">
                    <button disabled="true" type="button" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-all fs-sm-14" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="{{$module}}">
                        <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> <span class="">Xóa tất cả</span>
                    </button>
                </div>
                <a href="{{route('configIs.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
            </div>
            <div class="px-2 mb-3">
                <form action="" class="row gy-2" id="search">
                    @if(!empty($table))
                    <div class="col-md-2">
                        <select class="form-control" name="module">
                            <option value="">Chọn module</option>
                            @foreach($table as $key=>$value)
                            <option value="{{$key}}" <?php if (request()->get('module') == $key) { ?>selected<?php } ?>>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <input type="search" name="keyword" class="keyword form-control filter" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="<?php echo request()->get('keyword') ?>">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-label waves-effect waves-light" type="submit">
                            <i class="ri-search-2-line label-icon align-middle fs-16 me-2"></i> Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="checkbox-all" class="form-check-input">
                            </th>
                            <th>STT</th>
                            <th>TIÊU ĐỀ</th>
                            <th>Module</th>
                            <th>Type</th>
                            <th>NGÀY TẠO</th>
                            <th>HIỂN THỊ</th>
                            <th class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$v)
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                            </td>
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                <?php echo $v->title; ?>
                            </td>
                            <td>
                                <?php echo $table[$v->module]; ?>
                            </td>
                            <td>
                                <?php echo $v->type; ?>
                            </td>
                            <td>
                                @if($v->created_at)
                                {{Carbon\Carbon::parse($v->created_at)->diffForHumans()}}
                                @endif
                            </td>
                            <td>
                                @include('components.isModule',['module' => $module,'title' => 'active','id' =>
                                $v->id])
                            </td>
                            <td class="text-end">
                                <a href="{{ route('configIs.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                <a href="javascript:;" class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa page, trang sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> Delete
                                </a>
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