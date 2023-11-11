
<?php $__env->startSection('title'); ?>
<title>Danh sách nhóm thành viên</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách nhóm thành viên",
        "src" => route('roles.index'),
    ]
);
echo breadcrumb_backend($array, 'Danh sách nhóm thành viên');
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-3">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles_create')): ?>
                <!-- Buttons with Label -->
                <a href="<?php echo e(route('roles.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên nhóm thành viên </th>
                            <th scope="col" class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="align-middle odd " id="post-<?php echo $v->id; ?>">
                            <td><span><span class="fw-semibold"><?php echo e($data->firstItem()+$loop->index); ?></span></span></td>
                            <td><?php echo e($v->title); ?></td>
                            <td class="text-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles_edit')): ?>
                                <a href="<?php echo e(route('roles.edit',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles_destroy')): ?>
                                <a href="javascript:;" class="btn btn-danger btn-label waves-effect waves-light p-destroy" data-url="<?php echo e(route('roles.destroy',['id'=>$v->id])); ?>" data-id="<?php echo e($v->id); ?>">
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
<?php $__env->startPush('javascript'); ?>
<script src="<?php echo e(asset('backend/library/role.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/user/backend/role/index.blade.php ENDPATH**/ ?>