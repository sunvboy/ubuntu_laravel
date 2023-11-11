
<?php $__env->startSection('title'); ?>
<title>Chia hàng</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách hàng chia",
        "src" => "javascript:void(0)",
    ]
);
echo breadcrumb_backend($array, "Chia hàng");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Load data -->
<?php echo $__env->make('brand.backend.out-list.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="main-out-list">
    <div class="row main-content-list-month">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="row gy-1 p-2">
                    <div class="col-md-3">
                        <label class="fw-bold">Ngày nhập hàng</label>
                        <select class=" tom-select tom-select-date filter" data-placeholder="Select your favorite actors" name="dateEnd" id="tom-select-2" tabindex="-1">
                            <option value="<?php echo e($date_end); ?>"><?php echo e($date_end); ?></option>
                            <?php if(!empty($groupByDateEnd)): ?>
                            <?php $i = 0; ?>
                            <?php $__currentLoopData = $groupByDateEnd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                            <option value="<?php echo e($item); ?>" <?php if (!empty(request()->get('dateEnd'))) { ?><?php if (request()->get('dateEnd') == $item) { ?>selected<?php } ?><?php } ?>><?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="outListData">
            <!-- Accordions Bordered -->
            <?php echo $__env->make('brand.backend.share-order.data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!--end col-->
    </div>
</div>
<!--END: Load data -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect(".tom-select-date", {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        },
        persist: false,
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.lds-ripple-container').addClass('d-none')
    })
    $(document).on('change', '.filter', function(e) {
        var dateEnd = $('select[name="dateEnd"]').find(":selected").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "<?php echo route('share_order.filter') ?>",
            type: "POST",
            dataType: "JSON",
            beforeSend: function() {
                $('.lds-ripple-container').removeClass('d-none')
            },
            data: {
                dateEnd: dateEnd,
            },
            success: function(data) {
                $('#outListData').html(data.html)
                $('.lds-ripple-container').addClass('d-none')
            },
            error: function(jqXhr, json, errorThrown) {
                var errors = jqXhr.responseJSON;
                var errorsHtml = "";
                $.each(errors["errors"], function(index, value) {
                    errorsHtml += value + "/ ";
                });
                $('.lds-ripple-container').addClass('d-none')
            },
        });
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/brand/backend/share-order/index.blade.php ENDPATH**/ ?>