<?php $__env->startSection('title'); ?>
<title>Danh sách menu</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách menu",
        "src" => route('menus.index'),
    ]
);
echo breadcrumb_backend($array, "Danh sách menu");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <?php if( env('APP_ENV') == "local"): ?>
            <div class="d-flex justify-content-end p-2">
                <div class="d-flex">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menus_create')): ?>
                    <!-- Buttons with Label -->
                    <a href="<?php echo e(route('menus.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <th>ID</th>
                        <th>TIÊU ĐỀ</th>
                        <th>NGƯỜI TẠO</th>
                        <th>NGÀY TẠO</th>
                        <th>HIỂN THỊ</th>
                        <th class="text-end">#</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td>
                                <?php echo e($v->id); ?>

                            </td>
                            <td>
                                <?php echo $v->title; ?>
                            </td>
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
                            <td class="text-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menus_edit')): ?>
                                <a class="btn btn-primary btn-label waves-effect waves-light" href="<?php echo e(route('menus.edit',['id'=>$v->id])); ?>">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                <?php endif; ?>
                                <?php if( env('APP_ENV') == "local"): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menus_destroy')): ?>
                                <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa thương hiệu, thương hiệu sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> Delete
                                </a>
                                <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/menu/backend/index.blade.php ENDPATH**/ ?>