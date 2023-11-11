<?php $__env->startSection('title'); ?>
<title>Nhóm thuộc tính</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Nhóm thuộc tính",
        "src" => route('category_attributes.index'),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Nhóm thuộc tính");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-3">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_attributes_create')): ?>
                <!-- Buttons with Label -->
                <a href="<?php echo e(route('category_attributes.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
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
                            <th nhà cung cấp>STT</th>
                            <th nhà cung cấp>TIÊU ĐỀ</th>
                            <th nhà cung cấp>VỊ TRÍ</th>
                            <th nhà cung cấp>NGƯỜI TẠO</th>
                            <th nhà cung cấp>NGÀY TẠO</th>
                            <th nhà cung cấp>HIỂN THỊ</th>
                            <?php echo $__env->make('components.table.is_thead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <th nhà cung cấp>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td>
                                <?php echo e($data->firstItem()+$loop->index); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('attributes.index',['catalogueid'=>$v->id])); ?>"><?php echo str_repeat('|----', (($v->level > 0) ? ($v->level - 1) : 0)) . $v->title; ?></a>
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
                                <div class="flex justify-center items-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_attributes_edit')): ?>
                                    <a href="<?php echo e(route('category_attributes.edit',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                                        <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_attributes_destroy')): ?>
                                    <a class="btn btn-danger btn-label waves-effect waves-light <?php echo !empty($v->listAttr->count() == 0) ? 'ajax-delete' : '' ?> <?php echo ($v->rgt - $v->lft > 1) ? 'disabled' : ''; ?>
                                    <?php echo !empty($v->listAttr->count() == 0) ? '' : 'disabled' ?>" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa danh mục, danh mục sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
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
            <div class="d-flex justify-content-end mt-3 px-3">
                <?php echo e($data->links()); ?>

            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/attribute/backend/category/index.blade.php ENDPATH**/ ?>