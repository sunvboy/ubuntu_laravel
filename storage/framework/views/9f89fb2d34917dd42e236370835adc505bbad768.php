

<?php $__env->startSection('title'); ?>
<title>Cấu hình hệ thống</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Cấu hình hệ thống",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, $seo['meta_title']);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('generals.store')); ?>" class="form-horizontal box">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <?php if (isset($tab) && is_array($tab) && count($tab)) { ?>
                                    <?php $i = 0;
                                    foreach ($tab as $key => $val) {
                                        $i++; ?>
                                        <a class="nav-link mb-2 <?php if ($i == 1) { ?>active<?php } ?>" id="v-pills-home-tab-<?php echo $key ?>" data-bs-toggle="pill" href="#v-pills-home-<?php echo $key ?>" role="tab" aria-controls="v-pills-home-<?php echo $key ?>" aria-selected="true"><?php echo $val['label']; ?></a>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-9">
                            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                <?php if (isset($tab) && is_array($tab) && count($tab)) { ?>
                                    <?php $i = 0;
                                    foreach ($tab as $key => $val) {
                                        $i++; ?>
                                        <div class="tab-pane fade show <?php if ($i == 1) { ?>active<?php } ?>" id="v-pills-home-<?php echo $key ?>" role="tabpanel" aria-labelledby="v-pills-home-tab-<?php echo $key ?>">
                                            <div class="row gy-3">
                                                <?php if (isset($val['value']) && is_array($val['value']) && count($val['value'])) { ?>
                                                    <?php foreach ($val['value'] as $keyItem => $valItem) { ?>
                                                        <?php $image = !empty($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : ''; ?>
                                                        <div class="col-xxl-12 col-md-12">
                                                            <div>
                                                                <label for="" class="form-label fw-bold"><?php echo $valItem['label']; ?></label>
                                                                <?php
                                                                if ($valItem['type'] == 'text') {
                                                                    echo Form::text('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control ' . ((isset($valItem['class'])) ? $valItem['class'] : '') . '']);
                                                                } else if ($valItem['type'] == 'textarea') {
                                                                    echo Form::textarea('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control ' . ((isset($valItem['class'])) ? $valItem['class'] : '') . '']);
                                                                } else if ($valItem['type'] == 'images') {
                                                                    echo '<div class="flex items-center">
                                                                    <img src="' . $image . '" style="width: 200px;height: 80px;object-fit: contain;">';
                                                                    echo Form::text('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control 1' . ((isset($valItem['class'])) ? $valItem['class'] : '') . '', 'onclick' => "openKCFinder($(this), 'image')"]);
                                                                    echo "</div>";
                                                                } else if ($valItem['type'] == 'files') {
                                                                    echo Form::text('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control 1' . ((isset($valItem['class'])) ? $valItem['class'] : '') . '', 'onclick' => "openKCFinder($(this), 'files')"]);
                                                                } else if ($valItem['type'] == 'media') {
                                                                    echo Form::text('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control 1' . ((isset($valItem['class'])) ? $valItem['class'] : '') . '', 'onclick' => "openKCFinder($(this), 'media')"]);
                                                                } else if ($valItem['type'] == 'editor') {
                                                                    echo Form::textarea('config[' . $key . '_' . $keyItem . ']', isset($systems[$key . '_' . $keyItem]) ? htmlspecialchars_decode($systems[$key . '_' . $keyItem]) : '', ['id' => '' . $key . '_' . $keyItem . '', 'class' => 'ck-editor', 'style' => 'height:60px;font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']);
                                                                } else if ($valItem['type'] == 'dropdown') {
                                                                    echo Form::select('config[' . $key . '_' . $keyItem . ']', $valItem['value'], isset($systems[$key . '_' . $keyItem]) ? $systems[$key . '_' . $keyItem] : '', ['class' => 'form-control', 'style' => 'width: 100%;']);
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                    <?php } ?>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div><!--  end col -->
                        <div class="col-md-12 mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-secondary waves-effect waves-light">Lưu thay đổi</button>
                        </div>
                    </div>
                    <!--end row-->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->

    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/general/general.blade.php ENDPATH**/ ?>