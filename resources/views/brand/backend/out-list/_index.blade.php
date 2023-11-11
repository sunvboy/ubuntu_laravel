@extends('dashboard.layout.dashboard')

@section('title')

<title>Danh sách đặt hàng cung cấp</title>

@endsection

@section('breadcrumb')

<?php

$array = array(

    [

        "title" => "Danh sách đặt hàng cung cấp",

        "src" => route("brand_orders.outListIndex"),

    ]

);

echo breadcrumb_backend($array, "Danh sách đặt hàng cung cấp");

?>

@endsection

@section('content')



<div class="row">

    <div class="col-lg-12">

        <div class="card p-2">

            <div class="px-2 mb-3">

                <form action="" class="row gy-2" id="search">

                    <div class="col-md-3">

                        <?php echo Form::select('date_end', $htmlOption, request()->get('date_end'), ['id' => 'select-beast', 'class' => 'tom-select tom-select-field', 'data-placeholder' => "Select your favorite actors"]); ?>

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

                            <th>STT</th>

                            <th>Ngày đặt hàng</th>

                            <th class="text-end">#</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($data as $v)

                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">

                            <td>

                                {{$data->firstItem()+$loop->index}}

                            </td>

                            <td>

                                {{$v->date_end}}

                            </td>

                            <td class="text-end">

                                <a href="{{ route('brand_orders.listOrderEdit',['dateEnd'=>$v->date_end]) }}" class="btn btn-success btn-label waves-effect waves-light">

                                    <i class="ri-eye-fill label-icon align-middle fs-16 me-2"></i> List hàng

                                </a>

                                <a href=" {{ route('brand_orders.outListEdit',['dateEnd'=>$v->date_end]) }}" class="btn btn-primary btn-label waves-effect waves-light">

                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit

                                </a>

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

@include('article.backend.script')