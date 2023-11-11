
<?php $__env->startSection('title'); ?>
<title>Danh sách khách hàng</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách khách hàng",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách khách hàng");
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
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customers_create')): ?>
                    <!-- Buttons with Label -->
                    <a href="<?php echo e(route('customers.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                    </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('customers.export')); ?>" class="btn btn-success btn-label waves-effect waves-light ms-1">
                        <i class="ri-file-excel-fill label-icon align-middle fs-16 me-2"></i> Xuất excel
                    </a>
                </div>
            </div>
            <div class="px-2 mb-3">
                <form action="" class="row gy-2" id="search">

                    <div class="col-md-2">
                        <?php echo Form::select('order', array('0' => 'Mua hàng', '1' => 'Đã mua hàng', '2' => 'Chưa mua hàng'), request()->get('order'), ['class' => 'form-control', 'data-placeholder' => "Select your favorite actors"]); ?>
                    </div>
                    <?php if(isset($category)): ?>
                    <div class="col-md-2">
                        <?php echo Form::select('catalogueid', $category, request()->get('catalogueid'), ['class' => 'form-control', 'data-placeholder' => "Select your favorite actors"]); ?>
                    </div>
                    <?php endif; ?>
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
                        <th>Mã khách hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Số dư</th>
                        <th>Ngày tạo</th>

                        <th>Hoạt động</th>
                        <th class="text-end">#</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                            </td>
                            <td>
                                <a class="fw-bold text-danger" href="<?php echo e(route('carts.index',['customer_id'=>$v->id])); ?>"><?php echo e($v->code); ?></a>
                            </td>
                            <td>
                                <a class="d-flex align-items-center" href="<?php echo e(route('carts.index',['customer_id'=>$v->id])); ?>">
                                    <div style="width: 64px;">
                                        <img alt="<?php echo e($v->name); ?>" class="rounded-circle" src="<?php echo e(File::exists(base_path($v->image)) ? asset($v->image) : 'https://ui-avatars.com/api/?name='.$v->name); ?>">
                                    </div>
                                    <div class="mx-2">
                                        <?php echo e($v->name); ?><br><?php echo e($v->email); ?><br><?php echo e($v->phone); ?>

                                    </div>
                                </a>
                            </td>
                            <td>
                                <span class="text-danger font-bold"><?php echo e(number_format($v->price,'0',',', '.')); ?>đ</span>
                            </td>
                            <td>
                                <?php echo e($v->created_at); ?>

                            </td>
                            <td class="d-none">
                                <?php if(count($v->orders) > 0): ?>
                                <a href="<?php echo e(route('customers.orders',['id'=>$v->id])); ?>" class="btn btn-success btn-sm"><?php echo e(count($v->orders)); ?> đơn hàng</a>
                                <?php else: ?>
                                <span class="btn btn-primary btn-sm text-xs">Chưa mua hàng</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo $__env->make('components.isModule',['module' => $module,'title' => 'active','id' =>
                                $v->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <td class="text-end">
                                <div class="flex justify-center items-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders_index')): ?>



                                    <a class="btn btn-primary btn-label waves-effect waves-light" href="<?php echo e(route('carts.index',['customer_id'=>$v->id])); ?>">
                                        <i class="ri-eye-line label-icon align-middle fs-16 me-2"></i> Xem đơn hàng
                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customers_edit')): ?>
                                    <a class="btn btn-primary btn-label waves-effect waves-light" href="<?php echo e(route('customers.edit',['id'=>$v->id])); ?>">
                                        <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customers_destroy')): ?>
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
<?php $__env->startPush('javascript'); ?>
<script>
    /* CLICK VÀO THÀNH VIÊN*/
    $(document).on('click', '.choose', function() {
        let _this = $(this);
        $('.choose').removeClass('bg-choose'); //remove all trong các thẻ có class = choose
        _this.toggleClass('bg-choose');
        let data = _this.attr('data-info');
        data = window.atob(data); //decode base64
        let json = JSON.parse(data);
        setTimeout(function() {
            $('.fullname').html('').html(json.name);
            $('#image').attr('src', json.image);
            $('.phone').html('').html(json.phone);
            $('.email').html('').html(json.email);
            $('.address').html('').html(json.address);
            $('.updated').html('').html(json.created_at);
        }, 100); //sau 100ms thì mới thực hiện
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/customer/backend/customer/index.blade.php ENDPATH**/ ?>