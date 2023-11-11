@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách mã giảm giá</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách counpon",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách mã giảm giá");
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
                <div class="d-flex">
                    @can('coupons_create')
                    <!-- Buttons with Label -->
                    <a href="{{route('coupons.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                    </a>
                    @endcan
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
                        <th>
                            <input type="checkbox" id="checkbox-all" class="form-check-input">
                        </th>
                        <th>STT</th>
                        <th>Mã giảm giá</th>
                        <th>Tiêu đề</th>
                        <th>Vị trí</th>
                        <th>Ngày tạo</th>
                        <th>Người tạo</th>
                        <th>Sử dụng / Giới hạn</th>
                        <th>Hiển thị</th>
                        <th>Sử dụng kết hợp<br> cùng các mã ưu đãi khác</th>
                        <th class="text-end">#</th>
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
                            <td class="text-danger">
                                <?php echo $v->name; ?>
                            </td>
                            <td>
                                <?php echo $v->title; ?>
                            </td>
                            @include('components.order',['module' => $module])
                            <td>
                                @if($v->created_at)
                                {{Carbon\Carbon::parse($v->created_at)->diffForHumans()}}
                                @endif
                            </td>
                            <td>
                                {{$v->user->name}}
                            </td>
                            <td>
                                {{$v->coupon_relationship()->count()}} /
                                @if(!empty($v->limit))

                                {{$v->limit}}
                                @else
                                ∞
                                @endif
                            </td>

                            <td class="w-40">
                                @include('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                                $v->id])
                            </td>
                            <td class="w-40">
                                @include('components.publishTable',['module' => $module,'title' => 'individual_use','id' =>
                                $v->id])
                            </td>
                            <td class="text-end">
                                <div class="flex justify-center items-center">

                                    @can('coupons_edit')
                                    <a class="btn btn-primary btn-label waves-effect waves-light" href="{{ route('coupons.edit',['id'=>$v->id]) }}">
                                        <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                    </a>
                                    @endcan
                                    @can('coupons_destroy')
                                    <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa thương hiệu, thương hiệu sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
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