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
    new TomSelect(".tom-select-multiple", {});
    new TomSelect(".tom-select-tag", {});
</script>
<?php $__env->stopPush(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/article/backend/article/script.blade.php ENDPATH**/ ?>