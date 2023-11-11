
<?php $__env->startSection('title'); ?>
<title>Cấu hình sản phẩm</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Cấu hình sản phẩm",
        "src" => route('product_configs.index'),
    ]
);
echo breadcrumb_backend($array, "Cấu hình sản phẩm");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Thuế</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="tax" value="<?php echo e($tax->value); ?>" placeholder="">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end card body -->
        </div>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title mb-0">Đơn vị sản phẩm</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div id="list_unit">
                        <?php if(!empty($units)): ?>
                        <?php
                        $data = json_decode($units->value, TRUE);
                        ?>
                        <?php if(!empty($data) && count($data) > 0): ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="<?php echo e($item); ?>" data-old="<?php echo e($item); ?>">
                            <button class="btn btn-primary handleEdit" type="button">Sửa</button>
                            <button class="btn btn-danger handleDelete" type="button">Xóa</button>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="">
                        <a href="javascript:void(0)" class="btn btn-success waves-effect waves-light" id="add_unit">Thêm mới</a>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
    </div>
    <!-- end col -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<script src="<?php echo e(asset('library/toastr/toastr.min.js')); ?>"></script>
<link href="<?php echo e(asset('library/toastr/toastr.min.css')); ?>" rel="stylesheet">

<script>
    $(document).on('click', '#add_unit', function(e) {
        e.preventDefault()
        var html = '<div class="input-group mb-3">'
        html += '<input type="text" class="form-control" >'
        html += '<button class="btn btn-primary handleAdd" type="button">Thêm mới</button>'
        html += '<button class="btn btn-danger handleDelete" type="button">Xóa</button>'
        html += '</div>'
        $('#list_unit').append(html)
    })
    $(document).on('click', '.handleDelete', function(e) {
        e.preventDefault()
        var _this = $(this)
        var value = _this.parent().find('input').val()
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            url: "<?php echo route('product_configs.deleteUnit') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                value: value,
            },
            success: function(data) {
                if (data.status == 200) {
                    _this.parent().remove()
                    toastr.success(data.message, 'Thông báo')
                } else {
                    toastr.error(data.message, 'Thông báo')
                }
            },
            error: function(jqXhr, json, errorThrown) {
                var errors = jqXhr.responseJSON;
                var errorsHtml = "";
                $.each(errors["errors"], function(index, value) {
                    errorsHtml += value + "/ ";
                });
                console.log(errorsHtml);
            },
        });
    })
    $(document).on('click', '.handleAdd', function(e) {
        e.preventDefault()
        var value = $(this).parent().find('input').val()
        var _this = $(this)
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            url: "<?php echo route('product_configs.createUnit') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                value: value,
            },
            success: function(data) {
                if (data.status == 200) {
                    _this.parent().find('.handleAdd').text('Sửa')
                    _this.parent().find('.handleAdd').removeClass('handleAdd').addClass('handleEdit')
                    _this.parent().find('input').attr('data-old', value)
                    toastr.success(data.message, 'Thông báo')
                } else {
                    toastr.error(data.message, 'Thông báo')
                }
            },
            error: function(jqXhr, json, errorThrown) {
                var errors = jqXhr.responseJSON;
                var errorsHtml = "";
                $.each(errors["errors"], function(index, value) {
                    errorsHtml += value + "/ ";
                });
                console.log(errorsHtml);
            },
        });
    })
    $(document).on('click', '.handleEdit', function(e) {
        e.preventDefault()
        var value = $(this).parent().find('input').val()
        var valueOld = $(this).parent().find('input').attr('data-old')
        var _this = $(this)
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            url: "<?php echo route('product_configs.updateUnit') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                value: value,
                valueOld: valueOld,
            },
            success: function(data) {
                if (data.status == 200) {
                    toastr.success(data.message, 'Thông báo')
                } else {
                    toastr.error(data.message, 'Thông báo')
                }
            },
            error: function(jqXhr, json, errorThrown) {
                var errors = jqXhr.responseJSON;
                var errorsHtml = "";
                $.each(errors["errors"], function(index, value) {
                    errorsHtml += value + "/ ";
                });
                console.log(errorsHtml);
            },
        });
    })
    $(document).on('keyup', 'input[name="tax"]', function(e) {
        e.preventDefault()
        var value = $(this).val()
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            url: "<?php echo route('product_configs.updateTax') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                value: value,
            },
            success: function(data) {},
            error: function(jqXhr, json, errorThrown) {
                var errors = jqXhr.responseJSON;
                var errorsHtml = "";
                $.each(errors["errors"], function(index, value) {
                    errorsHtml += value + "/ ";
                });
                console.log(errorsHtml);
            },
        });
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/product/backend/config/index.blade.php ENDPATH**/ ?>