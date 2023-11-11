<?php

if ($errors->any()) {
    $catalogue  = old('attribute_catalogue');
    $checkbox  = old('checkbox_val');
    $attribute = old('attribute');
    /*version product */
    $title_version = old('title_version');
    $image_version = old('image_version');
    $code_version = old('code_version');

    $_stock_status = old('_stock_status');
    $_stock = old('_stock');
    $_outstock_status =  old('_outstock_status');

    $price_version =  old('price_version');
    $price_sale_version =  old('price_sale_version');
    $status_version =  old('status_version');

    $_ships_weight =  old('_ships_weight');
    $_ships_length =  old('_ships_length');
    $_ships_width =  old('_ships_width');
    $_ships_height =  old('_ships_height');
} else if ($action == 'update') {
    $version_json = json_decode(base64_decode($detail->version_json), true);
    $checkbox = $version_json[0];
    $catalogue  = $version_json[1];
    $attribute = $version_json[2];
    /*version product */
    if ($detail->product_versions) {
        foreach ($detail->product_versions as $key => $val) {
            $id_version[] = $val['id_version'];
            $title_version[] = $val['title_version'];
            $image_version[] = $val['image_version'];
            $code_version[] = $val['code_version'];

            $_stock_status[] = $val['_stock_status'];
            $_stock[] = $val['_stock'];
            $_outstock_status[] = $val['_outstock_status'];

            $price_version[] =  number_format($val['price_version'], '0', ',', '.');
            $price_sale_version[] =  number_format($val['price_sale_version'], '0', ',', '.');
            $status_version[] = $val['status_version'];
            $_ships_weight[] =  $val['_ships_weight'];
            $_ships_length[] =  $val['_ships_length'];
            $_ships_width[] =  $val['_ships_width'];
            $_ships_height[] =  $val['_ships_height'];
        }
    }
}
if (isset($title_version)) {
    $version = count($title_version);
} else {
    $version = 0;
}
?>
<div class=" box p-5 mt-3 space-y-3">
    <div>
        <label class="form-label text-base font-semibold">Bộ lọc sản phẩm</label>
    </div>
    <div class="ibox mb-5 block-version" data-countattribute_catalogue="<?php echo count($htmlAttribute) - 1 ?>">
        <div class="ibox-title">
            <div class="grid grid-cols-3 justify-between text-base  items-center">
                <div class="col-span-2">
                    <h5>Chọn bộ lọc thuộc tính cho sản phẩm</h5>
                    <small class="text-danger mt-3 ">Sản phẩm có các phiên bản dựa theo thuộc tính như kích thước hoặc màu sắc,...?(chọn tối đa 2 )</small>
                </div>
                <div class="text-right">
                    <a class="show-version btn btn-danger" href="javascript:void(0)" <?php echo (!empty($catalogue)) ? 'style="display:none"' : '' ?>>Thêm mới</a>
                    <a class="hide-version btn btn-danger" href="javascript:void(0)" <?php echo (!empty($catalogue)) ? '' : 'style="display:none"' ?>>Đóng</a>
                </div>
            </div>
        </div>
        <div class="ibox-content mt-5" style="background: #f5f6f7; <?php echo (!empty($catalogue)) ? '' : 'display:none"' ?>">
            <div class="block-attribute">
                <div class="mb-3 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="">Sản phẩm biến thể</td>
                                <td style="width: 30%;">Tên thuộc tính</td>
                                <td style="width: 50%;">Giá trị thuộc tính (Các giá trị cách nhau bởi dấu phẩy)</td>
                                <td style="width: 10%;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($catalogue)) { ?>
                                <?php foreach ($catalogue as $key => $value) {
                                    if (isset($attribute_json[$key])) { ?>
                                        <tr data-id="<?php echo $value ?>" <?php echo (isset($checkbox[$key]) && $checkbox[$key] == 1) ? 'class="bg-choose"' : '' ?>>
                                            <td class="" data-index="<?php echo $key ?>">
                                                <?php if (isset($checkbox[$key]) && $checkbox[$key] == 1) { ?>
                                                    <input type="checkbox" checked name="checkbox[]" value="1" class="checkbox-item">
                                                    <input type="text" name="checkbox_val[]" value="1" class="hidden">
                                                    <div for="" class="label-checkboxitem checked"></div>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="checkbox[]" value="1" class="checkbox-item">
                                                    <input type="text" name="checkbox_val[]" value="0" class="hidden">
                                                    <div for="" class="label-checkboxitem "></div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <select class="form-control select3" name="attribute_catalogue[]" tabindex="-1" aria-hidden="true">
                                                    <?php $__currentLoopData = $htmlAttribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php echo e($value == $k ? 'selected' : ''); ?>><?php echo e($v); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php if ($value == 0) { ?>
                                                    <input type="text" class="form-control" disabled="disabled">
                                                <?php } else { ?>
                                                    <select name="attribute[<?php echo $key ?>][]" data-stt="<?php echo e($key); ?>" data-json="<?php echo (isset($attribute_json[$key])) ? base64_encode(json_encode($attribute_json[$key])) : '' ?>" data-condition="<?php echo $value ?>" class="form-control selectMultipe" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm.." data-module="attributes" style="width: 100%;">
                                                    </select>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a type="button" class="text-danger delete-attribute" data-id="">
                                                    <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true" style="fill: red;width:20px;height20px">
                                                        <path d="M8 3.994c0-1.101.895-1.994 2-1.994s2 .893 2 1.994h4c.552 0 1 .446 1 .997a1 1 0 0 1-1 .997h-12c-.552 0-1-.447-1-.997s.448-.997 1-.997h4zm-3 10.514v-6.508h2v6.508a.5.5 0 0 0 .5.498h1.5v-7.006h2v7.006h1.5a.5.5 0 0 0 .5-.498v-6.508h2v6.508a2.496 2.496 0 0 1-2.5 2.492h-5c-1.38 0-2.5-1.116-2.5-2.492z"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="flex " style="padding: 0px 20px 10px 20px;">
                    <a href="javascript:void(0)" class="add-variations btn btn-success mr-1 text-white hidden"><i class="fa fa-plus"></i> Tạo sản phẩm biến thể
                    </a>
                    <a href="javascript:void(0)" data-attribute="<?php echo base64_encode(json_encode($htmlAttribute)) ?>" class="add-attribute btn btn-danger" data-id=""><i class="fa fa-plus"></i> Thêm thuộc tính cho sản phẩm
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <div class="sortable" id="table_version">
                    <?php if ($version > 0) { ?>
                        <?php foreach ($title_version as $key => $value) { ?>
                            <div class="mb-2 dd3-content">
                                <div class="relative">
                                    <a href="javascript:void(0)" class="form-label mb-0 accordion w-full js_add_option ">
                                        <?php
                                        if ($errors->any()) {
                                            $title_v = explode('-', $value);
                                        } else if ($action == 'update') {
                                            $title_v = json_decode($title_version[$key], TRUE);
                                        }
                                        ?>
                                        <?php if (!empty($title_v)) { ?>
                                            <?php foreach ($title_v as $k => $v) {
                                                if ($v != '') { ?>
                                                    <input type="hidden" name="title_check[]" value="<?php echo e($v); ?>">
                                                    <span class="text-xs whitespace-nowrap text-success bg-success/20 pending  pending-success/20 rounded-full px-2 py-1 mr-1 "><?php echo e($v); ?></span>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </a>
                                    <?php
                                    if ($errors->any()) { ?>
                                        <input type="hidden" name="title_version[]" value="<?php echo collect($title_v)->join('', '-') ?>">
                                    <?php } else if ($action == 'update') { ?>
                                        <input type="hidden" name="title_version[]" value="<?php echo collect($title_v)->join('-') ?>">
                                    <?php } ?>
                                    <a href="javascript:void(0)" class="text-danger version_remove" data-number="1">Xóa</a>
                                </div>
                                <div class="version_item_size hidden">
                                    <div class="grid grid-cols-2 gap-6 mt-3">
                                        <div class="">
                                            <label class="form-label">Hình ảnh</label>
                                            <div class="flex items-center space-x-3">
                                                <div class="avatar" style="cursor: pointer;flex:none">
                                                    <img src="<?php echo !empty($image_version[$key]) ? $image_version[$key] : url('images/404.png') ?>" class="img-thumbnail" style="width: 100px;height: 100px;object-fit: cover;">
                                                </div>
                                                <input type="text" name="image_version[]" style="cursor: not-allowed;opacity: 0.56;" value="<?php echo $image_version[$key] ?>" class="form-control" placeholder="Đường dẫn của ảnh" autocomplete="off">
                                            </div>
                                        </div>
                                        <div><label class="form-label">Mã sản phẩm</label><input type="text" name="code_version[]" value="<?php echo $code_version[$key] ?>" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-6 mt-3">
                                        <div>
                                            <label class="form-label">Giá</label>
                                            <input type="text" value="<?php echo  $price_version[$key] ?>" name="price_version[]" class="form-control int price" placeholder="">
                                        </div>
                                        <div class="">
                                            <label class="form-label">Giá ưu đãi</label>
                                            <input type="text" value="<?php echo $price_sale_version[$key] ?>" name="price_sale_version[]" class="form-control int price" placeholder="">
                                        </div>
                                    </div>
                                    <!-- START: Quản lý tồn kho -->
                                    <div class="mt-3">
                                        <h2 class="font-medium text-base mr-auto">Quản lý tồn kho</h2>
                                        <div class="mt-3">
                                            <div class="form-switch">
                                                <select class="form-select selectStock" name="_stock_status[]">
                                                    <option value="1" <?php if($_stock_status[$key]==1): ?> selected <?php endif; ?>>Có quản lý
                                                        tồn kho</option>
                                                    <option value="0" <?php if($_stock_status[$key]==0): ?> selected <?php endif; ?>>Không quản
                                                        lý
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="showStock <?php if($_stock_status[$key]==0): ?> hidden <?php endif; ?>">
                                            <div class="mt-3">
                                                <label class="form-label">Số lượng trong kho</label>
                                                <input type="number" name="_stock[]" min="0" class="form-control" placeholder="" value="<?php echo !empty($_stock[$key]) ? $_stock[$key] : '' ?>">
                                            </div>
                                            <div class="mt-3">
                                                <div class="form-switch">
                                                    <label class="form-label">Đặt hàng khi đã hết hàng</label>
                                                    <select class="form-select" name="_outstock_status[]">
                                                        <option value="0" <?php if(!empty($_outstock_status[$key]) && $_outstock_status[$key]==0): ?> selected <?php endif; ?>>Không
                                                            cho đặt hàng khi hết hàng</option>
                                                        <option value="1" <?php if(!empty($_outstock_status[$key]) && $_outstock_status[$key]==1): ?> selected <?php endif; ?>>Đồng
                                                            ý
                                                            cho đặt hàng khi đã hết hàng
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Quản lý tồn kho -->
                                    <!-- START: Cân nặng, Kích cỡ(DxRxC) -->
                                    <div class="flex flex-col md:flex-row gap-6 mt-3">
                                        <div class="w-1/2">
                                            <div>
                                                <label class="form-label text-base font-semibold">Cân nặng(gram)</label>
                                                <?php echo Form::text('_ships_weight[]', !empty($_ships_weight[$key]) ? $_ships_weight[$key] : '', ['class' => 'form-control w-full ']); ?>
                                            </div>
                                        </div>
                                        <div class="w-1/2">
                                            <div>
                                                <label class="form-label text-base font-semibold">Kích cỡ(DxRxC)</label>
                                                <div class="flex gap-1">
                                                    <div class="w-1/3">
                                                        <?php echo Form::text('_ships_length[]', !empty($_ships_length[$key]) ? $_ships_length[$key] : '', ['class' => 'form-control w-full ']); ?>
                                                    </div>
                                                    <div class="w-1/3">
                                                        <?php echo Form::text('_ships_width[]', !empty($_ships_width[$key]) ? $_ships_width[$key] : '', ['class' => 'form-control w-full ']); ?>
                                                    </div>
                                                    <div class="w-1/3">
                                                        <?php echo Form::text('_ships_height[]', !empty($_ships_height[$key]) ? $_ships_height[$key] : '', ['class' => 'form-control w-full ']); ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- END -->

                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/product/backend/product/common/attribute.blade.php ENDPATH**/ ?>