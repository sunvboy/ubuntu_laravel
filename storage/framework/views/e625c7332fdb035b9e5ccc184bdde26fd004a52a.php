<?php

$price = $price_sale = $price_import = 0;

$unit = '';

if ($errors->any()) {

    $price_import = old('price_import');

    $price = old('price');

    $price_sale = old('price_sale');

    $price_contact = old('price_contact');

    $unit = old('unit');

    $oldCustomers  = old('customers');

    $old_price_customers  = old('price_customers');
} else if ($action == 'update') {

    $price_import =  number_format($detail->price_import, '0', ',', '.');

    $price =  number_format($detail->price, '0', ',', '.');

    $price_sale =  number_format($detail->price_sale, '0', ',', '.');

    $price_contact = $detail->price_contact;

    $unit = $detail->unit;

    $product_customer_prices  = $detail->product_customer_prices;

    if (!empty($product_customer_prices) && count($product_customer_prices) > 0) {

        foreach ($product_customer_prices as $key => $item) {

            $oldCustomers[] = json_decode($item->customers);

            $old_price_customers[] = number_format($item->price, '0', ',', '.');
        }
    }
}



?>



<div class="mt-3">

    <div>

        <label class="form-label fw-bold">Giá sản phẩm</label>

    </div>

    <div class="row">

        <div class="col-md-3">

            <label class="form-label ">Giá nhập</label>

            <?php echo Form::text('price_import', $price_import, ['class' => 'form-control int ', 'autocomplete' => 'off']);; ?>

        </div>

        <div class="col-md-3">

            <label class="form-label ">Giá bán</label>

            <?php echo Form::text('price', $price, ['class' => 'form-control int price', 'autocomplete' => 'off']);; ?>

            <div class="d-flex mt-3 align-items-center">

                <div class="me-1">

                    <?php if (isset($price_contact) && $price_contact == 1) { ?>

                        <input type="checkbox" checked name="price_contact" value="1" class="checkbox-item form-check-input">

                    <?php } else { ?>

                        <input type="checkbox" name="price_contact" value="1" class="checkbox-item form-check-input">

                    <?php } ?>

                </div>

                <div>

                    Liên hệ để biết giá

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <label class="form-label ">Giá bán khuyến mại</label>

            <?php echo Form::text('price_sale', $price_sale, ['class' => 'form-control int ', 'autocomplete' => 'off']);; ?>

        </div>

        <div class="col-md-3">

            <label class="form-label ">Đơn vị tính</label>
            <select class="form-control" autocomplete="off" name="unit">
                <?php if(!empty($units)): ?>
                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($item); ?>" <?php if($unit==$item): ?> selected <?php endif; ?>><?php echo e($item); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>

        </div>

    </div>

</div>

<!-- Cấu hình giá khuyến mại theo khách hàng -->

<div class="mt-3">

    <div>

        <label class="form-label fw-bold">Giá sản phẩm khuyến mại</label>

    </div>

    <div class="row">

        <div class="block-customer-price">

            <table class="table">

                <thead>

                    <tr>

                        <td class="w-75">Khách hàng</td>

                        <td>Giá sản phẩm</td>

                        <td>#</td>

                    </tr>

                </thead>

                <tbody>

                    <?php if(!empty($oldCustomers)): ?>

                    <?php $__currentLoopData = $oldCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>

                        <td class="w-75">

                            <select name="customers[<?php echo e($key); ?>][]" class="form-control selectCustomer" multiple>

                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($k); ?>" <?php echo e(collect($value)->contains($k) ? 'selected' : ''); ?>><?php echo e($v); ?></option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>

                        </td>

                        <td>

                            <input type="text" class="form-control int" name="price_customers[]" value="<?php echo e(!empty($old_price_customers[$key])?$old_price_customers[$key]:''); ?>">

                        </td>

                        <td>

                            <a href="javascript:void(0)" class="delete-customer-price flex items-center text-danger">Xóa</a>

                        </td>

                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>



                </tbody>

            </table>

            <div>

                <a href="javascript:void(0)" data-customers="<?php echo base64_encode(json_encode($customers)) ?>" class="add-customer-price btn btn-danger" data-id=""><i class="fa fa-plus"></i>Thêm giá sản phẩm</a>

            </div>

        </div>

    </div>

</div><?php /**PATH D:\xampp\htdocs\order.local\resources\views/product/backend/product/common/price.blade.php ENDPATH**/ ?>