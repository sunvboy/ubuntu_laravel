<?php $__env->startSection('title'); ?>
<title>Cập nhập danh mục sản phẩm</title>
<?php $__env->stopSection(); ?>
<!--START: breadcrumb -->
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh mục sản phẩm",
        "src" => route('category_products.index'),
    ],
    [
        "title" => "Cập nhập danh mục",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Cập nhập danh mục");
?>
<?php $__env->stopSection(); ?>
<!--END: breadcrumb -->
<?php $__env->startSection('content'); ?>
<form role="form" action="<?php echo e(route('category_products.update',['id' => $detail->id])); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row mt-3">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <div class="flex-shrink-0 ms-2">
                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tab1" role="tab" aria-selected="true">
                                    Thông tin chung
                                </a>
                            </li>
                            <?php if(!$field->isEmpty()): ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab2" role="tab" aria-selected="false" tabindex="-1">
                                    Custom field
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active show" id="tab1" role="tabpanel">
                            <div>
                                <label for="basiInput" class="form-label">Tên danh mục</label>
                                <?php echo Form::text('title', $detail->title, ['class' => 'form-control title']); ?>
                            </div>
                            <div class="mt-3">
                                <label for="basiInput" class="form-label">Đường dẫn</label>
                                <div class="input-group">
                                    <div class="input-group-text vertical-1"><span class="vertical-1"><?php echo url(''); ?></span>
                                    </div>
                                    <?php echo Form::text('slug', $detail->slug, ['class' => 'form-control canonical', 'data-flag' => 0]); ?>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Mô tả</label>
                                <div class="mt-2">
                                    <?php echo Form::textarea('description', $detail->description, ['id' => 'ckDescription', 'class' => 'ck-editor', 'style' => 'height:60px;font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                                </div>
                            </div>
                            <div class="box mt-3">
                                <?php echo $__env->make('components.dropzone',['action' => 'update'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2" role="tabpanel">
                            <?php echo $__env->make('components.field.index', ['module' => $module], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div><!-- end card-body -->
                <div class="card-body">
                    <!-- start: SEO -->
                    <?php echo $__env->make('components.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- end: SEO -->
                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-primary w-24">Cập nhập</button>
                    </div>
                </div>
            </div><!-- end card -->
        </div>
        <!--end col-->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div>
                            <label class="form-label">Chọn danh mục cha</label>
                            <?php echo Form::select('parentid', $htmlCatalogue, $detail->parentid, ['id' => 'select-beast', 'class' => 'tom-select tom-select-field', 'data-placeholder' => "Select your favorite actors"]); ?>
                        </div>
                        <?php echo $__env->make('components.image',['action' => 'update','name' => 'image','title'=> 'Ảnh đại diện'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('components.image',['action' => 'update','name' => 'icon','title'=> 'Icon'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('components.image',['action' => 'update','name' => 'banner','title'=> 'Banner'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('components.publish', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('article.backend.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/product/backend/category/edit.blade.php ENDPATH**/ ?>