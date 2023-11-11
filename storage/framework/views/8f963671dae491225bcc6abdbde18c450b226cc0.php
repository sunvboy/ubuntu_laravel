<?php
$code = CodeRender('products');
$price = $price_sale = 0;
$title = $slug = $description = $content = $inventory = $inventoryQuantity = $inventoryPolicy = '';
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
} else if ($action == 'update') {
    $title =  $detail->title;
    $slug = $detail->slug;
    $code = $detail->code;
    $price =  number_format($detail->price, '0', ',', '.');
    $price_sale =  number_format($detail->price_sale, '0', ',', '.');
    $price_contact = $detail->price_contact;
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
<div class=" box p-5">
    <div>
        <label class="form-label text-base font-semibold">Tên sản phẩm</label>
        <?php echo Form::text('title', $title, ['class' => 'form-control w-full title']); ?>
    </div>
    <div class="mt-3">
        <label class="form-label text-base font-semibold">Đường dẫn</label>
        <div class="input-group">
            <div class="input-group-text vertical-1"><span class="vertical-1"><?php echo url(''); ?></span>
            </div>
            <?php echo Form::text('slug', $slug, ['class' => 'form-control canonical', 'data-flag' => 0]); ?>
        </div>
    </div>
    <div class="mt-3">
        <label class="form-label text-base font-semibold">Mô tả</label>
        <div class="mt-2">
            <?php echo Form::textarea('description', $description, ['id' => 'ckDescription', 'class' => 'ck-editor-description', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
        </div>
    </div>
    <div class="mt-3">
        <label class="form-label text-base font-semibold">Thông tin sản phẩm</label>
        <div class="mt-2">
            <?php echo Form::textarea('content', $content, ['id' => 'ckContent', 'class' => 'ck-editor', 'style' => 'height:60px;font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
        </div>
    </div>

</div>
<!-- start: Album Ảnh -->
<div class=" box p-5 mt-3 space-y-3">
    <div>
        <?php echo $__env->make('components.dropzone',['action' => $action], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<!-- END: Album Ảnh -->
<div class=" box p-5 mt-3 space-y-3 ">
    <div>
        <label class="form-label text-base font-semibold">Giá sản phẩm</label>
    </div>
    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="form-label text-base font-semibold">Giá</label>
            <?php echo Form::text('price', $price, ['class' => 'form-control int price', 'autocomplete' => 'off']);; ?>

            <div class="flex mt-3 items-center">
                <div class="mr-1">
                    <?php if (isset($price_contact) && $price_contact == 1) { ?>
                        <input type="checkbox" checked name="price_contact" value="1" class="checkbox-item">
                    <?php } else { ?>
                        <input type="checkbox" name="price_contact" value="1" class="checkbox-item">
                    <?php } ?>
                </div>
                <div>
                    Liên hệ để biết giá
                </div>
            </div>
        </div>
        <div class="">
            <label class="form-label text-base font-semibold">Giá khuyến mại</label>
            <?php echo Form::text('price_sale', $price_sale, ['class' => 'form-control int ', 'autocomplete' => 'off']);; ?>
        </div>
    </div>
</div>
<div class=" box p-5 mt-3 space-y-3 Kho hàng">
    <div>
        <label class="form-label text-base font-semibold">Kho hàng</label>
    </div>
    <!-- START: Quản lý tồn kho -->
    <div>
        <label class="form-label text-base font-semibold">Mã sản phẩm</label>
        <?php echo Form::text('code', $code, ['class' => 'form-control w-full ']); ?>
    </div>
    <div>
        <label class="form-label text-base font-semibold">Quản lý kho</label>
        <?php echo Form::select('inventory', config('cart.inventory'), $inventory, ['class' => 'form-control w-full ']) ?>
    </div>
    <div class="box-inventory hidden">
        <div>
            <label class="form-label text-base font-semibold">Số lượng tồn kho</label>
            <?php echo Form::text('inventoryQuantity', $inventoryQuantity, ['class' => 'form-control w-full int', 'autocomplete' => 'off']); ?>
        </div>
        <div class="flex mt-3 items-center">
            <div class="mr-1">
                <?php if (isset($inventoryPolicy) && $inventoryPolicy == 1) { ?>
                    <input type="checkbox" checked name="inventoryPolicy" value="1" class="checkbox-item">
                <?php } else { ?>
                    <input type="checkbox" name="inventoryPolicy" value="1" class="checkbox-item">
                <?php } ?>
            </div>
            <div>
                Cho phép tiếp tục đặt hàng khi hết hàng
            </div>
        </div>

    </div>
    <!-- END: Quản lý tồn kho -->
</div>
<div class=" box p-5 mt-3 space-y-3 ">
    <div>
        <label class="form-label text-base font-semibold">Vận chuyển</label>
    </div>
    <!-- START: Cân nặng, Kích cỡ(DxRxC) -->
    <div class="flex flex-col md:flex-row gap-2">
        <div class="w-1/2">
            <div>
                <label class="form-label text-base font-semibold">Cân nặng(gram)</label>
                <?php echo Form::text('ships[weight]', !empty($ships['weight']) ? $ships['weight'] : '', ['class' => 'form-control w-full ']); ?>
            </div>
        </div>
        <div class="w-1/2">
            <div>
                <label class="form-label text-base font-semibold">Kích cỡ(DxRxC)</label>
                <div class="flex gap-1">
                    <div class="w-1/3">
                        <?php echo Form::text('ships[length]', !empty($ships['length']) ? $ships['length'] : '', ['class' => 'form-control w-full ']); ?>
                    </div>
                    <div class="w-1/3">
                        <?php echo Form::text('ships[width]', !empty($ships['width']) ? $ships['width'] : '', ['class' => 'form-control w-full ']); ?>
                    </div>
                    <div class="w-1/3">
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

<?php $__env->stopPush(); ?><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/product/backend/product/common/_detail.blade.php ENDPATH**/ ?>