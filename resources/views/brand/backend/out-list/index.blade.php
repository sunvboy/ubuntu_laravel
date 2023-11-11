@extends('dashboard.layout.dashboard')
@section('title')
<title>Out List</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách nhập hàng",
        "src" => "javascript:void(0)",
    ]
);
echo breadcrumb_backend($array, "Danh sách nhập hàng ngày" . $date_end);
?>
@endsection
@section('content')
<!-- Load data -->
@include('brand.backend.out-list.loading')
<div class="main-out-list">
    <div class="row main-content-list-month">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="row gy-1 p-2">
                    <div class="col-md-2">
                        <label class="fw-bold">Đơn vị</label>
                        <select class="tom-select tom-select-field filter" data-placeholder="Select your favorite actors" name="unit" id="tom-select-1" tabindex="-1">
                            @if(!empty($units))
                            <?php $i = 0; ?>
                            @foreach($units as $key=>$item)
                            <?php $i++; ?>
                            <option value="{{$item}}" <?php if (!empty(request()->get('unit'))) { ?><?php if (request()->get('unit') == $item) { ?>selected<?php } ?><?php } else { ?><?php if ($i == 1) { ?>selected<?php } ?><?php } ?>>{{$item}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="fw-bold">Ngày nhập hàng</label>
                        <select class=" tom-select tom-select-date filter" data-placeholder="Select your favorite actors" name="dateEnd" id="tom-select-2" tabindex="-1">
                            <option value="{{$date_end}}">{{$date_end}}</option>
                            @if(!empty($groupByDateEnd))
                            <?php $i = 0; ?>
                            @foreach($groupByDateEnd as $key=>$item)
                            <?php $i++; ?>
                            <option value="{{$item}}" <?php if (!empty(request()->get('dateEnd'))) { ?><?php if (request()->get('dateEnd') == $item) { ?>selected<?php } ?><?php } ?>>{{$item}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Tìm kiếm sản phẩm</label>
                        <input type="search" name="keyword" class="form-control ui-autocomplete-input" id="tags" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="">
                    </div>
                </div>
            </div>
        </div>
        <div id="outListData">
            @include('brand.backend.out-list.data')
        </div>
        <!--end col-->
    </div>
</div>
<!--END: Load data -->
@endsection
@push('javascript')
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
@if(!empty($brands))
@foreach($brands as $brand)
<script>
    brands['<?php echo $brand->id ?>'] = []
</script>
@endforeach
@endif
<script>
    $(document).on('change', '.quantity-test', function(e) {
        e.preventDefault()
        var id = $(this).attr('data-id')
        loadField(id)
        loadOutListPostAjax(id, 'test')
    })
    $(document).on('change', '.quantity-add', function(e) {
        e.preventDefault()
        var id = $(this).attr('data-id')
        loadField(id)
        loadOutListPostAjax(id, 'add')

    })
    $(document).ready(function() {
        $('.quantity-test').each(function(e) {
            var id = $(this).attr('data-id')
            loadField(id)
        })
        $('.quantity-add').each(function(e) {
            var id = $(this).attr('data-id')
            loadField(id)
        })
        loadEnforcement()

    })
</script>
<script>
    //post ajax cập nhập đặt thêm và đặt thử
    function loadOutListPostAjax(id, type = '') {
        var quantityTest = $('.quantity-test-' + id).val()
        var quantityAdd = $('.quantity-add-' + id).val()
        //call ajax
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "<?php echo route('out_list.update') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: id,
                quantity_test: quantityTest,
                quantity_add: quantityAdd,
                type: type,
                dateEndUpdate: $('input[name="dateEndUpdate"]').val()
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
                    loadEnforcement();
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
    //load từng dòng
    function loadField(id) {
        var quantityTest = $('.quantity-test-' + id).val() //Số lượng - "Đặt thử hàng việt"
        var quantityAdd = $('.quantity-add-' + id).val() //Số lượng - "Đặt thêm"
        var quantity = parseFloat($('.quantity-' + id).val()) //Số lượng - Tổng khách đặt
        var inventoryQuantity = parseFloat($('.inventoryQuantity-' + id).val()) //Số lượng - Kho
        if (!quantityTest) {
            quantityTest = 0
        }
        if (!quantityAdd) {
            quantityAdd = 0
        }
        if (!quantity) {
            quantity = 0
        }
        if (!inventoryQuantity) {
            inventoryQuantity = 0
        }
        //không tồn tại "Đặt thử hàng Việt" và không tồn tại "Đặt thêm"
        if (!quantityTest && !quantityAdd) {
            console.log(`không tồn tại "Đặt thử hàng Việt" và không tồn tại "Đặt thêm"`)
            $('.message-' + id).html(``)
            $('.totalTest-' + id).html("")
            $('.inputTotalTest-' + id).val(0)
            $('.totalAdd-' + id).html("")
            $('.inputTotalAdd-' + id).val(0)
        }
        //không tồn tại "Đặt thử hàng Việt" và tồn tại "Đặt thêm"
        if (quantityTest && !quantityAdd) {
            console.log(`không tồn tại "Đặt thử hàng Việt" và tồn tại "Đặt thêm"`)
            $('.message-' + id).html(`<span class="text-danger">Tổng Phải Đặt =></span>`)
            if (quantityTest > 0) {
                $('.totalTest-' + id).html(`<span class="text-danger">Đặt thử hàng Việt: ${quantityTest}</span>`)
                $('.inputTotalTest-' + id).val(quantityTest)
            } else {
                $('.totalTest-' + id).html(``)
                $('.inputTotalTest-' + id).val(0)
            }
            $('.totalAdd-' + id).html(``)
            $('.inputTotalAdd-' + id).val(0)
        }
        //tồn tại "Đặt thử hàng Việt" và tồn tại "Đặt thêm"
        if (quantityTest && quantityAdd) {
            console.log(`tồn tại "Đặt thử hàng Việt" và tồn tại "Đặt thêm"`)
            if (quantityTest > 0 && quantityAdd > 0) {
                $('.message-' + id).html(`<span class="text-danger">Tổng Phải Đặt =></span>`)
            }
            if (quantityTest > 0) {
                $('.totalTest-' + id).html(`<span class="text-danger">Đặt thử hàng Việt: ${quantityTest}</span>`)
                $('.inputTotalTest-' + id).val(quantityTest)
            } else {
                $('.totalTest-' + id).html(``)
                $('.inputTotalTest-' + id).val(0)
            }
            if (quantityAdd > 0) {
                $('.totalAdd-' + id).html(`<span class="text-danger">Đặt thêm: ${quantityAdd}</span>`)
                $('.inputTotalAdd-' + id).val(quantityAdd)
            } else {
                $('.totalAdd-' + id).html(``)
                $('.inputTotalAdd-' + id).val(0)
            }

        }
        //tồn tại "Đặt thử hàng Việt" và không tồn tại "Đặt thêm"
        if (!quantityTest && quantityAdd) {
            console.log(`tồn tại "Đặt thử hàng Việt" và không tồn tại "Đặt thêm"`)
            $('.message-' + id).html(`<span class="text-danger">Tổng Phải Đặt =></span>`)
            $('.totalTest-' + id).html("")
            $('.inputTotalTest-' + id).val(0)
            if (quantityAdd > 0) {
                $('.totalAdd-' + id).html(`<span class="text-danger">Đặt thêm: ${quantityAdd}</span>`)
                $('.inputTotalAdd-' + id).val(quantityAdd)
            } else {
                $('.totalAdd-' + id).html(``)
                $('.inputTotalAdd-' + id).val(0)
            }
        }
        //check nếu tồn tại kho hàng
        if (inventoryQuantity > 0) {
            if (quantity < inventoryQuantity) {
                var quantityExcess = parseFloat(quantityTest) + parseFloat(quantityAdd);
            } else {
                var quantityExcess = quantity - inventoryQuantity + parseFloat(quantityTest) + parseFloat(quantityAdd);
                $('.inputTotalEndOld-' + id).val(quantity - inventoryQuantity)
            }
            if (quantityExcess > 0) {
                $('.message-' + id).html(`<span class="text-danger">Tổng Phải Đặt =></span>`)
            } else {
                $('.message-' + id).html(`<span class="text-success">Không phải đặt</span>`)
            }
            $('.totalEnd-' + id).html(quantityExcess)
            $('.inputTotalEnd-' + id).val(quantityExcess)
        } else {
            if (quantityTest + quantityAdd > 0) {
                var quantityExcess = parseFloat(quantityTest) + parseFloat(quantityAdd);
                $('.excess-' + id).html(quantityExcess)
                $('.inputExcess-' + id).val(quantityExcess)
                $('.totalEnd-' + id).html(quantityExcess + quantity)
                $('.inputTotalEnd-' + id).val(quantityExcess + quantity)
                $('.inputTotalEndOld-' + id).val(quantity)
                $('.message-' + id).html(`<span class="text-danger">Tổng Phải Đặt =></span>`)
            } else {
                $('.excess-' + id).html('')
                $('.inputExcess-' + id).val(0)
                $('.totalEnd-' + id).html(quantity)
                $('.inputTotalEnd-' + id).val(quantity)
                $('.inputTotalEndOld-' + id).val(quantity)
                if (quantity > 0) {
                    $('.message-' + id).html(`<span class="text-danger">Tổng Phải Đặt =></span>`)
                }
            }
        }

        /*if (quantityTest || quantityAdd || inputTotalEndOld) {
            // var quantityTotalEnd = inputTotalEndOld + parseFloat(quantityTest) + parseFloat(quantityAdd);
            var quantityTotalEnd = inputTotalEndOld;
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
        } */
        //Lấy tổng số lượng test

    }

    function loadEnforcement() {
        var inputTotalTestSuccess = inputTotalAddSuccess = inputExcessSuccess = inputTotalEnd = 0;
        $('.inputTotalTest').each(function(e) {
            inputTotalTestSuccess += parseFloat($(this).val())
        })
        $('.inputTotalTestSuccess').html(inputTotalTestSuccess)
        $('.quantityBrandTest').text(inputTotalTestSuccess);

        //lấy tổng số lượng add
        $('.inputTotalAdd').each(function(e) {
            inputTotalAddSuccess += parseFloat($(this).val())
        })
        $('.inputTotalAddSuccess').html(inputTotalAddSuccess)
        $('.quantityBrandAdd').text(inputTotalAddSuccess);

        //lấy tổng thừa thiếu
        $('.inputExcess').each(function(e) {
            inputExcessSuccess += parseFloat($(this).val())
        })
        $('.inputExcessSuccess').html(inputExcessSuccess)
        //lấy tổng thực đặt
        $('.inputTotalEnd').each(function(e) {
            inputTotalEnd += parseFloat($(this).val())
        })
        $('.totalEnforcement').html(inputTotalEnd)

        <?php
        if (!empty($brands)) {
            foreach ($brands as $brand) {
        ?>
                brands['<?php echo $brand->id ?>'] = []
        <?php }
        } ?>
        var total = 0
        //Tổng khách đặt
        $('.inputTotalEndOld').each(function(e) {
            var value = $(this).val()
            total += parseFloat(value)
            var brandID = $(this).attr('data-brand-id')
            if (value && value != 0) {
                brands[brandID].push(value)
            }
        })
        var keys = Object.keys(brands);
        //Tổng brand
        keys.forEach((id, index) => {
            var quantityBrand = brands[id].reduce((partialSum, a) => parseFloat(partialSum) + parseFloat(a), 0)
            $('.quantityOfBrand-' + id).html(quantityBrand)
        });
        var quantityBrandTest = parseFloat($('.quantityBrandTest').text());
        $('.quantityBrandTest').html(quantityBrandTest + inputTotalTestSuccess)
        var quantityBrandAdd = parseFloat($('.quantityBrandAdd').text());
        $('.quantityBrandAdd').html(quantityBrandAdd + inputTotalAddSuccess)
    }
    $(document).ready(function() {
        $('.lds-ripple-container').addClass('d-none')
    });
</script>
<script>
    $(document).on('change', '.filter', function(e) {
        var unit = $('select[name="unit"]').find(":selected").val();
        var dateEnd = $('select[name="dateEnd"]').find(":selected").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "<?php echo route('out_list.filter') ?>",
            type: "POST",
            dataType: "JSON",
            beforeSend: function() {
                $('.lds-ripple-container').removeClass('d-none')
            },
            data: {
                unit: unit,
                dateEnd: dateEnd,
            },
            success: function(data) {
                $('#outListData').html(data.html)
                data.productIDs.forEach(item => {
                    loadField(item)
                });
                loadEnforcement()
                $('.lds-ripple-container').addClass('d-none')
            },
            error: function(jqXhr, json, errorThrown) {
                var errors = jqXhr.responseJSON;
                var errorsHtml = "";
                $.each(errors["errors"], function(index, value) {
                    errorsHtml += value + "/ ";
                });
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
                return array.filter(item => item.title.toLowerCase().includes(searchTerm.toLowerCase()));
            };
            const filteredArray = filterByTitle(availableTags, value);
            if (value) {
                typingTimer = setTimeout(function() {
                    $('.itemProducts').addClass('d-none')
                    filteredArray.forEach(item => {
                        $('.' + item.slug).removeClass('d-none')
                    });
                }, doneTypingInterval);
            } else {
                $('.itemProducts').removeClass('d-none')

            }

        });

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

@endpush