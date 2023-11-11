@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách liên hệ</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách liên hệ",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách liên hệ");
?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between p-2">
                <div class="col-md-2 ">
                    <button id="ajax-delete-all" disabled="true" type="button" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-all fs-sm-14" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="{{$module}}">
                        <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> <span class="">Xóa tất cả</span>
                    </button>
                </div>
            </div>
            <div class="px-2 mb-3">
                <form action="" class="row gy-2" id="search">

                    <div class="col-md-2">
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
                            @can('contacts_index')
                            <th>
                                <input type="checkbox" id="checkbox-all" class="form-check-input">
                            </th>
                            @endcan
                            <th>STT</th>
                            <th>Thông tin</th>
                            <th>Nội dung</th>
                            <th>Ngày gửi</th>
                            <th class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $v)
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                            </td>
                            <td>
                                {{$data->firstItem()+$loop->index}}
                            </td>
                            <td>
                                <span><?php echo $v->fullname; ?></span><br>
                                <span><?php echo $v->phone; ?></span><br>
                                <span><?php echo $v->address; ?></span><br>
                                <span><?php echo $v->email; ?></span><br>
                            </td>
                            <td style="white-space: inherit;">
                                {{$v->message}}
                            </td>
                            <td>
                                {{$v->created_at}}
                            </td>
                            <td class="text-end">
                                <div class="flex justify-center items-center">
                                    @can('contacts_index')
                                    <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa danh mục, danh mục sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                        <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> Delete
                                    </a>
                                    @endcan
                                </div>
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