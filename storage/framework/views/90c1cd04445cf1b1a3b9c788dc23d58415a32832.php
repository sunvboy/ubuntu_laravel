
<?php $__env->startSection('title'); ?>
<title>Cập nhập thành viên</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách thành viên",
        "src" => route('customers.index'),
    ],
    [
        "title" => "Cập nhập",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Cập nhập");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form role="form" action="<?php echo e(route('customers.update',['id' => $detail->id])); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-3">
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Nhóm thành viên</label>
                                    <?php echo Form::select('catalogue_id', $category, $detail->catalogue_id, ['class' => 'form-control', 'placeholder' => '']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Email</label>
                                    <?php echo Form::text('email', $detail->email, ['class' => 'form-control w-full', 'placeholder' => 'Email', 'disabled']); ?>
                                </div>
                            </div>
                              <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Code</label>
                                    <?php echo Form::text('code', $detail->code, ['class' => 'form-control w-full', 'placeholder' => '', '']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Số điện thoại</label>
                                    <?php echo Form::text('phone', $detail->phone, ['class' => 'form-control', 'placeholder' => 'Số điện thoại']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Họ và tên</label>
                                    <?php echo Form::text('name', $detail->name, ['class' => 'form-control w-full', 'placeholder' => 'Họ và tên']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label fw-bold">Địa chỉ</label>
                                    <?php echo Form::text('address', $detail->address, ['class' => 'form-control w-full', 'placeholder' => 'Số 80 - Ngõ 20 - Mỹ Đình']); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">
                                <?php echo $__env->make('user.backend.user.image',['action' => 'update'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="col-xxl-12 col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary w-24">Cập nhập</button>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/customer/backend/customer/edit.blade.php ENDPATH**/ ?>