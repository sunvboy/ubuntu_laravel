
<?php $__env->startSection('title'); ?>
<title>Danh sách nhà cung cấp</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách nhà cung cấp",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Nhà cung cấp");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between p-2">
                <button id="ajax-delete-all" disabled="true" type="button" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-all fs-sm-14" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="<?php echo e($module); ?>">
                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> <span class="">Xóa tất cả</span>
                </button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands_create')): ?>
                <!-- Buttons with Label -->
                <a href="<?php echo e(route('brands.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                <?php endif; ?>
            </div>
            <div class="px-2 mb-3">
                <form action="" class="row gy-2" id="search">
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands_destroy')): ?>
                            <th>
                                <input type="checkbox" id="checkbox-all" class="form-check-input">
                            </th>
                            <?php endif; ?>
                            <th>STT</th>
                            <th>TIÊU ĐỀ</th>
                            <th>VỊ TRÍ</th>
                            <th>NGƯỜI TẠO</th>
                            <th>NGÀY TẠO</th>
                            <th>HIỂN THỊ</th>
                            <?php echo $__env->make('components.table.is_thead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <th class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands_destroy')): ?>
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                            </td>
                            <?php endif; ?>
                            <td>
                                <?php echo e($data->firstItem()+$loop->index); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('brandURL', ['slug' => $v->slug])); ?>" target="_blank">
                                    <?php echo str_repeat('|----', (($v->level > 0) ? ($v->level - 1) : 0)) . $v->title; ?>
                                </a>
                            </td>
                            <?php echo $__env->make('components.order',['module' => $module], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <td>
                                <?php echo e($v->user->name); ?>

                            </td>
                            <td>
                                <?php if($v->created_at): ?>
                                <?php echo e(Carbon\Carbon::parse($v->created_at)->diffForHumans()); ?>

                                <?php endif; ?>
                            </td>
                            <td class="w-40">
                                <?php echo $__env->make('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                                $v->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <?php echo $__env->make('components.table.is_tbody', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <td class="text-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands_edit')): ?>
                                <a href="<?php echo e(route('brand_orders.index',['id'=>$v->id])); ?>" class="btn btn-success btn-label waves-effect waves-light">
                                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Xem đơn cần nhập
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands_edit')): ?>
                                <a href="<?php echo e(route('brands.edit',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands_destroy')): ?>
                                <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa bài viết, bài viết sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> Delete
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3 px-3">
                <?php echo e($data->links()); ?>

            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/brand/backend/brand/index.blade.php ENDPATH**/ ?>