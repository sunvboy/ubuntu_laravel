<?php $__env->startSection('title'); ?>
<title>Danh sách nhóm thành viên</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách nhóm thành viên",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách nhóm thành viên");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-3">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customers_create')): ?>
                <!-- Buttons with Label -->
                <a href="<?php echo e(route('customer_categories.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Ngày đăng</th>
                            <th scope="col" class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="align-middle odd " id="post-<?php echo $v->id; ?>">
                            <td><span><span class="fw-semibold"><?php echo e($data->firstItem()+$loop->index); ?></span></span></td>
                            <td><?php echo e($v->title); ?>(<?php echo e($v->customers->count()); ?>)</td>
                            <td><?php echo e($v->created_at); ?></td>
                            <td class="text-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customers_edit')): ?>
                                <a href="<?php echo e(route('customer_categories.edit',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customers_destroy')): ?>
                                <a href="javascript:;" class="btn btn-danger btn-label waves-effect waves-light <?php echo !empty($v->customers->count() == 0) ? 'ajax-delete' : '' ?> <?php echo !empty($v->customers->count() == 0) ? '' : 'disabled' ?>" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa thương hiệu, thương hiệu sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
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
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/customer/backend/category/index.blade.php ENDPATH**/ ?>