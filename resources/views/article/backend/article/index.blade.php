@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách bài viết</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách bài viết",
        "src" => route('articles.index'),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách bài viết");

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

                @can('articles_create')
                <!-- Buttons with Label -->
                <a href="{{route('articles.create')}}" class="btn btn-primary btn-label waves-effect waves-light">
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
                            @can('articles_destroy')
                            <th>
                                <input type="checkbox" id="checkbox-all" class="form-check-input">
                            </th>
                            @endcan
                            <th>STT</th>
                            <th>TIÊU ĐỀ</th>
                            <th>VỊ TRÍ</th>
                            <th>NGƯỜI TẠO</th>
                            <th>HIỂN THỊ</th>
                            @include('components.table.is_thead')
                            <th class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $v)
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            @can('articles_destroy')
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                            </td>
                            @endcan
                            <td>
                                {{$data->firstItem()+$loop->index}}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="image-fit zoom-in me-2" style="width: 40px;height: 40px;">
                                        <img class="rounded-circle" style="width: 40px;height: 40px;" src="{{File::exists(base_path($v->image)) ? getImageUrl($module,$v->image,'small') : asset('images/404.png')}}">
                                    </div>
                                    <div class="flex-1">
                                        <a href="{{route('routerURL',['slug' => $v->slug])}}" target="_blank" class=" text-primary font-medium"><?php echo $v->title; ?></a>
                                        <div>
                                            @foreach($v->relationships as $kc=>$c)
                                            <a class="text-danger" href="{{route('articles.index',['catalogueid' => $c->id])}}"><?php echo !empty($kc == 0) ? '' : ',' ?>{{$c->title}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </td>
                            @include('components.order',['module' => $module])
                            <td>
                                {{$v->user->name}}<br>
                                @if($v->created_at)
                                <i>{{Carbon\Carbon::parse($v->created_at)->diffForHumans()}}</i>
                                @endif
                            </td>
                            <td class="w-40">
                                @include('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                                $v->id])
                            </td>
                            @include('components.table.is_tbody')
                            <td class="text-end">
                                <a href="{{route('routerURL',['slug' => $v->slug])}}" class="btn btn-primary btn-label waves-effect waves-light" target="_blank">
                                    <i class="ri-eye-fill label-icon align-middle fs-16 me-2"></i> Xem trước
                                </a>
                                <div class="mt-1">
                                    @can('articles_edit')
                                    <a href="{{ route('articles.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                                        <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                    </a>
                                    @endcan
                                    @can('articles_destroy')
                                    <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa bài viết, bài viết sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
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