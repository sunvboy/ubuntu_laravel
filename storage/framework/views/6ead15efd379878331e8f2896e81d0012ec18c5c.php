
<?php $__env->startSection('title'); ?>
<title>Danh sách sản phẩm</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách sản phẩm",
        "src" => route('products.index'),
    ]
);
echo breadcrumb_backend($array, "Danh sách sản phẩm");

?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between py-3 px-2">
                <button id="ajax-delete-all" disabled="true" type="button" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-all-product fs-sm-14" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="<?php echo e($module); ?>">
                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> <span class="">Xóa tất cả</span>
                </button>
                <div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products_create')): ?>
                    <!-- Buttons with Label -->
                    <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                    </a>
                    <?php endif; ?>
                    <a class="btn btn-primary btn-label waves-effect waves-light ms-1 full-search" href="javascript:void(0);">
                        <i class="ri-search-2-line label-icon align-middle fs-16 me-2"></i>
                        Tìm kiếm nâng cao
                    </a>
                </div>
            </div>
            <div class="px-2 mb-3">
                <div class="row gy-2">
                    <div class="col-md-4">
                        <?php echo Form::select('catalogue_id', $htmlOption, request()->get('catalogue_id'), ['class' => 'tom-select tom-select-field filter catalogue_id', 'data-placeholder' => "Select your favorite actors"]); ?>
                    </div>
                    <div class="col-md-4">
                        <input type="search" name="keyword" class="keyword form-control filter" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="<?php echo request()->get('keyword') ?>">
                    </div>
                    <div class="col-md-2 d-none">
                        <button class="btn btn-primary btn-label waves-effect waves-light" type="submit">
                            <i class="ri-search-2-line label-icon align-middle fs-16 me-2"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
            </div>
            <!-- START: tìm kiếm -->
            <div class="px-2 mb-3 row filter-more row d-none">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nhập khoảng giá</label>
                    <div class="row">
                        <div class="col-md-6 input-group w-50">
                            <div class="input-group-text">Từ</div>
                            <input type="text" class="form-control int filter h-10" name="start_price" value="">
                        </div>
                        <div class="col-md-6 input-group w-50">
                            <div class="input-group-text">Đến</div>
                            <input type="text" class="form-control int filter h-10" name="end_price" value="">
                        </div>
                    </div>
                </div>
                <div class="col-md-4  <?php if (!in_array('tags', $dropdown)) { ?>d-none<?php } ?>">
                    <label class="form-label fw-semibold">Tags</label>
                    <select class="tom-select tom-select-tag filter" data-placeholder="Tìm kiếm tag..." data-header="Tags" multiple="multiple" name="tags[]" tabindex="-1" hidden="hidden">
                        <?php if(isset($tags)): ?>
                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tag->id); ?>">
                            <?php echo e($tag->title); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-4 <?php if (!in_array('brands', $dropdown)) { ?>d-none<?php } ?>">
                    <label class="form-label fw-semibold">Thương hiệu</label>
                    <select class="tom-select tom-select-brand filter" data-placeholder="Tìm kiếm thương hiệu..." data-header="Thương hiệu" multiple="multiple" name="brands[]" tabindex="-1" hidden="hidden">
                        <?php if(isset($brands)): ?>
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($brand->id); ?>">
                            <?php echo e($brand->title); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-12" id="selected_attr"></div>
                <div class="col-md-12 mt-3">
                    <div id="choose_attr">
                        <label class="form-label fw-semibold">Thuộc tính</label>
                        <input type="text" class="d-none filter" name="attr" value="">
                        <ul class="list_attr_catalogue bg-white ps-0 row" style="display: none;list-style: none;">
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: tìm kiếm -->
            <div id="data_product" class="col-span-12 overflow-auto lg:overflow-visible">
                <?php echo $__env->make('product.backend.product.index.data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

        </div>
    </div>
    <!-- end col -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>

<?php echo $__env->make('product.backend.product.index.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/product/backend/product/index.blade.php ENDPATH**/ ?>