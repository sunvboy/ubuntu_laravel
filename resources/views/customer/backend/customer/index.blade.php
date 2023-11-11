@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách khách hàng</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách khách hàng",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách khách hàng");
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
                    @can('customers_create')
                    <!-- Buttons with Label -->
                    <a href="{{route('customers.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                    </a>
                    @endcan
                    <a href="{{route('customers.export')}}" class="btn btn-success btn-label waves-effect waves-light ms-1">
                        <i class="ri-file-excel-fill label-icon align-middle fs-16 me-2"></i> Xuất excel
                    </a>
                </div>
            </div>
            <div class="px-2 mb-3">
                <form action="" class="row gy-2" id="search">

                    <div class="col-md-2">
                        <?php echo Form::select('order', array('0' => 'Mua hàng', '1' => 'Đã mua hàng', '2' => 'Chưa mua hàng'), request()->get('order'), ['class' => 'form-control', 'data-placeholder' => "Select your favorite actors"]); ?>
                    </div>
                    @if(isset($category))
                    <div class="col-md-2">
                        <?php echo Form::select('catalogueid', $category, request()->get('catalogueid'), ['class' => 'form-control', 'data-placeholder' => "Select your favorite actors"]); ?>
                    </div>
                    @endif
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
                        <th>Mã khách hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Số dư</th>
                        <th>Ngày tạo</th>
{{--                        <th>Mua hàng</th>--}}
                        <th>Hoạt động</th>
                        <th class="text-end">#</th>
                    </thead>
                    <tbody>
                        @foreach($data as $v)
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                            </td>
                            <td>
                                <a class="fw-bold text-danger" href="{{ route('carts.index',['customer_id'=>$v->id]) }}">{{$v->code}}</a>
                            </td>
                            <td>
                                <a class="d-flex align-items-center" href="{{ route('carts.index',['customer_id'=>$v->id]) }}">
                                    <div style="width: 64px;">
                                        <img alt="{{$v->name}}" class="rounded-circle" src="{{File::exists(base_path($v->image)) ? asset($v->image) : 'https://ui-avatars.com/api/?name='.$v->name}}">
                                    </div>
                                    <div class="mx-2">
                                        {{$v->name}}<br>{{$v->email}}<br>{{$v->phone}}
                                    </div>
                                </a>
                            </td>
                            <td>
                                <span class="text-danger font-bold">{{number_format($v->price,'0',',', '.')}}đ</span>
                            </td>
                            <td>
                                {{$v->created_at}}
                            </td>
                            <td class="d-none">
                                @if(count($v->orders) > 0)
                                <a href="{{ route('customers.orders',['id'=>$v->id]) }}" class="btn btn-success btn-sm">{{count($v->orders)}} đơn hàng</a>
                                @else
                                <span class="btn btn-primary btn-sm text-xs">Chưa mua hàng</span>
                                @endif
                            </td>
                            <td>
                                @include('components.isModule',['module' => $module,'title' => 'active','id' =>
                                $v->id])
                            </td>
                            <td class="text-end">
                                <div class="flex justify-center items-center">
                                    @can('orders_index')
{{--                                    <a class="btn btn-primary btn-label waves-effect waves-light" href="{{ route('customers.orders',['id'=>$v->id]) }}">--}}
{{--                                        <i class="ri-eye-line label-icon align-middle fs-16 me-2"></i> Xem đơn hàng--}}
{{--                                    </a>--}}
                                    <a class="btn btn-primary btn-label waves-effect waves-light" href="{{ route('carts.index',['customer_id'=>$v->id]) }}">
                                        <i class="ri-eye-line label-icon align-middle fs-16 me-2"></i> Xem đơn hàng
                                    </a>
                                    @endif
                                    @can('customers_edit')
                                    <a class="btn btn-primary btn-label waves-effect waves-light" href="{{ route('customers.edit',['id'=>$v->id]) }}">
                                        <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                    </a>
                                    @endcan
                                    @can('customers_destroy')
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
@push('javascript')
<script>
    /* CLICK VÀO THÀNH VIÊN*/
    $(document).on('click', '.choose', function() {
        let _this = $(this);
        $('.choose').removeClass('bg-choose'); //remove all trong các thẻ có class = choose
        _this.toggleClass('bg-choose');
        let data = _this.attr('data-info');
        data = window.atob(data); //decode base64
        let json = JSON.parse(data);
        setTimeout(function() {
            $('.fullname').html('').html(json.name);
            $('#image').attr('src', json.image);
            $('.phone').html('').html(json.phone);
            $('.email').html('').html(json.email);
            $('.address').html('').html(json.address);
            $('.updated').html('').html(json.created_at);
        }, 100); //sau 100ms thì mới thực hiện
    });
</script>
@endpush
