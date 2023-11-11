
<?php $__env->startSection('title'); ?>
<title>Cập nhập sản phẩm</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách sản phẩm",
        "src" => route('products.index'),
    ],
    [
        "title" => "Cập nhập sản phẩm",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Cập nhập sản phẩm");

?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<form role="form" action="<?php echo e(route('products.update',['id' => $detail->id ])); ?>}" method="post" enctype="multipart/form-data">
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
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab3" role="tab" aria-selected="true">
                                    Bộ lọc sản phẩm
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab4" role="tab" aria-selected="true">
                                    Giá sản phẩm
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab1" role="tabpanel">
                            <?php echo $__env->make('product.backend.product.common._detail',['action' => 'update'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane" id="tab2" role="tabpanel">
                            <?php echo $__env->make('components.field.index', ['module' => $module], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane" id="tab3" role="tabpanel">
                            <?php echo $__env->make('product.backend.product.common.attribute',['action' => 'update'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane" id="tab4" role="tabpanel">
                            <?php echo $__env->make('product.backend.product.common.price',['action' => 'update'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <label class="form-label text-base font-semibold">Chọn danh mục chính</label>
                            <?php echo Form::select('catalogue_id', $htmlCatalogue, $detail->catalogue_id, ['class' => 'tom-select tom-select-field', 'data-placeholder' => "Tìm kiếm danh mục...", 'required']); ?>
                        </div>
                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Chọn danh mục phụ</label>
                            <?php echo Form::select('catalogue[]', $htmlCatalogue, $getCatalogue, ['multiple', 'class' => 'tom-select tom-select-multiple', 'data-placeholder' => "Tìm kiếm danh mục..."]); ?>
                        </div>
                        <div class="mt-3 <?php if (!in_array('brands', $dropdown)) { ?>d-none<?php } ?>">
                            <label class="form-label text-base font-semibold">Nhà cung cấp</label>
                            <?php echo Form::select('brand_id', $htmlBrands, $detail->brand_id, ['class' => 'tom-select tom-select-brand w-full', 'data-placeholder' => "Tìm kiếm thương hiệu..."]); ?>
                        </div>
                        <?php echo $__env->make('components.image',['action' => 'update','name' => 'image','title'=> 'Ảnh đại diện'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('components.tag',['module' => $module], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('components.publish', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
<style>
    .dz-preview {
        border-radius: 10px;
        -webkit-box-shadow: -8px -4px 57px -34px rgb(66 68 90);
        -moz-box-shadow: -8px -4px 57px -34px rgba(66, 68, 90, 1);
        box-shadow: -8px -4px 57px -34px rgb(66 68 90);
    }

    span.select2-container {
        width: 100% !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('product.backend.product.common.script',['action' => 'update'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/product/backend/product/edit.blade.php ENDPATH**/ ?>