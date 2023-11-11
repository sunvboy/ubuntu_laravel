<?php $__env->startSection('title'); ?>
<title>Danh sách thành viên</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách thành viên",
        "src" => route('users.index'),
    ]
);
echo breadcrumb_backend($array, 'Danh sách thành viên');
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-3">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_create')): ?>
                <!-- Buttons with Label -->
                <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên thành viên </th>
                            <th scope="col">Email </th>
                            <th scope="col">Nhóm thành viên </th>
                            <th scope="col" class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td><span><span class="fw-semibold"><?php echo e($data->firstItem()+$loop->index); ?></span></span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img alt="<?php echo e($v->name); ?>" class="rounded-circle" style="width: 75px;height: 75px;" src="<?php echo File::exists(base_path($v->image)) ? asset($v->image) : 'https://ui-avatars.com/api/?name=' . $detail->name ?>">
                                    <div class="ms-2">
                                        <?php echo e($v->name); ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_edit')): ?>
                                        <div>
                                            <a data-url="<?php echo e(route('users.reset-password',['id'=>$v->id])); ?>" href="javascript:void(0)" class="p-reset text-warning" data-userid="<?php echo e($v->id); ?>">RESET mật khẩu</a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td> <?php echo e($v->email); ?></td>
                            <td>
                                <?php $__currentLoopData = $v->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('roles.edit',['id'=>$v1->id])); ?>" class="btn btn-warning btn-sm"><?php echo e($v1->title); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td class="text-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_edit')): ?>
                                <a href="<?php echo e(route('users.edit',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_destroy')): ?>
                                <a href="javascript:;" class="btn btn-danger btn-label waves-effect waves-light p-destroy" data-url="<?php echo e(route('users.destroy',['id'=>$v->id])); ?>" data-id="<?php echo e($v->id); ?>">
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
<script src="<?php echo e(asset('backend/library/users.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/user/backend/user/index.blade.php ENDPATH**/ ?>