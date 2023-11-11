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
        @foreach($array as $key => $value)
        <?php $i++; ?>
        @if(!empty($$key) && count($$key) > 0)
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne<?php echo $i ?>">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i ?>">
                    {{$value}}
                </button>
            </h2>
            <div id="collapseOne<?php echo $i ?>" class="accordion-collapse collapse " aria-labelledby="headingOne<?php echo $i ?>" data-bs-parent="#default-accordion-example">
                <div class="accordion-body">
                    <div class="item-list-body" id="<?php echo $key ?>_box">
                        @foreach($$key as $v)
                        <div class="d-flex align-items-center">
                            <input type="checkbox" class="<?php echo $key ?> form-check-input mt-0 me-2" value="{{$v->id}}">
                            <span style="flex:1 1 0%0">{{str_repeat('|----', (($v->level > 0) ? ($v->level - 1) : 0)) . $v->title;}}</span>
                        </div>
                        @endforeach
                    </div>
                    @can('menus_create')
                    <div class="d-flex align-items-center mt-3">
                        <label class="btn btn-sm btn-success mb-0">
                            <input type="checkbox" name="clickAllMenu" class="d-none">&nbsp;<span>Chọn toàn bộ</span>
                        </label>
                        <button type="button" class="btn btn-sm btn-primary add-menu-item ms-3" data-module="<?php echo $key ?>">Thêm vào menu</button>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
        @endif
        @endforeach
        <!-- end: module -->
    </div>
</div>