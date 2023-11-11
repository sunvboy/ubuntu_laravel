@extends('dashboard.layout.dashboard')
@section('title')
<title>Nhóm thuộc tính</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Nhóm thuộc tính",
        "src" => route('category_attributes.index'),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Nhóm thuộc tính");
?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-3">
                @can('category_attributes_create')
                <!-- Buttons with Label -->
                <a href="{{route('category_attributes.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                @endcan
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
                            <th nhà cung cấp>STT</th>
                            <th nhà cung cấp>TIÊU ĐỀ</th>
                            <th nhà cung cấp>VỊ TRÍ</th>
                            <th nhà cung cấp>NGƯỜI TẠO</th>
                            <th nhà cung cấp>NGÀY TẠO</th>
                            <th nhà cung cấp>HIỂN THỊ</th>
                            @include('components.table.is_thead')
                            <th nhà cung cấp>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $v)
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td>
                                {{$data->firstItem()+$loop->index}}
                            </td>
                            <td>
                                <a href="{{route('attributes.index',['catalogueid'=>$v->id])}}"><?php echo str_repeat('|----', (($v->level > 0) ? ($v->level - 1) : 0)) . $v->title; ?></a>
                            </td>
                            @include('components.order',['module' => $module])
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
                            @include('components.table.is_tbody')
                            <td class="text-end">
                                <div class="flex justify-center items-center">
                                    @can('category_attributes_edit')
                                    <a href="{{ route('category_attributes.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                                        <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                    </a>
                                    @endcan
                                    @can('category_attributes_destroy')
                                    <a class="btn btn-danger btn-label waves-effect waves-light <?php echo !empty($v->listAttr->count() == 0) ? 'ajax-delete' : '' ?> <?php echo ($v->rgt - $v->lft > 1) ? 'disabled' : ''; ?>
                                    <?php echo !empty($v->listAttr->count() == 0) ? '' : 'disabled' ?>" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa danh mục, danh mục sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
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