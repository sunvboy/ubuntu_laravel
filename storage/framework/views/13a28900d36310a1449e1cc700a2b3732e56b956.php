
<?php $__env->startSection('title'); ?>
<title>Danh sách nhập hàng ngày <?php echo e(request()->get('dateEnd')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách nhập hàng",
        "src" => route("brand_orders.outListIndex"),
    ],
    [
        "title" => "Danh sách nhập hàng ngày " . request()->get('dateEnd'),
        "src" => "javascript:void(0)",
    ]
);
echo breadcrumb_backend($array, "Danh sách nhập hàng ngày " . request()->get('dateEnd'));
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="lds-ripple-container" style="position: fixed;width: 100%;height: 100%;background: #2125297a;z-index: 999999999999;top: 0;left: 0px;">
    <div class="lds-ripple">
        <div></div>
        <div></div>
    </div>
</div>
<style>
    .lds-ripple {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        position: absolute;
        top: 50%;
        left: 50%;
    }

    .lds-ripple div {
        position: absolute;
        border: 4px solid #fff;
        opacity: 1;
        border-radius: 50%;
        animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
    }

    .lds-ripple div:nth-child(2) {
        animation-delay: -0.5s;
    }

    @keyframes  lds-ripple {
        0% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 0;
        }

        4.9% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 0;
        }

        5% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 1;
        }

        100% {
            top: 0px;
            left: 0px;
            width: 72px;
            height: 72px;
            opacity: 0;
        }
    }
</style>
<div class="main-out-list">
    <div class="row main-content-list-month">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="row gy-2 mb-2 p-2">
                    <div class="col-md-2">
                        <select class="tom-select tom-select-field" data-placeholder="Select your favorite actors" name="catalogue_id" id="tom-select-1" tabindex="-1">
                            <?php if(!empty($units)): ?>
                            <?php $i = 0; ?>
                            <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                            <option value="<?php echo e($item); ?>" <?php if (!empty(request()->get('unit'))) { ?><?php if (request()->get('unit') == $item) { ?>selected<?php } ?><?php } else { ?><?php if ($i == 1) { ?>selected<?php } ?><?php } ?>><?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class=" tom-select tom-select-date" data-placeholder="Select your favorite actors" name="catalogue_id" id="tom-select-2" tabindex="-1">
                            <option value="<?php echo e($date_end); ?>"><?php echo e($date_end); ?></option>
                            <?php if(!empty($groupByDateEnd)): ?>
                            <?php $i = 0; ?>
                            <?php $__currentLoopData = $groupByDateEnd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                            <option value="<?php echo e($item); ?>" <?php if (!empty(request()->get('dateEnd'))) { ?><?php if (request()->get('dateEnd') == $item) { ?>selected<?php } ?><?php } ?>><?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="search" name="keyword" class="keyword form-control filter" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="">
                    </div>
                    <div class="col-md-2 d-none">
                        <button class="btn btn-primary btn-label waves-effect waves-light" type="submit">
                            <i class="ri-search-2-line label-icon align-middle fs-16 me-2"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
                <div class="card-body card-body-22">
                    <div>
                        <div class="table-responsive table-card">
                            <table class="table align-middle table-nowrap" style="margin-bottom: 0;" id="invoiceTable">
                                <thead style="font-weight: bold;">
                                    <tr style="text-align: center; ">
                                        <td colspan="2">
                                        </td>
                                        <td class="text-center text-uppercase" style="color: blue;background-color: #d1f0eb !important;color: #089d27;font-size: 15px;font-weight: bold;">
                                            Tổng<br> = <span class="totalEnforcement"></span>
                                        </td>
                                        <td style="color: blue; ">
                                        </td>
                                        <?php if(!empty($brands)): ?>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td <?php if ($brand->highlight == 1) { ?>style="background:#299cdb;color: #fff" <?php } ?> <?php if ($brand->ishome == 1) { ?>style="background:#0ab39c;color: #fff" <?php } ?>>
                                            <?php echo e($brand->title); ?><br> = <span class="quantityOfBrand-<?php echo e($brand->id); ?> <?php if ($brand->ishome == 1) { ?> quantityBrandAdd <?php } ?> <?php if ($brand->highlight == 1) { ?> quantityBrandTest <?php } ?>">0</span>
                                        </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </thead>
                                <thead style="font-weight: bold;">
                                    <tr style="text-align: center;">
                                        <td colspan="2">
                                        </td>
                                        <td style="color: #ff0000;" class="text-center">
                                            Tổng khách đã đặt<br>
                                            = <?php echo e($totalCustomer); ?>

                                        </td>
                                        <td style="color: blue;">
                                            Kho<br> = <?php echo e($inventoryQuantity); ?>

                                        </td>
                                        <?php if(!empty($brands)): ?>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                        $totalBrand = 0;
                                        if (!empty($brand->products) && count($brand->products) > 0) {
                                            foreach ($brand->products as $p) {
                                                if (!empty($p->cart_items_all)) {
                                                    $totalBrand += $p->cart_items_all->sum('quantity');
                                                }
                                            }
                                        }
                                        ?>
                                        <td>
                                            Khách đã đặt<br>
                                            = <?php echo e($totalBrand); ?>

                                        </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <td>
                                            Tổng<br> = <span class="inputTotalTestSuccess">0</span>
                                        </td>
                                        <td>
                                            Tổng<br> = <span class="inputTotalAddSuccess">0</span>
                                        </td>
                                        <td>
                                            Tổng<br> = <span class="inputExcessSuccess">0</span>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td style="color: #ff0000;">
                                            Tổng <br> = <span class="totalEnforcement"></span>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </thead>
                                <thead class="text-muted">
                                    <tr style="text-align: center;">
                                        <td style="min-width: 30px">
                                            MKH
                                        </td>
                                        <td>
                                            Tên Hàng
                                        </td>
                                        <td>
                                            Tổng
                                        </td>
                                        <td>
                                            Kho
                                        </td>
                                        <?php if(!empty($brands)): ?>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <?php echo e($brand->title); ?>

                                        </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <td style="background-color:#299cdb;color: #fff">
                                            Đặt thử<br> hàng Việt
                                        </td>
                                        <td style="background-color: #0ab39c;color: #fff">
                                            Đặt thêm
                                        </td>
                                        <td>
                                            Thừa thiếu
                                        </td>
                                        <td>
                                            Ghi chú
                                        </td>
                                        <td>
                                            Diễn giải
                                        </td>
                                        <td>
                                            Thực đặt
                                        </td>
                                        <td>
                                            Tổng thử<br> = <span class="inputTotalTestSuccess">0</span>
                                        </td>
                                        <td>
                                            Tổng thêm<br> = <span class="inputTotalAddSuccess">0</span>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <?php if(!empty($products)): ?>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td>
                                            <?php echo e($item->title); ?>

                                        </td>
                                        <td>
                                            <span class="textQuantityProduct-<?php echo e($item->id); ?>"><?php echo e(!empty($item->brand_product_carts)?$item->brand_product_carts->quantity:0); ?></span>
                                            <input type="hidden" class="quantity quantity-<?php echo e($item->id); ?>" value="<?php echo e(!empty($item->brand_product_carts)?$item->brand_product_carts->quantity:0); ?>">
                                        </td>
                                        <td>
                                            <input type="text" class="inventoryQuantity inventoryQuantity-<?php echo e($item->id); ?>" value="<?php echo e(!empty($item->inventoryQuantity)?$item->inventoryQuantity:''); ?>" style="border:0px;width: 50px;" disabled>
                                        </td>
                                        <?php if(!empty($brands)): ?>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <?php
                                            if ($brand->id == $item->brand_id) {
                                                echo '<span class="textQuantityProduct-' . $item->id . '">' . $item->cart_items_all->sum('quantity') . '</span>';
                                            }
                                            ?>
                                        </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <td>
                                            <?php if(request()->get('dateEnd') == $dateEnd): ?>
                                            <input type="text" class="quantity-test quantity-test-<?php echo e($item->id); ?>" data-id="<?php echo e($item->id); ?>" value="<?php echo e(!empty($item->brand_product_carts)?$item->brand_product_carts->quantity_test:''); ?>" style="border:0px;width: 50px;background: gray;color:white">
                                            <?php else: ?>
                                            <?php echo e(!empty($item->brand_product_carts)?$item->brand_product_carts->quantity_test:''); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(request()->get('dateEnd') == $dateEnd): ?>
                                            <input type="text" class="quantity-add quantity-add-<?php echo e($item->id); ?>" data-id="<?php echo e($item->id); ?>" value="<?php echo e(!empty($item->brand_product_carts)?$item->brand_product_carts->quantity_add:''); ?>" style="border:0px;width: 50px;background: gray;color:white">
                                            <?php else: ?>
                                            <?php echo e(!empty($item->brand_product_carts)?$item->brand_product_carts->quantity_add:''); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td style="background: #cfcfdf;">
                                            <span class="excess excess-<?php echo e($item->id); ?>">
                                                -
                                            </span>
                                            <input class="inputExcess inputExcess-<?php echo e($item->id); ?>" type="hidden" value="0">
                                        </td>
                                        <td>
                                            <?php if(request()->get('dateEnd') == $dateEnd): ?>
                                            <input type="text" value="<?php echo e(!empty($item->brand_product_carts)?$item->brand_product_carts->note:''); ?>" style="border:0px;width: 50px;background: gray;color:white">
                                            <?php else: ?>
                                            <?php echo e(!empty($item->brand_product_carts)?$item->brand_product_carts->note:''); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class=" fw-bold message message-<?php echo e($item->id); ?>">
                                                <?php if($item->inventoryQuantity > $item->cart_items_all->sum('quantity')): ?>
                                                <span class="text-success">Không phải đặt</span>
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            $totalEnd = 0;
                                            $inputTotalEndOld = 0;
                                            if (!empty($item->brand_product_carts)) {
                                                $totalEndAddTest = $item->brand_product_carts->quantity_test + $item->brand_product_carts->quantity_add;
                                                if ($item->inventoryQuantity < $item->brand_product_carts->quantity) {
                                                    $totalEnd = $item->brand_product_carts->quantity;
                                                    $inputTotalEndOld = $item->brand_product_carts->quantity;
                                                }
                                                if ($item->brand_product_carts->quantity_test || $item->brand_product_carts->quantity_add) {
                                                    $totalEnd = $totalEnd + $item->brand_product_carts->quantity_test + $item->brand_product_carts->quantity_add;
                                                }
                                            }
                                            ?>
                                            <span class="totalEnd totalEnd-<?php echo e($item->id); ?>">
                                                <?php echo e(!empty($totalEnd)?$totalEnd:'-'); ?>

                                            </span>
                                            <input type="hidden" data-brand-id="<?php echo e($item->brand_id); ?>" class="inputTotalEnd inputTotalEnd-<?php echo e($item->id); ?>" value="<?php echo e(!empty($totalEnd)?$totalEnd:0); ?>">
                                            <input type="hidden" data-brand-id="<?php echo e($item->brand_id); ?>" class="inputTotalEndOld inputTotalEndOld-<?php echo e($item->id); ?>" value="<?php echo e(!empty($inputTotalEndOld)?$inputTotalEndOld:0); ?>">
                                        </td>
                                        <td>
                                            <span class="totalTest totalTest-<?php echo e($item->id); ?>"></span>
                                            <input class="inputTotalTest inputTotalTest-<?php echo e($item->id); ?>" type="hidden" value="0">
                                        </td>
                                        <td>
                                            <span class="totalAdd totalAdd-<?php echo e($item->id); ?>"></span>
                                            <input class="inputTotalAdd inputTotalAdd-<?php echo e($item->id); ?>" type="hidden" value="0">
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('brand.backend.out-list.history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!--end col-->
    </div>
</div>
<style>
    .main-out-list .card-body table tr td {
        text-align: center;
        padding: 5px;
        text-transform: none !important;
        font-size: 13px !important;
        line-height: 18px;
    }

    .main-out-list .card-body table tr td:nth-child(2) {
        text-align: left;
    }

    .main-content-list-month .card-body-22 .table-responsive {
        overflow-x: auto;
    }

    .main-content-list-month .card-body-22 td {
        font-size: 13px;
        border: 1px solid #aee1dd;
        padding: 5px;
    }

    .main-content-list-month .card-body-22 .text-muted td {
        font-weight: bold;
        font-size: 13px;
        font-family: roboto;
        text-transform: none !important;
        line-height: 16px;
        color: #08681f;
    }

    .text-muted {
        background: yellow;
    }

    textarea:focus,
    input:focus {
        outline: none;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript'); ?>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<script>
    new TomSelect(".tom-select-field", {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        },
        persist: false,
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect(".tom-select-date", {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        },
        persist: false,
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>

<script>
    var brands = new Array();
</script>
<?php if(!empty($brands)): ?>
<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<script>
    brands['<?php echo $brand->id ?>'] = []
</script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<script>
    $(document).on('change', '.quantity-test', function(e) {
        e.preventDefault()
        var id = $(this).attr('data-id')
        loadOutList(id)
        loadOutListPostAjax(id, 'test')
    })
    $(document).on('change', '.quantity-add', function(e) {
        e.preventDefault()
        var id = $(this).attr('data-id')
        loadOutList(id)
        loadOutListPostAjax(id, 'add')
    })
    $(document).ready(function() {
        $('.quantity-test').each(function(e) {
            var id = $(this).attr('data-id')
            loadOutList(id)
        })
    })
</script>
<script>
    function loadOutListPostAjax(id, type = '') {
        var quantityTest = $('.quantity-test-' + id).val()
        var quantityAdd = $('.quantity-add-' + id).val()
        //call ajax
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "<?php echo route('brand_orders.updateOutList') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: id,
                quantity_test: quantityTest,
                quantity_add: quantityAdd,
                type: type,
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
                    html += '<h6 class="fs-15 mb-0 fw-semibold">' + data.user_edit + ' - <span class="fw-normal">' + data.history.created_at + '</span></h6>';
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
        //end call
    }

    function loadOutList(id) {
        var quantityTest = $('.quantity-test-' + id).val()
        var quantityAdd = $('.quantity-add-' + id).val()
        var inputTotalEndOld = parseFloat($('.inputTotalEndOld-' + id).val())
        if (!quantityTest) {
            quantityTest = 0
        }
        if (!quantityAdd) {
            quantityAdd = 0
        }
        var quantity = parseFloat(quantityTest) + parseFloat(quantityAdd)
        //không tồn tại "Đặt thử hàng Việt" và không tồn tại "Đặt thêm"
        if (!quantityTest && !quantityAdd) {
            $('.message-' + id).html(``)
            $('.totalTest-' + id).html("")
            $('.inputTotalTest-' + id).val(0)
            $('.totalAdd-' + id).html("")
            $('.inputTotalAdd-' + id).val(0)
        }
        //không tồn tại "Đặt thử hàng Việt" và tồn tại "Đặt thêm"
        if (quantityTest && !quantityAdd) {
            $('.message-' + id).html(`<span class="text-danger">Tổng Phải Đặt =></span>`)
            $('.totalTest-' + id).html(`<span class="text-danger">Đặt thử hàng Việt: ${quantityTest}</span>`)
            $('.inputTotalTest-' + id).val(quantityTest)
            $('.totalAdd-' + id).html(`<span class="text-info">Sẽ đặt: ${quantityTest}</span>`)
            $('.inputTotalAdd-' + id).val(quantityTest)
        }
        //tồn tại "Đặt thử hàng Việt" và tồn tại "Đặt thêm"
        if (quantityTest && quantityAdd) {
            $('.message-' + id).html(`<span class="text-danger">Tổng Phải Đặt =></span>`)
            $('.totalTest-' + id).html(`<span class="text-danger">Đặt thử hàng Việt: ${quantityTest}</span>`)
            $('.inputTotalTest-' + id).val(quantityTest)
            $('.totalAdd-' + id).html(`<span class="text-danger">Đặt thêm: ${quantityAdd}</span>`)
            $('.inputTotalAdd-' + id).val(quantityAdd)
        }
        //tồn tại "Đặt thử hàng Việt" và không tồn tại "Đặt thêm"
        if (!quantityTest && quantityAdd) {
            $('.message-' + id).html(`<span class="text-danger">Tổng Phải Đặt =></span>`)
            $('.totalTest-' + id).html("")
            $('.inputTotalTest-' + id).val(0)
            $('.totalAdd-' + id).html(`<span class="text-danger">Đặt thêm: ${quantityAdd}</span>`)
            $('.inputTotalAdd-' + id).val(quantityAdd)
        }
        if (quantityTest || quantityAdd || inputTotalEndOld) {
            var quantityTotalEnd = inputTotalEndOld + parseFloat(quantityTest) + parseFloat(quantityAdd);
            var quantityExcess = parseFloat(quantityTest) + parseFloat(quantityAdd);
            if (!quantityExcess) {
                quantityExcess = '-'
            }
            $('.totalEnd-' + id).html(quantityTotalEnd)
            $('.inputTotalEnd-' + id).val(quantityTotalEnd)
            $('.excess-' + id).html(quantityExcess)
            $('.inputExcess-' + id).val(quantityExcess)
        } else {
            $('.excess-' + id).html('-')
            $('.inputExcess-' + id).val(0)
            //check xem con ton kho hay khong
            var valueStock = parseFloat($('.inventoryQuantity-' + id).val())
            var quantityCustomer = parseFloat($('.quantity-' + id).val())
            if (valueStock > quantityCustomer) {
                var quantityCheck = $('.quantity-' + id).val()
                if (inputTotalEndOld != 0) {
                    if (quantityCheck > 0) {
                        $('.message-' + id).html(`<span class="text-success">Không phải đặt</span>`)
                    } else {
                        $('.message-' + id).html(``)
                    }
                } else {
                    if (quantityCheck > 0) {
                        $('.message-' + id).html(`<span class="text-success">Không phải đặt</span>`)
                    } else {
                        $('.message-' + id).html(``)
                    }
                }
                $('.inputTotalEnd-' + id).val(0)
                $('.totalEnd-' + id).html('-')
            } else {
                $('.totalEnd-' + id).html('-')
                $('.inputTotalEnd-' + id).val(inputTotalEndOld)
            }
        }
        var inputTotalTestSuccess = inputTotalAddSuccess = inputExcessSuccess = 0;
        $('.inputTotalTest').each(function(e) {
            inputTotalTestSuccess += parseFloat($(this).val())
        })
        $('.inputTotalAdd').each(function(e) {
            inputTotalAddSuccess += parseFloat($(this).val())
        })
        $('.inputExcess').each(function(e) {
            inputExcessSuccess += parseFloat($(this).val())
        })
        $('.inputTotalTestSuccess').html(inputTotalTestSuccess)
        $('.inputTotalAddSuccess').html(inputTotalAddSuccess)
        $('.inputExcessSuccess').html(inputExcessSuccess)
        loadEnforcement()
    }

    function loadQuantityOffBrand() {
        var quantityBrandTest = 0
        var quantityBrandAdd = 0
        quantityBrandTest = parseFloat($('.quantityBrandTest').text())
        quantityBrandAdd = parseFloat($('.quantityBrandAdd').text())
        $('.quantity-test').each(function(e) {
            var value = $(this).val()
            if (value && value != 0) {
                quantityBrandTest += parseFloat(value)
            }
        })
        $('.quantity-add').each(function(e) {
            var value = $(this).val()
            if (value && value != 0) {
                quantityBrandAdd += parseFloat(value)
            }
        })
        $('.quantityBrandAdd').text(quantityBrandAdd);
        $('.quantityBrandTest').text(quantityBrandTest);
        $('.totalEnforcement').html(parseFloat(quantityBrandTest) + parseFloat(quantityBrandAdd))
    }

    function loadEnforcement() {
        <?php
        if (!empty($brands)) {
            foreach ($brands as $brand) {
        ?>
                brands['<?php echo $brand->id ?>'] = []
        <?php }
        } ?>
        var total = inputExcessSuccess = totalEnforcement = 0
        //Tổng khách đặt
        $('.inputTotalEndOld').each(function(e) {
            var value = $(this).val()
            total += parseFloat(value)
            var brandID = $(this).attr('data-brand-id')
            if (value && value != 0) {
                brands[brandID].push(value)
            }
        })
        //tổng Thừa thiếu
        $('.inputExcess').each(function(e) {
            var value = $(this).val()
            if (value && value != '-') {
                inputExcessSuccess += parseFloat(value)
            }
        })
        $('.inputExcessSuccess').html(inputExcessSuccess)
        // $('.totalEnforcement').html(total)
        var keys = Object.keys(brands);
        //Tổng brand
        keys.forEach((id, index) => {
            var quantityBrand = brands[id].reduce((partialSum, a) => parseFloat(partialSum) + parseFloat(a), 0)
            $('.quantityOfBrand-' + id).html(quantityBrand)
        });
        loadQuantityOffBrand()
    }
    loadEnforcement()
    $(document).ready(function() {
        $('.lds-ripple-container').addClass('d-none')
    });
</script>
<?php /*<script>
    function pusherQuantity(id, quantity) {
        var stock = parseFloat($('.inventoryQuantity-' + id).val())
        var quantityTest = parseFloat($('.quantity-test-' + id).val())
        var quantityAdd = parseFloat($('.quantity-add-' + id).val())
        if (!quantityTest) {
            quantityTest = 0
        }
        if (!quantityAdd) {
            quantityAdd = 0
        }
        //thêm vào ô text và input => khách đặt
        $('.textQuantityProduct-' + id).html(quantity)
        $('.quantity-' + id).val(quantity)
        //check tồn kho với số lượng đặt
        if (stock < quantity) {
            $('.totalEnd-' + id).html(quantity - stock + quantityTest + quantityAdd)
            $('.inputTotalEnd-' + id).val(quantity - stock + quantityTest + quantityAdd)
            $('.inputTotalEndOld-' + id).val(quantity - stock)
        } else {
            $('.totalEnd-' + id).html('-')
            $('.inputTotalEnd-' + id).val(0)
            $('.inputTotalEndOld-' + id).val(quantityTest + quantityAdd)
        }
        loadOutList(id)
    }
</script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var pusher = new Pusher('1b88887ea9735305b644', {
        cluster: 'ap1'
    });
    var channel = pusher.subscribe('ordercart-channel');
    channel.bind('ordercart-event', function(data) {
        var ids = data.id;
        $.each(ids, function(i, currProgram) {
            pusherQuantity(i, currProgram)
        });
    });
</script>*/ ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/brand/backend/out-list/edit.blade.php ENDPATH**/ ?>