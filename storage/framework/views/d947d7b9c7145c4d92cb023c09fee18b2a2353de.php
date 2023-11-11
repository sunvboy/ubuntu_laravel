<?php
$code = CodeRender('products');
$price = $price_sale = 0;
$title = $slug = $description = $content = $inventory = $inventoryQuantity = $inventoryPolicy = $unit = '';
$ships = [];
if ($errors->any()) {
    $code = old('code');
    $price = old('price');
    $price_sale = old('price_sale');
    $price_contact = old('price_contact');
    $title =  old('title');
    $slug = old('slug');
    $description = old('description');
    $content = old('content');
    $inventory = old('inventory');
    $inventoryQuantity = old('inventoryQuantity');
    $inventoryPolicy = old('inventoryPolicy');
    $ships = old('ships');
    $unit = old('unit');
} else if ($action == 'update') {
    $title =  $detail->title;
    $slug = $detail->slug;
    $code = $detail->code;
    $price =  number_format($detail->price, '0', ',', '.');
    $price_sale =  number_format($detail->price_sale, '0', ',', '.');
    $price_contact = $detail->price_contact;
    $unit = $detail->unit;
    $description = $detail->description;
    $content = $detail->content;
    $inventory = $detail->inventory;
    $inventoryQuantity = $detail->inventoryQuantity;
    $inventoryPolicy = $detail->inventoryPolicy;
    $ships = json_decode($detail->ships, TRUE);
}

if (!empty($copy)) {
    $code = CodeRender('products');
}

?>

<!-- BEGIN: Form Layout -->
<div>
    <label class="form-label ">Tên sản phẩm</label>
    <?php echo Form::text('title', $title, ['class' => 'form-control w-full title']); ?>
</div>
<div class="mt-3">
    <label class="form-label ">Đường dẫn</label>
    <div class="input-group">
        <div class="input-group-text vertical-1"><span class="vertical-1"><?php echo url(''); ?></span>
        </div>
        <?php echo Form::text('slug', $slug, ['class' => 'form-control canonical', 'data-flag' => 0]); ?>
    </div>
</div>
<div class="mt-3">
    <label class="form-label ">Mô tả</label>
    <div class="mt-2">
        <?php echo Form::textarea('description', $description, ['id' => 'ckDescription', 'class' => 'ck-editor-description', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
    </div>
</div>
<div class="mt-3">
    <label class="form-label ">Thông tin sản phẩm</label>
    <div class="mt-2">
        <?php echo Form::textarea('content', $content, ['id' => 'ckContent', 'class' => 'ck-editor', 'style' => 'height:60px;font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
    </div>
</div>
<!-- start: Album Ảnh -->
<div class="mt-3 ">
    <div>
        <?php echo $__env->make('components.dropzone',['action' => $action], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<!-- END: Album Ảnh -->

<!--END: Cấu hình giá khuyến mại theo khách hàng -->
<div class="mt-3">
    <div>
        <label class="form-label fw-bold">Kho hàng</label>
    </div>
    <!-- START: Quản lý tồn kho -->
    <div class="mt-3">
        <label class="form-label ">Mã sản phẩm</label>
        <?php echo Form::text('code', $code, ['class' => 'form-control w-full ']); ?>
    </div>
    <div class="mt-3">
        <label class="form-label ">Quản lý kho</label>
        <?php echo Form::select('inventory', config('cart.inventory'), $inventory, ['class' => 'form-control w-full ']) ?>
    </div>
    <div class="box-inventory mt-3">
        <div>
            <label class="form-label ">Số lượng tồn kho</label>
            <?php echo Form::text('inventoryQuantity', $inventoryQuantity, ['class' => 'form-control w-full int', 'autocomplete' => 'off']); ?>
        </div>
        <div class="d-flex mt-3 align-items-center">
            <div class="me-1">
                <?php if (isset($inventoryPolicy) && $inventoryPolicy == 1) { ?>
                    <input type="checkbox" checked name="inventoryPolicy" value="1" class="checkbox-item form-check-input">
                <?php } else { ?>
                    <input type="checkbox" name="inventoryPolicy" value="1" class="checkbox-item form-check-input">
                <?php } ?>
            </div>
            <div>
                Cho phép tiếp tục đặt hàng khi hết hàng
            </div>
        </div>

    </div>
    <!-- END: Quản lý tồn kho -->
</div>
<div class="mt-3">
    <div>
        <label class="form-label fw-bold">Vận chuyển</label>
    </div>
    <!-- START: Cân nặng, Kích cỡ(DxRxC) -->
    <div class="row">
        <div class="col-md-3">
            <div>
                <label class="form-label ">Cân nặng(gram)</label>
                <?php echo Form::text('ships[weight]', !empty($ships['weight']) ? $ships['weight'] : '', ['class' => 'form-control w-full ']); ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <label class="form-label ">Kích cỡ(DxRxC)</label>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo Form::text('ships[length]', !empty($ships['length']) ? $ships['length'] : '', ['class' => 'form-control w-full ']); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo Form::text('ships[width]', !empty($ships['width']) ? $ships['width'] : '', ['class' => 'form-control w-full ']); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo Form::text('ships[height]', !empty($ships['height']) ? $ships['height'] : '', ['class' => 'form-control w-full ']); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END -->


</div>
<?php $__env->startPush('javascript'); ?>
<script>
    var checkInventory = '<?php echo $inventory ?>';
    loadInventory(checkInventory);
    $(document).on('change', 'select[name="inventory"]', function() {
        checkInventory = $(this).val();
        loadInventory(checkInventory);
    });

    function loadInventory(checkInventory) {
        if (checkInventory == 1) {
            $('.box-inventory').removeClass('hidden');
        } else {
            $('.box-inventory').addClass('hidden');
        }
    }
</script>
<?php $__env->stopPush(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/product/backend/product/common/_detail.blade.php ENDPATH**/ ?>