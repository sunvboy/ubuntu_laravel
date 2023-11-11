@extends('dashboard.layout.dashboard')

@section('title')

<title>Danh sách đơn đặt hộ</title>

@endsection

@section('breadcrumb')

<?php

$array = array(

    [

        "title" => "Danh sách đơn đặt hộ",

        "src" => 'javascript:void(0)',

    ]

);

echo breadcrumb_backend($array, "Danh sách đơn đặt hộ");

?>

@endsection

@section('content')

<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="d-flex justify-content-between p-2">

                <button id="ajax-delete-all" disabled="true" type="button" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-all fs-sm-14" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="{{$module}}">

                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> <span class="">Xóa tất cả</span>

                </button>

                @can('carts_create')

                <!-- Buttons with Label -->

                <a href="{{route('carts.create')}}" class="btn btn-primary btn-label waves-effect waves-light">

                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới

                </a>

                @endcan

            </div>

            <div class="px-2 mb-3">

                <form action="" class="row gy-2" id="search">



                    <div class="col-md-3">

                        <?php echo Form::select('customer_id', $customers, request()->get('customer_id'), ['class' => 'tom-select tom-select-field', 'data-placeholder' => "Select your favorite actors"]); ?>

                    </div>

                    <div class="col-md-2">

                        <?php echo Form::text('date_end', request()->get('date_end'), ['class' => 'form-control h-10',  'autocomplete' => 'off', 'placeholder' => 'Ngày đặt hàng']); ?>

                    </div>

                    <div class="col-md-2 d-none">

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

                            @can('carts_destroy')

                            <th>

                                <input type="checkbox" id="checkbox-all" class="form-check-input">

                            </th>

                            @endcan

                            <th>STT</th>

                            <th>Tên khách hàng</th>

                            <th>Ngày đặt</th>

                            <th>Ngày tạo</th>

                            <th>Người tạo</th>

                            <th class="text-end">#</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($data as $v)

                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">

                            <td>

                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">

                            </td>

                            <td>{{$data->firstItem()+$loop->index}}</td>

                            <td>

                                {{!empty($v->customer)?$v->customer->code .' - '.$v->customer->name:''}}

                            </td>

                            <td class="@if($v->date_end == $dateEnd) fw-bold text-danger @endif">

                                {{$v->date_end}}

                            </td>

                            <td>

                                {{$v->created_at}}

                            </td>

                            <td>

                                {{!empty($v->user)?$v->user->name:''}}

                            </td>

                            <td class="text-end">

                                <!-- <a href="{{ route('carts.show',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">

                                    <i class="ri-eye-2-line label-icon align-middle fs-16 me-2"></i> Xem

                                </a> -->

                                @can('carts_create')

                                @if($v->date_end != $dateEnd)

                                <a href="{{ route('carts.duplicate',['id'=>$v->id]) }}" class="btn btn-success btn-label waves-effect waves-light d-none">

                                    <i class=" ri-file-copy-fill label-icon align-middle fs-16 me-2"></i> Đặt lại

                                </a>

                                @endif

                                @endcan

                                @can('carts_edit')


                                <a href="{{ route('carts.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">

                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit

                                </a>


                                @endcan

                                @can('carts_destroy')

                                <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa bài viết, bài viết sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js" integrity="sha512-+UiyfI4KyV1uypmEqz9cOIJNwye+u+S58/hSwKEAeUMViTTqM9/L4lqu8UxJzhmzGpms8PzFJDzEqXL9niHyjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script type="text/javascript">
    $(function() {

        $('input[name="date_end"]').datetimepicker({

            format: 'd-m-Y',

        });

    });
</script>

@endsection

@include('article.backend.script')