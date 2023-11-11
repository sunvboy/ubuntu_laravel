<!-- BEGIN: Data List -->
<div class="table-responsive">
    <table class="table table-nowrap">
        <thead>
            <tr>
                @can('products_destroy')
                <th>
                    <input type="checkbox" id="checkbox-all" class="form-check-input">
                </th>
                @endcan
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Giá</th>
                <th>Vị trí</th>
                <th>Ngày tạo</th>
                <th>Người tạo</th>
                <th>Hiển thị</th>
                @include('components.table.is_thead')
                <th class="text-end">#</th>
            </tr>
        </thead>
        <tbody id="table_data" role="alert" aria-live="polite" aria-relevant="all">
            @foreach($data as $v)
            <?php $getPrice = getPrice(array('price' => $v->price, 'price_sale' => $v->price_sale, 'price_contact' => $v->price_contact)); ?>
            <tr class="odd " id="post-<?php echo $v->id; ?>">
                @can('products_destroy')
                <td>
                    <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                </td>
                @endcan

                <td>
                    {{$data->firstItem()+$loop->index}}
                </td>
                <td>
                    <div class="d-flex">
                        <div style="width: 50px;">
                            <img style="width: 50px;height: 50px;border-radius: 100%;" src="{{File::exists(base_path($v->image)) ? getImageUrl($module,$v->image,'small') : asset('images/404.png')}}">
                        </div>
                        <div class="flex-1 ms-2">
                            <a href="{{route('routerURL',['slug' => $v->slug])}}" target="_blank" class=" text-primary font-medium"><?php echo $v->title; ?></a>
                            <div class="list-catalogue">
                                @foreach($v->relationships as $kc=>$c)
                                <a class="text-danger" href="{{route('products.index',['catalogue_id' => $c->id])}}"><?php echo !empty($kc == 0) ? '' : ',' ?>{{$c->title}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </td>
                <td class="">
                    <?php if ($getPrice['price_old']) { ?>
                        <old style="text-decoration: line-through;"><?php echo $getPrice['price_old'] ?><br></old>
                    <?php } ?>
                    <?php echo $getPrice['price_final'] ?>
                </td>
                @include('components.order',['module' => 'products'])
                <td>
                    @if($v->created_at)
                    {{Carbon\Carbon::parse($v->created_at)->diffForHumans()}}
                    @endif
                </td>
                <td>
                    {{$v->user->name}}
                </td>
                <td class="w-40">
                    @include('components.publishTable',['module' => 'products','title' => 'publish','id' =>
                    $v->id])
                </td>
                @include('components.table.is_tbody')
                <td class="text-end">
                    <div class="flex justify-center items-center">
                        @can('products_create')
                        <a href="{{ route('products.edit',['id'=>$v->id]) }}" class="btn btn-success btn-label waves-effect waves-light">
                            <i class="ri-file-copy-line label-icon align-middle fs-16 me-2"></i> Copy
                        </a>
                        @endcan
                        @can('products_edit')
                        <a href="{{ route('products.edit',['id'=>$v->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                        </a>
                        @endcan
                        @can('products_destroy')
                        <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete-product" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa sản phẩm, sản phẩm sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
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
<!-- END: Data List -->
<!-- BEGIN: Pagination -->
<div class="d-flex justify-content-end px-2">
    {{$data->links()}}
</div>
<!-- END: Pagination -->