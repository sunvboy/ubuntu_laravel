<?php if($errors->any()): ?>
<div class="alert_danger alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
    <i class="ri-error-warning-line label-icon"></i><strong>Error</strong> - <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e($error); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/components/alert-error.blade.php ENDPATH**/ ?>