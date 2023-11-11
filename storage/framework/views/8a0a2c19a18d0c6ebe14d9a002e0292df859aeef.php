
<?php $__env->startSection('title'); ?>
<title>Danh sách list hàng ngày <?php echo e(request()->get('dateEnd')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách list hàng",
        "src" => route("brand_orders.outListIndex"),
    ],
    [
        "title" => "Danh sách list hàng ngày " . request()->get('dateEnd'),
        "src" => "javascript:void(0)",
    ]
);
echo breadcrumb_backend($array, "Danh sách list hàng ngày " . request()->get('dateEnd'));
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content-list-month">
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="card-body card-body-22">
                    <div class="p-2">
                        <div class="table-responsive table-card outer-wrapper">
                            <table class="table align-middle table-nowrap" style="margin-bottom: 0" id="invoiceTable">
                                <thead class="text-muted">
                                    <tr>
                                        <td class="text-uppercase">MKH</td>
                                        <td class="text-uppercase">Tên Hàng</td>
                                        <?php
                                        $totalOrder = 0;
                                        ?>
                                        <?php if(!empty($customers)): ?>
                                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($customer->carts)): ?>
                                        <?php
                                        $totalOrder += $customer->carts->cart_items->sum('quantity') + $customer->carts->cart_items->sum('quantity_add')
                                        ?>
                                        <?php endif; ?>
                                        <td class="text-uppercase"><?php echo e($customer->code); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <td style="color: #fff;font-weight: bold;background: #e26b0a;text-align: center;">
                                            Đặt hàng<br>
                                            = <span class="totalQuantityOrderSuccess"><?php echo e($totalOrder); ?></span>
                                        </td>
                                        <td style="color: #ffff00;font-weight: bold;background: #808080;text-align: center;">
                                            Thừa/Thiếu<br>
                                            = <span class="totalExcess"></span>
                                            <input type="hidden" name="" class="inputTotalExcess" value="">
                                        </td>
                                        <td style="color: #ffff00;font-weight: bold;background: #808080;text-align: center;">
                                            Đặt thêm<br>
                                            = <span class="totalAdd"></span>
                                            <input type="hidden" name="" class="inputTotalAdd" value="">
                                        </td>
                                        <td style="color: #ffff00;font-weight: bold;background: #808080;text-align: center;">
                                            Đặt thử<br>
                                            = <span class="totalTest"></span>
                                            <input type="hidden" name="" class="inputTotalTest" value="">
                                        </td>
                                        <?php if(!empty($brands)): ?>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td style="color: #fff;font-weight: bold;background: #e26b0a;text-align: center;">
                                            <?php echo e($brand->title); ?> = <?php echo e(!empty($brand->brand_product_carts)?$brand->brand_product_carts->sum('quantity'):0); ?><br>
                                            Mặt hàng = <?php echo e(!empty($brand->brand_product_carts)?$brand->brand_product_carts->count():0); ?>

                                        </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <td style="color: #fff;font-weight: bold;background: #e26b0a;text-align: center;">
                                            Kho = <?php echo e($inventoryQuantity); ?><br>
                                            Mặt hàng = <?php echo e($inventoryQuantityCount); ?>

                                        </td>
                                        <td style="color: #ff0000; text-align: center">
                                            So Sánh
                                        </td>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <?php if($products): ?>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $totalCustomer = $totalBrand = $totalCustomerOld = 0; ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($item->title); ?></td>
                                        <?php if(!empty($customers)): ?>
                                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td class="text-uppercase customerQuantity" data-product-id="<?php echo e($item->id); ?>" data-customer-id="<?php echo e($customer->id); ?>">
                                            <?php if(!empty($customer->carts) && !empty($customer->carts->cart_items)): ?>
                                            <?php
                                            $checks = $customer->carts->cart_items;
                                            ?>
                                            <?php $__currentLoopData = $checks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kc=>$check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($check->product_id == $item->id): ?>
                                            <?php
                                            $totalCustomer += (float)$check->quantity + (float)$check->quantity_add;
                                            $totalCustomerOld += (float)$check->quantity;
                                            ?>
                                            <input style="border:0px;background: gray;width: 50px;color:white" class="quantityCustomer quantityCustomer-<?php echo e($item->id); ?>" value="<?php echo e((float)$check->quantity+(float)$check->quantity_add); ?>" data-product-id="<?php echo e($item->id); ?>" data-customer-id="<?php echo e($customer->id); ?>">
                                            <input type="hidden" class="quantityCustomerOld quantityCustomerOld-<?php echo e($item->id); ?>" value="<?php echo e((float)$totalCustomerOld); ?>" data-product-id="<?php echo e($item->id); ?>" data-customer-id="<?php echo e($customer->id); ?>">
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <!-- Đặt hàng -->
                                        <td style="font-size: 16px;font-weight: bold;text-align: center; ">
                                            <span class="totalCustomer totalCustomer-<?php echo e($item->id); ?>"><?php echo e($totalCustomer); ?></span>
                                            <input type="hidden" value="<?php echo e($totalCustomer); ?>" class="inputTotalCustomer inputTotalCustomer-<?php echo e($item->id); ?>">
                                            <input type="hidden" value="<?php echo e($totalCustomerOld); ?>" class="inputTotalCustomerOld inputTotalCustomerOld-<?php echo e($item->id); ?>">
                                        </td>
                                        <!-- END -->
                                        <!-- thừa thiếu -->
                                        <?php
                                        $quantity_add = !empty($item->brand_product_carts) ? $item->brand_product_carts->quantity_add : 0;
                                        $quantity_test = !empty($item->brand_product_carts) ? $item->brand_product_carts->quantity_test : 0;
                                        ?>
                                        <td style="text-align: center">
                                            <?php if($totalCustomerOld == $totalCustomer && $item->inventoryQuantity > 0): ?>
                                            <span class="excess excess-<?php echo e($item->id); ?>"><?php echo e((float)$item->inventoryQuantity - $totalCustomer + $quantity_add + $quantity_test); ?></span>
                                            <input type="hidden" value="<?php echo e((float)$item->inventoryQuantity - $totalCustomer + $quantity_add + $quantity_test); ?>" class="inputExcess inputExcess-<?php echo e($item->id); ?>" data-id="<?php echo e($item->id); ?>">
                                            <?php else: ?>
                                            <span class="excess excess-<?php echo e($item->id); ?>"><?php echo e(!empty((float)$item->inventoryQuantity - ($totalCustomer-$totalCustomerOld) + $quantity_add + $quantity_test == 0)?'-':(float)$item->inventoryQuantity - ($totalCustomer-$totalCustomerOld) + $quantity_add + $quantity_test); ?></span>
                                            <input type="hidden" value="<?php echo e((float)$item->inventoryQuantity - ($totalCustomer-$totalCustomerOld)+ $quantity_add + $quantity_test); ?>" class="inputExcess inputExcess-<?php echo e($item->id); ?>" data-id="<?php echo e($item->id); ?>">
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: center" class="input_quantity_add input_quantity_add_<?php echo e($item->id); ?>"><?php echo e(!empty($quantity_add)?$quantity_add:''); ?></td>
                                        <td style="text-align: center" class="input_quantity_test input_quantity_test_<?php echo e($item->id); ?>"><?php echo e(!empty($quantity_test)?$quantity_test:''); ?></td>
                                        <!--END-->
                                        <?php if(!empty($brands)): ?>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <?php if(!empty($brand->brand_product_carts)): ?>
                                            <?php
                                            $checkBrand = $brand->brand_product_carts->pluck('quantity', 'product_id');
                                            ?>
                                            <?php $__currentLoopData = $checkBrand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_id=>$quantity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($product_id == $item->id): ?>
                                            <?php
                                            $totalBrand += (float) $quantity;
                                            ?>
                                            <?php echo e((float)$quantity); ?>

                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <!-- Kho hàng -->
                                        <td style="text-align: center">
                                            <?php echo e(!empty($item->inventoryQuantity)?$item->inventoryQuantity:''); ?>

                                            <input value="<?php echo e($item->inventoryQuantity); ?>" type="hidden" class="inventoryQuantity inventoryQuantity-<?php echo e($item->id); ?>">
                                        </td>
                                        <!-- END-->
                                        <td class="status status-<?php echo e($item->id); ?>">
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pseduo-track"></div>
                    </div>
                </div>
            </div>
            <?php if(!empty($histories) && count($histories) > 0): ?>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Lịch sử chỉnh sửa</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading<?php echo e($item->id); ?>">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse<?php echo e($item->id); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($item->id); ?>">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-0 fw-semibold">Người sửa <?php echo e(!empty($item->user)?$item->user->name:''); ?> - <span class="fw-normal"><?php echo e($item->created_at); ?></span></h6>
                                                <h6 class="fs-15 mb-0 fw-semibold">Khách hàng <span class="text-danger"><?php echo e($item->customer->code); ?>-<?php echo e($item->customer->name); ?></span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapse<?php echo e($item->id); ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?php echo e($item->id); ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <div class="mb-1"><?php echo $item->note; ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!--end accordion-->
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <!--end col-->
    </div>
</div>
<style>
    body {
        font-family: roboto
    }

    .main-content-list-month .card-body table tr td {
        min-width: 50px;
    }

    .main-content-list-month .card-body-22 td {
        font-size: 13px !important;
        border: 1px solid #ddcfcf;
        padding: 5px;
        line-height: 16px;
    }

    .list.form-check-all :nth-child(1) {
        text-align: left !important;
        font-weight: bold;
    }

    .main-content-list-month .card-body-33 {
        margin-top: 20px;
    }

    .main-content-list-month .card-body-33 tr td {
        text-align: center
    }

    .main-content-list-month .card-body-22 .text-muted td {
        font-weight: bold;
        color: #ff0000;
        font-size: 13px;
    }

    .main-content-list-month .card-body-22 tr td:nth-child(2) {
        font-weight: bold !important;
    }

    .table-responsive.table-card.outer-wrapper .text-muted {
        background: #f2f2f2;
    }

    .outer-wrapper {
        max-width: 100vw;
        overflow-x: scroll;
        position: relative;
        scrollbar-color: #d5ac68 #f1db9d;
        scrollbar-width: thin;
        -ms-overflow-style: none;
    }

    .pseduo-track {
        background-color: #f1db9d;
        height: 2px;
        width: 100%;
        position: relative;
        top: -3px;
        z-index: -10;
    }

    @media (any-hover: none) {
        .pseduo-track {
            display: none;
        }
    }

    .outer-wrapper::-webkit-scrollbar {
        height: 3px;
    }

    .outer-wrapper::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0);
    }

    .outer-wrapper::-webkit-scrollbar-thumb {
        height: 3px;
        background-color: #222;
    }

    .outer-wrapper::-webkit-scrollbar-thumb:hover {
        background-color: #333;
    }

    .outer-wrapper::-webkit-scrollbar:vertical {
        display: none;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<script>
    var totalExcess = 0;
    $('.customerQuantity').each(function(e) {
        if ($.trim($(this).html()) == '') {
            var product_id = $(this).attr('data-product-id')
            var customer_id = $(this).attr('data-customer-id')
            var html = '<input style="border:0px;background: gray;width: 50px;color:white" class="quantityCustomer quantityCustomer-' + product_id + '" value="" data-product-id="' + product_id + '"  data-customer-id="' + customer_id + '">'
            html += '<input type="hidden" class="quantityCustomerOld quantityCustomerOld-' + product_id + '" value="0" data-product-id="' + product_id + '"  data-customer-id="' + customer_id + '">'
            $(this).html(html)
        }
    })
    $('.inputExcess').each(function(e) {
        var value = $(this).val();
        totalExcess += parseFloat(value)
    })
    $('.totalExcess').html(totalExcess)
    $('.inputTotalExcess').val(totalExcess)
    $(document).on('change', '.quantityCustomer', function(e) {
        e.preventDefault()
        var product_id = $(this).attr('data-product-id')
        var customer_id = $(this).attr('data-customer-id')
        var quantity = parseFloat($(this).val())
        var totalQuantity = 0;
        var quantityOld = $('.quantityCustomerOld-' + product_id).val()
        //lấy Đặt hàng
        $('.quantityCustomer-' + product_id).each(function(e) {
            var value = $(this).val();
            if (value) {
                totalQuantity += Number(value)
            }
        })
        $('.totalCustomer-' + product_id).html(totalQuantity)
        $('.inputTotalCustomer-' + product_id).val(totalQuantity)
        //check tồn kho
        //totalQuantity => "Đặt hàng"
        var inputTotalCustomerOld = $('.inputTotalCustomerOld-' + product_id).val() // "Đặt hàng - OLD"
        var input_quantity_add = Number($('.input_quantity_add_' + product_id).text()) // "Đặt thêm
        var input_quantity_test = Number($('.input_quantity_test_' + product_id).text()) // "Đặt thử
        var inventoryQuantity = $('.inventoryQuantity-' + product_id).val() // "Kho"
        if (inventoryQuantity == 0) {
            var excessQuantity = inventoryQuantity + inputTotalCustomerOld - totalQuantity + input_quantity_add + input_quantity_test
        } else {
            var excessQuantity = (Number(inventoryQuantity) - Number(inputTotalCustomerOld)) - (Number(totalQuantity) - Number(inputTotalCustomerOld)) + input_quantity_add + input_quantity_test
        }
        if (excessQuantity) {
            $('.excess-' + product_id).html(excessQuantity)
        } else {
            $('.excess-' + product_id).html('-')
        }
        $('.inputExcess-' + product_id).val(excessQuantity)
        //hiển thị "so sánh" => nếu thừa thiếu  = 0 (OK) ngược lại (Sai)
        if (excessQuantity == 0) {
            $('.status-' + product_id).html('<span class="fw-bold text-success">OK</span>')
        } else {
            $('.status-' + product_id).html('<span class="fw-bold text-danger">Sai</span>')
        }
        loadInputTotalCustomer()
        loadInputExcess()
        //ajax
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "<?php echo route('brand_orders.listOrderUpdate') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                customer_id: customer_id,
                quantity: quantity,
                quantityOld: quantityOld,
                inputTotalCustomer: $('.inputTotalCustomer-' + product_id).val()
            },
            success: function(data) {
                if (data.status == 200) {
                    var html = '<div class="accordion-item border-0">';
                    html += '<div class="accordion-header" id="heading' + data.history.id + '">';
                    html += '<a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse' + data.history.id + '" aria-expanded="true" aria-controls="collapse' + data.history.id + '">';
                    html += '<div class="d-flex align-items-center">';
                    html += '<div class="flex-shrink-0 avatar-xs">';
                    html += '<div class="avatar-title bg-success rounded-circle">';
                    html += '<i class="ri-shopping-bag-line"></i>';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="flex-grow-1 ms-3">';
                    html += '<h6 class="fs-15 mb-0 fw-semibold">Người sửa ' + data.user_edit + ' - <span class="fw-normal">' + data.history.created_at + '</span></h6>';
                    html += '<h6 class="fs-15 mb-0 fw-semibold">Khách hàng <span class="text-danger">' + data.customer + '</span></h6>';
                    html += '</div>';
                    html += '</div>';
                    html += '</a>';
                    html += '</div>';
                    html += '<div id="collapse' + data.history.id + '" class="accordion-collapse collapse show" aria-labelledby="heading' + data.history.id + '" data-bs-parent="#accordionExample">';
                    html += '<div class="accordion-body ms-2 ps-5 pt-0">';
                    html += '<h6 class="mb-1">' + data.history.note + '</h6>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    $('#accordionFlushExample').prepend(html)
                }
            },
            error: function(jqXhr, json, errorThrown) {
                var errors = jqXhr.responseJSON;
                var errorsHtml = "";
                $.each(errors["errors"], function(index, value) {
                    errorsHtml += value + "/ ";
                });
            },
        });
        //end
    })
    //load Đặt hàng
    function loadInputTotalCustomer() {
        var quantity = 0;
        $('.inputTotalCustomer').each(function(e) {
            var value = $(this).val();
            if (value) {
                quantity += Number(value)
            }
        })
        $('.totalQuantityOrderSuccess').html(quantity)
    }
    loadInputExcess();
    //load Thừa/Thiếu
    function loadInputExcess() {
        var quantity = 0;
        var input_quantity_add = 0;
        var input_quantity_test = 0;
        //lấy tổng số lượng đặt thêm
        $('.input_quantity_add').each(function(e) {
            var value = $(this).text();
            if (value && value != 0) {
                input_quantity_add += Number(value)
            }
        })
        $('.totalAdd').html(input_quantity_add)
        //lấy tổng số lượng đặt thử
        $('.input_quantity_test').each(function(e) {
            var value = $(this).text();
            if (value && value != 0) {
                input_quantity_test += Number(value)
            }
        })
        $('.totalTest').html(input_quantity_test)
        $('.inputExcess').each(function(e) {
            var value = $(this).val();
            var id = $(this).attr('data-id');
            if (value && value != 0) {
                quantity += Number(value)
                $('.status-' + id).html('<span class="fw-bold text-danger">Sai</span>')
            } else {
                $('.status-' + id).html('<span class="fw-bold text-success">OK</span>')
            }
        })
        $('.totalExcess').html(quantity)
        $('.inputTotalExcess').val(quantity)
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/brand/backend/out-list/list-order.blade.php ENDPATH**/ ?>