
<?php $__env->startSection('title'); ?>
<title>List hàng</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách list hàng",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách list hàng");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('brand.backend.out-list.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="main-content-list-month">
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="row gy-1 p-2">
                    <div class="col-md-2">
                        <label class="fw-bold">Đơn vị</label>
                        <select class="tom-select tom-select-field filter" data-placeholder="Select your favorite actors" name="unit" id="tom-select-1" tabindex="-1">
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
                        <label class="fw-bold">Ngày nhập hàng</label>
                        <select class=" tom-select tom-select-date filter" data-placeholder="Select your favorite actors" name="dateEnd" id="tom-select-2" tabindex="-1">
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
                        <label class="fw-bold">Mã khách hàng</label>
                        <input type="search" name="keyword" class="form-control ui-autocomplete-input" id="tags" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="">
                    </div>
                </div>
            </div>
        </div>
        <div id="listHangData">
            <?php echo $__env->make('brand.backend.list-order.data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    var availableTags = [
        <?php if (!empty($customers)) {
            foreach ($customers as $key => $item) { ?> {
                    id: "<?php echo $item->id ?>",
                    code: "<?php echo $item->code ?>"
                },
            <?php } ?>
        <?php } ?>
    ];
</script>
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
            url: "<?php echo route('list_orders.update') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                customer_id: customer_id,
                quantity: quantity,
                quantityOld: quantityOld,
                dateEndUpdate: $('input[name="dateEndUpdate"]').val(),
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
<script>
    $(document).on('change', '.filter', function(e) {
        var unit = $('select[name="unit"]').find(":selected").val();
        var dateEnd = $('select[name="dateEnd"]').find(":selected").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "<?php echo route('list_orders.filter') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                unit: unit,
                dateEnd: dateEnd,
            },
            beforeSend: function() {
                $('.lds-ripple-container').removeClass('d-none')
            },
            success: function(data) {
                $('#listHangData').html(data.html)
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
                loadInputExcess()
                loadDataQuantityOffBrand()
                //hiển thị tên người đang tìm kiếm
                var value = $('#tags').val()
                const filterByTitle = (array, searchTerm) => {
                    return array.filter(item => item.code.toLowerCase().includes(searchTerm.toLowerCase()));
                };
                const filteredArray = filterByTitle(availableTags, value);
                if (value) {
                    $('.itemCustomer').addClass('d-none')
                    filteredArray.forEach(item => {
                        $('.' + item.code).removeClass('d-none')
                    });
                } else {
                    $('.itemCustomer').removeClass('d-none')
                }
                //end
            },
            error: function(jqXhr, json, errorThrown) {
                var errors = jqXhr.responseJSON;
                var errorsHtml = "";
                $.each(errors["errors"], function(index, value) {
                    errorsHtml += value + "/ ";
                });
                $('.lds-ripple-container').addClass('d-none')
            },
            complete: function() {
                $('.lds-ripple-container').addClass('d-none')

            },
        });
    })
</script>

<script>
    $(function() {
        let typingTimer; // Timer identifier
        const doneTypingInterval = 500; // Delay in milliseconds (1 second)
        $(document).on('keyup', '#tags', function(e) {
            clearTimeout(typingTimer);
            var value = $(this).val()
            const filterByTitle = (array, searchTerm) => {
                return array.filter(item => item.code.toLowerCase().includes(searchTerm.toLowerCase()));
            };
            const filteredArray = filterByTitle(availableTags, value);
            if (value) {
                typingTimer = setTimeout(function() {
                    $('.itemCustomer').addClass('d-none')
                    filteredArray.forEach(item => {
                        $('.' + item.code).removeClass('d-none')
                    });
                }, doneTypingInterval);
            } else {
                $('.itemCustomer').removeClass('d-none')

            }

        });

    });
</script>
<script>
    $(document).ready(function() {
        $('.lds-ripple-container').addClass('d-none')
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
    function loadDataQuantityOffBrand() {
        var keys = Object.keys(brands);
        var totalInventory = 0;
        var countInventory = 0;
        //Tổng brand
        keys.forEach((id, index) => {
            var total = 0;
            var count = 0;
            $('.brandTitleQuantityItem-' + id).each(function(e) {
                var value = $(this).text();
                count += 1;
                total += Number(value)
                $('.quantityOfBrand-' + id).html(total)
                $('.countOfBrand-' + id).html(count)
            })

        });
        $('.inventoryQuantity').each(function(e) {
            var value = $(this).val();
            if (value) {
                countInventory += 1;
                totalInventory += Number(value)
            }
            $('.inventoryQuantity').html(totalInventory)
            $('.inventoryCount').html(countInventory)
        })
    }
    loadDataQuantityOffBrand()
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/brand/backend/list-order/index.blade.php ENDPATH**/ ?>