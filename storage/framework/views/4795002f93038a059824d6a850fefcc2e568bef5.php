<li class="dd-item dd3-item" data-id="<?php echo e($item['id']); ?>" data-label="<?php echo e($item['title']); ?>" data-url="<?php echo e($item['slug']); ?>">
    <div class="dd-handle dd3-handle"> Drag</div>
    <div class="dd3-content flex justify-between">
        <div class="d-flex align-items-center">
            <input type="checkbox" name="checkbox[]" value="<?php echo e($item['id']); ?>" class="checkbox-item form-check-input mt-0 me-1">
            <span><?php echo e($item['title']); ?></span>
        </div>
        <div class="item-edit cursor-pointer accordionQ" data-id="<?php echo e($item['id']); ?>">Sửa</div>
    </div>
    <div class="item-settings d-none collapseQ-<?php echo e($item['id']); ?>">
        <div class="input-box">
            <form method="post" action="<?php echo e(route('update-menu-item',$item['id'])); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="input-group">
                    <div class="input-group-text" style="width:200px">Tên đường dẫn</div>
                    <input type="text" name="title" class="form-control" placeholder="" value="<?php echo e($item['title']); ?>" required>
                </div>
                <div class="input-group mt-3">
                    <div class="input-group-text" style="width:200px">URL</div>
                    <input type="text" name="slug" class="form-control" placeholder="" value="<?php echo e($item['slug']); ?>" required>
                </div>
                <!-- START: upload hình ảnh -->
                <div class="mt-3">
                    <label class="form-label text-base font-semibold w-full">Ảnh đại diện</label>
                    <div class="d-flex align-items-center space-x-3">
                        <div class="avatar me-3" style="cursor: pointer;flex:none">
                            <img src="<?php if (!empty($item['image'])) { ?><?php echo e($item['image']); ?><?php } else { ?><?php echo e(asset('images/404.png')); ?><?php } ?>" class="img-thumbnail object-fit-cover" style="width: 100px;height: 100px;">
                        </div>
                        <input type="text" name="image" value="<?php echo e($item['image']); ?>" class="form-control " placeholder="Đường dẫn của ảnh" onclick="openKCFinder($(this), 'addItem')" autocomplete="off">
                    </div>
                </div>
                <!-- END -->
                <div class="mt-3 d-flex align-items-center">
                    <input type="checkbox" name="target" value="_blank" class="form-check-input mt-0 me-1" <?php if($item['target']=="_blank" ): ?> checked <?php endif; ?>>
                    <span>Mở sang tab mới</span>
                </div>
                <div class="mt-3 d-flex align-items-center">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menus_edit')): ?>
                    <button class="btn btn-sm btn-primary mr-2" type="submit">Cập nhập</button>
                    <?php endif; ?>
                    <div class="ms-3">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menus_destroy')): ?>
                        <a class="item-delete <?php if ($item['children']->count() > 0) { ?>disabled<?php } ?>" <?php if ($item['children']->count() > 0) { ?>href="javascript:;" <?php } else { ?>href="<?php echo e(route('delete-menu-item',['id'=> $item['id'] ,'menus_id'=>$detail->id])); ?>" <?php } ?>>Remove </a> |
                        <?php endif; ?>
                        <a class="item-close accordionQ" href="javascript:;" data-id="<?php echo e($item['id']); ?>">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php if(!empty($item['children'])): ?>
    <ol class="dd-list">
        <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('menu.backend.renderMenuItem', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
    <?php endif; ?>
</li><?php /**PATH D:\xampp\htdocs\order.local\resources\views/menu/backend/renderMenuItem.blade.php ENDPATH**/ ?>