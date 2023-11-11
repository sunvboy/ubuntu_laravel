@extends('dashboard.layout.dashboard')

@section('title')
<title>Thêm mới phân quyền</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách nhóm phân quyền",
        "src" => route('permissions.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Thêm mới");
?>
@endsection
@section('content')
<form role="form" action="{{route('permissions.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-3">
                            <div>
                                <label for="basiInput" class="form-label fw-bold">Tên module</label>
                                <select class="tom-select tom-select-field" data-placeholder="Search..." name="title" tabindex="-1">
                                    <option value=""></option>
                                    @foreach(config('permissions.modules') as $k=>$v)
                                    <option value="{{$k}}" {{ (collect(old('title'))->contains($k)) ? 'selected':'' }}> {{$v}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="basiInput" class="form-label fw-bold">Mô tả</label>
                                <?php echo Form::textarea('description', '', ['class' => 'form-control w-full ']); ?>
                            </div>
                            <div class="mt-3">
                                <label for="basiInput" class="form-label fw-bold">Quyền module</label>
                                <div class="row">
                                    @foreach(config('permissions.actions') as $k=>$v)
                                    <div class="col-md-3 col-lg-3">
                                        <label for="check{{$k}}">
                                            <input name="permission_id[]" type="checkbox" class="form-check-input" value="{{$k}}" id="check{{$k}}" />
                                            {{$v}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary w-24">Thêm mới</button>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
@endsection
@include('article.backend.script')