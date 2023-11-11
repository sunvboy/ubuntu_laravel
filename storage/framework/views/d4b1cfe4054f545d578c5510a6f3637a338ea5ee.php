<div class="mt-3">
    <label class="form-label"><?php echo e($title); ?></label>
    <img src="<?php echo !empty($detail->$name) ? url($detail->$name) :  asset('images/404.png'); ?>" id="mainThmb-<?php echo e($name); ?>" class="'w-full" style="width:100%;height:270px;object-fit: cover;">
    <input type="text" value="<?php echo !empty($detail->$name) ? $detail->$name : ''; ?>" name="<?php echo e($name); ?>_old" class="form-control d-none" id="<?php echo e($name); ?>_old">
    <div class="d-flex mt-3">
        <div class="input-file-container w-50">
            <input class="d-none input-file w-100" id="my-<?php echo e($name); ?>" onchange="mainThamUrl(this,'<?php echo e($name); ?>')" name="<?php echo e($name); ?>" type="file">
            <label class="btn btn-dark w-100 input-file-trigger" for="my-<?php echo e($name); ?>">
                Upload file...
            </label>
        </div>
        <div class="uploadCkfinder w-50 ms-2">
            <label class="btn btn-dark w-100 input-file-trigger" onclick="selectFileUpload('<?php echo e($name); ?>');return false;">
                Select file
            </label>
        </div>
    </div>
    <p class="file-return"></p>
</div>
<?php $__env->startPush('javascript'); ?>
<script>
    /*lấy hình ảnh khi upload */
    function mainThamUrl(input, image) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb-' + image).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    /*lấy tên file khi upload ảnh xong*/
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $(this).parent().parent().parent().find('.file-return').html('Select file image: ' + fileName);;
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/components/image.blade.php ENDPATH**/ ?>