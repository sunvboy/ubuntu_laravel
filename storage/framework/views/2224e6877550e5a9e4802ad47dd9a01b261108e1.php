<?php $__env->startSection('title'); ?>
<title>Danh sách mã giảm giá</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách counpon",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách mã giảm giá");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between p-2">
                <div class="col-md-2 ">
                    <button id="ajax-delete-all" disabled="true" type="button" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-all fs-sm-14" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="<?php echo e($module); ?>">
                        <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> <span class="">Xóa tất cả</span>
                    </button>
                </div>
                <div class="d-flex">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupons_create')): ?>
                    <!-- Buttons with Label -->
                    <a href="<?php echo e(route('coupons.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                    </a>
                    <?php endif; ?>
                </div>
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
                        <th>
                            <input type="checkbox" id="checkbox-all" class="form-check-input">
                        </th>
                        <th>STT</th>
                        <th>Mã giảm giá</th>
                        <th>Tiêu đề</th>
                        <th>Vị trí</th>
                        <th>Ngày tạo</th>
                        <th>Người tạo</th>
                        <th>Sử dụng / Giới hạn</th>
                        <th>Hiển thị</th>
                        <th>Sử dụng kết hợp<br> cùng các mã ưu đãi khác</th>
                        <th class="text-end">#</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                            </td>
                            <td>
                                <?php echo e($data->firstItem()+$loop->index); ?>

                            </td>
                            <td class="text-danger">
                                <?php echo $v->name; ?>
                            </td>
                            <td>
                                <?php echo $v->title; ?>
                            </td>
                            <?php echo $__env->make('components.order',['module' => $module], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <td>
                                <?php if($v->created_at): ?>
                                <?php echo e(Carbon\Carbon::parse($v->created_at)->diffForHumans()); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e($v->user->name); ?>

                            </td>
                            <td>
                                <?php echo e($v->coupon_relationship()->count()); ?> /
                                <?php if(!empty($v->limit)): ?>

                                <?php echo e($v->limit); ?>

                                <?php else: ?>
                                ∞
                                <?php endif; ?>
                            </td>

                            <td class="w-40">
                                <?php echo $__env->make('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                                $v->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <td class="w-40">
                                <?php echo $__env->make('components.publishTable',['module' => $module,'title' => 'individual_use','id' =>
                                $v->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <td class="text-end">
                                <div class="flex justify-center items-center">

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupons_edit')): ?>
                                    <a class="btn btn-primary btn-label waves-effect waves-light" href="<?php echo e(route('coupons.edit',['id'=>$v->id])); ?>">
                                        <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupons_destroy')): ?>
                                    <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa thương hiệu, thương hiệu sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
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
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/coupon/index.blade.php ENDPATH**/ ?>