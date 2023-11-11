<li class="dd-item dd3-item" data-id="{{$item['id']}}" data-label="{{$item['title']}}" data-url="{{$item['slug']}}">
    <div class="dd-handle dd3-handle"> Drag</div>
    <div class="dd3-content flex justify-between">
        <div class="d-flex align-items-center">
            <input type="checkbox" name="checkbox[]" value="{{$item['id']}}" class="checkbox-item form-check-input mt-0 me-1">
            <span>{{$item['title']}}</span>
        </div>
        <div class="item-edit cursor-pointer accordionQ" data-id="{{$item['id']}}">Sửa</div>
    </div>
    <div class="item-settings d-none collapseQ-{{$item['id']}}">
        <div class="input-box">
            <form method="post" action="{{route('update-menu-item',$item['id'])}}" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <div class="input-group-text" style="width:200px">Tên đường dẫn</div>
                    <input type="text" name="title" class="form-control" placeholder="" value="{{$item['title']}}" required>
                </div>
                <div class="input-group mt-3">
                    <div class="input-group-text" style="width:200px">URL</div>
                    <input type="text" name="slug" class="form-control" placeholder="" value="{{$item['slug']}}" required>
                </div>
                <!-- START: upload hình ảnh -->
                <div class="mt-3">
                    <label class="form-label text-base font-semibold w-full">Ảnh đại diện</label>
                    <div class="d-flex align-items-center space-x-3">
                        <div class="avatar me-3" style="cursor: pointer;flex:none">
                            <img src="<?php if (!empty($item['image'])) { ?>{{$item['image']}}<?php } else { ?>{{asset('images/404.png')}}<?php } ?>" class="img-thumbnail object-fit-cover" style="width: 100px;height: 100px;">
                        </div>
                        <input type="text" name="image" value="{{$item['image']}}" class="form-control " placeholder="Đường dẫn của ảnh" onclick="openKCFinder($(this), 'addItem')" autocomplete="off">
                    </div>
                </div>
                <!-- END -->
                <div class="mt-3 d-flex align-items-center">
                    <input type="checkbox" name="target" value="_blank" class="form-check-input mt-0 me-1" @if($item['target']=="_blank" ) checked @endif>
                    <span>Mở sang tab mới</span>
                </div>
                <div class="mt-3 d-flex align-items-center">
                    @can('menus_edit')
                    <button class="btn btn-sm btn-primary mr-2" type="submit">Cập nhập</button>
                    @endcan
                    <div class="ms-3">
                        @can('menus_destroy')
                        <a class="item-delete <?php if ($item['children']->count() > 0) { ?>disabled<?php } ?>" <?php if ($item['children']->count() > 0) { ?>href="javascript:;" <?php } else { ?>href="{{route('delete-menu-item',['id'=> $item['id'] ,'menus_id'=>$detail->id])}}" <?php } ?>>Remove </a> |
                        @endcan
                        <a class="item-close accordionQ" href="javascript:;" data-id="{{$item['id']}}">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if (!empty($item['children']))
    <ol class="dd-list">
        @foreach ($item['children'] as $item)
        @include('menu.backend.renderMenuItem', $item)
        @endforeach
    </ol>
    @endif
</li>