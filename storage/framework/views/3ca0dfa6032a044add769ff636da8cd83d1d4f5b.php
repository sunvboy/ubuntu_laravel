<?php $dropdown = getFunctions(); ?>
<?php
if (in_array('products', $dropdown)) {
    $category_products = \App\Models\CategoryProduct::where('alanguage', config('app.locale'))->get();
    $products = \App\Models\Product::where('alanguage', config('app.locale'))->get();
}
if (in_array('articles', $dropdown)) {
    $category_articles = \App\Models\CategoryArticle::where('alanguage', config('app.locale'))->get();
    $articles = \App\Models\Article::where('alanguage', config('app.locale'))->get();
}
if (in_array('media', $dropdown)) {
    $category_media = \App\Models\CategoryMedia::where('alanguage', config('app.locale'))->get();
    $media = \App\Models\Media::where('alanguage', config('app.locale'))->get();
}
$array = array(
    'category_products' => 'Danh mục sản phẩm',
    'products' => 'Sản phẩm',
    'category_articles' => 'Danh mục bài viết',
    'articles' => 'Bài viết',
    'category_media' => 'Danh mục media',
    'media' => 'Hình ảnh - video',
);
?>
<div id="menu-items">
    <!-- Base Example -->
    <div class="accordion" id="default-accordion-example">
        <?php $i = 0; ?>
        <?php $__currentLoopData = $array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $i++; ?>
        <?php if(!empty($$key) && count($$key) > 0): ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne<?php echo $i ?>">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i ?>">
                    <?php echo e($value); ?>

                </button>
            </h2>
            <div id="collapseOne<?php echo $i ?>" class="accordion-collapse collapse " aria-labelledby="headingOne<?php echo $i ?>" data-bs-parent="#default-accordion-example">
                <div class="accordion-body">
                    <div class="item-list-body" id="<?php echo $key ?>_box">
                        <?php $__currentLoopData = $$key; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" class="<?php echo $key ?> form-check-input mt-0 me-2" value="<?php echo e($v->id); ?>">
                            <span style="flex:1 1 0%0"><?php echo e(str_repeat('|----', (($v->level > 0) ? ($v->level - 1) : 0)) . $v->title); ?></span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menus_create')): ?>
                    <div class="d-flex align-items-center mt-3">
                        <label class="btn btn-sm btn-success mb-0">
                            <input type="checkbox" name="clickAllMenu" class="d-none">&nbsp;<span>Chọn toàn bộ</span>
                        </label>
                        <button type="button" class="btn btn-sm btn-primary add-menu-item ms-3" data-module="<?php echo $key ?>">Thêm vào menu</button>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!-- end: module -->
    </div>
</div><?php /**PATH D:\xampp\htdocs\order.local\resources\views/menu/backend/module.blade.php ENDPATH**/ ?>