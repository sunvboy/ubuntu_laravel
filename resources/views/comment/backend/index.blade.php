@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách comment</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách comment",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách comment");
?>
@endsection
@section('content')
<?php $array_star = ['' => 'Đánh giá', '1' => '1 sao', '2' => '2 sao', '3' => '3 sao', '4' => '4 sao', '5' => '5 sao',]; ?>
<?php $array_module = ['' => 'Chọn module', 'articles' => 'Bài viết', 'products' => 'Sản phẩm']; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between p-2">
                <button id="ajax-delete-all" disabled="true" type="button" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-all fs-sm-14" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="{{$module}}">
                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> <span class="">Xóa tất cả</span>
                </button>
            </div>
            <div class="px-2 mb-3">
                <form action="" class="row gy-2" id="search">
                    <div class="col-md-2">
                        <?php echo Form::select('rating', $array_star, request()->get('rating'), ['class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-2 hidden">
                        <?php echo Form::select('module', $array_module, request()->get('module'), ['class' => 'form-control']); ?>
                    </div>
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
                            @can('brands_destroy')
                            <th>
                                <input type="checkbox" id="checkbox-all" class="form-check-input">
                            </th>
                            @endcan
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Module</th>
                            <th>Chủ đề</th>
                            <th>Đánh giá</th>
                            <th>Hiển thị</th>
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
                                <?php echo  $v->fullname; ?>
                                <br> {{$v->phone}}
                                <br> {{$v->created_at}}
                            </td>

                            <td>
                                {{$v->module}}
                            </td>
                            <td>
                                @if($v->module == 'tours')
                                @if(!empty($v->tour))
                                <a href="{{route('routerURL',['slug' => $v->tour->slug])}}" class="text-primary" target="_blank">{{$v->tour->title}}</a>
                                @endif
                                @elseif($v->module == 'products')
                                @if(!empty($v->product))
                                <a href="{{route('routerURL',['slug' => $v->product->slug])}}" class="text-primary" target="_blank">{{$v->product->title}}</a>
                                @endif
                                @elseif($v->module == 'articles')
                                @if(!empty($v->article))
                                <a href="{{route('routerURL',['slug' => $v->article->slug])}}" class="text-primary" target="_blank">{{$v->article->title}}</a>
                                @endif
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <?php for ($i = 1; $i <= $v->rating; $i++) { ?>
                                        <i data-lucide="star" class="ri-star-s-fill fs-16" style="color:#ea9d02;fill:#ea9d02;"></i>
                                    <?php } ?>
                                    <?php for ($i = 1; $i <= 5 - $v->rating; $i++) { ?>
                                        <i data-lucide="star" class="ri-star-line fs-16" style="color:#ea9d02"></i>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                                @include('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                                $v->id])
                            </td>
                            <td class="text-end">
                                @can('comments_edit')
                                <a href="{{ route('comments.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                @endcan
                                @can('comments_destroy')
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
@endsection
@push('javascript')
<script>
    document.querySelector("button").addEventListener("click", function() {
        name.style.color = "blue";
    });
</script>
@endpush