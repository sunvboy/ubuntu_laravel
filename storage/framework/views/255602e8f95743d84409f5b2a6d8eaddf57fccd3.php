<!-- BEGIN: Data List -->
<div class="table-responsive">
    <table class="table table-nowrap">
        <thead>
            <tr>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products_destroy')): ?>
                <th>
                    <input type="checkbox" id="checkbox-all" class="form-check-input">
                </th>
                <?php endif; ?>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Giá</th>
                <th>Vị trí</th>
                <th>Ngày tạo</th>
                <th>Người tạo</th>
                <th>Hiển thị</th>
                <?php echo $__env->make('components.table.is_thead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <th class="text-end">#</th>
            </tr>
        </thead>
        <tbody id="table_data" role="alert" aria-live="polite" aria-relevant="all">
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $getPrice = getPrice(array('price' => $v->price, 'price_sale' => $v->price_sale, 'price_contact' => $v->price_contact)); ?>
            <tr class="odd " id="post-<?php echo $v->id; ?>">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products_destroy')): ?>
                <td>
                    <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                </td>
                <?php endif; ?>

                <td>
                    <?php echo e($data->firstItem()+$loop->index); ?>

                </td>
                <td>
                    <div class="d-flex">
                        <div style="width: 50px;">
                            <img style="width: 50px;height: 50px;border-radius: 100%;" src="<?php echo e(File::exists(base_path($v->image)) ? getImageUrl($module,$v->image,'small') : asset('images/404.png')); ?>">
                        </div>
                        <div class="flex-1 ms-2">
                            <a href="<?php echo e(route('routerURL',['slug' => $v->slug])); ?>" target="_blank" class=" text-primary font-medium"><?php echo $v->title; ?></a>
                            <div class="list-catalogue">
                                <?php $__currentLoopData = $v->relationships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kc=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="text-danger" href="<?php echo e(route('products.index',['catalogue_id' => $c->id])); ?>"><?php echo !empty($kc == 0) ? '' : ',' ?><?php echo e($c->title); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php echo $__env->make('components.order',['module' => 'products'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <td>
                    <?php if($v->created_at): ?>
                    <?php echo e(Carbon\Carbon::parse($v->created_at)->diffForHumans()); ?>

                    <?php endif; ?>
                </td>
                <td>
                    <?php echo e($v->user->name); ?>

                </td>
                <td class="w-40">
                    <?php echo $__env->make('components.publishTable',['module' => 'products','title' => 'publish','id' =>
                    $v->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </td>
                <?php echo $__env->make('components.table.is_tbody', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <td class="text-end">
                    <div class="flex justify-center items-center">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products_create')): ?>
                        <a href="<?php echo e(route('products.edit',['id'=>$v->id])); ?>" class="btn btn-success btn-label waves-effect waves-light">
                            <i class="ri-file-copy-line label-icon align-middle fs-16 me-2"></i> Copy
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products_edit')): ?>
                        <a href="<?php echo e(route('products.edit',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products_destroy')): ?>
                        <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete-product" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa sản phẩm, sản phẩm sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                            <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> Delete
                        </a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<!-- END: Data List -->
<!-- BEGIN: Pagination -->
<div class="d-flex justify-content-end px-2">
    <?php echo e($data->links()); ?>

</div>
<!-- END: Pagination --><?php /**PATH D:\xampp\htdocs\order.local\resources\views/product/backend/product/index/data.blade.php ENDPATH**/ ?>