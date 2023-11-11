@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách thuộc tính</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách thuộc tính",
        "src" => route('attributes.index'),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách thuộc tính");
?>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-3">
                @can('attributes_create')
                <!-- Buttons with Label -->
                <a href="{{route('attributes.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                @endcan
            </div>
            <div class="px-2 mb-3">
                <form action="" class="row gy-2" id="search">
                    @if(isset($htmlOption))
                    <div class="col-md-3">
                        <?php echo Form::select('catalogueid', $htmlOption, request()->get('catalogueid'), ['id' => 'select-beast', 'class' => 'tom-select tom-select-field', 'data-placeholder' => "Select your favorite actors"]); ?>
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
                        <tr>
                            <th>
                                <input type="checkbox" id="checkbox-all" class="form-check-input">
                            </th>
                            <th>STT</th>
                            <th>TIÊU ĐỀ</th>
                            <th>Danh mục</th>
                            <th>VỊ TRÍ</th>
                            <th>NGƯỜI TẠO</th>
                            <th>NGÀY TẠO</th>
                            <th>HIỂN THỊ</th>
                            @include('components.table.is_thead')
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
                                {{$v->title}}
                            </td>
                            <td>
                                <a href="{{route('attributes.index',['catalogueid'=>$v->catalogue->id])}}">{{$v->catalogue->title}}</a>

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
                                    @can('attributes_edit')
                                    <a href="{{ route('attributes.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                                        <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                    </a>
                                    @endcan
                                    @can('attributes_destroy')
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
@include('article.backend.script')