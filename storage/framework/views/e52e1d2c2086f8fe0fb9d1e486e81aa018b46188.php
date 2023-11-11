<?php $__env->startSection('title'); ?>
<title>Cập nhập </title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách ",
        "src" => route('configIs.index'),
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
<form role="form" action="<?php echo e(route('configIs.update',['id' => $detail->id])); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <label for="basiInput" class="form-label">Tiêu đề</label>
                        <?php echo Form::text('title', $detail->title, ['class' => 'form-control']); ?>
                        <?php echo Form::hidden('id', $detail->id, ['class' => 'form-control']); ?>
                    </div>
                    <div class="mt-3">
                        <label for="basiInput" class="form-label">Module</label>
                        <?php echo Form::select('module', $table, $detail->module, ['class' => 'tom-select tom-select-field', 'data-placeholder' => ""]); ?>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Type</label>
                        <?php echo Form::select('type', $type, $detail->type, ['class' => 'tom-select tom-select-field-2', 'data-placeholder' => ""]); ?>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Hiển thị</label>
                        <div class="d-flex align-items-center">
                            <?php if(!empty($detail->active)): ?>
                            <input type="checkbox" checked name="active" value="1" class="form-check-input me-1 m-0">
                            <?php else: ?>
                            <input type="checkbox" name="active" value="1" class="form-check-input me-1 m-0">
                            <?php endif; ?>
                            Cho phép hiển thị
                        </div>
                    </div>
                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-primary w-24">Cập nhập</button>
                    </div>
                </div><!-- end card-body -->

            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect(".tom-select-field", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect(".tom-select-field-2", {});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/config/is/edit.blade.php ENDPATH**/ ?>