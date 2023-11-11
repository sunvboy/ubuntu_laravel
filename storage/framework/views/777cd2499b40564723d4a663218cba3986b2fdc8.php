
<?php $__env->startSection('title'); ?>
<title>Thêm mới</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Cấu hình email ứng dụng",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, 'Cấu hình email ứng dụng');
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form role="form" action="<?php echo e(route('config_infos.update',['id' => $detail->id])); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label fw-bold">Tiêu đề</label>
                                <?php echo Form::text('title', $detail->title, ['class' => 'form-control w-full']); ?>
                            </div>
                        </div>
                        <?php if($detail->id == 1): ?>
                        <?php
                        $emails = json_decode($detail->data, TRUE);
                        ?>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label fw-bold">Email ứng dụng</label>
                                <?php echo Form::text('email[]', !empty($emails) ? trim($emails[0]) : '', ['class' => 'form-control w-full', 'autocomplete' => 'off']); ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label fw-bold">Mật khẩu ứng dụng</label>
                                <?php echo Form::text('email[]', !empty($emails) ? trim($emails[1]) : '', ['class' => 'form-control w-full', 'autocomplete' => 'off']); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-lg-12">
                            <div>
                                <button type="submit" class="btn btn-primary btn-submit">Cập nhập</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/config/info/edit.blade.php ENDPATH**/ ?>