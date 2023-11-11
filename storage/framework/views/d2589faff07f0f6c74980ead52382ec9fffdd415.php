

<?php $__env->startSection('title'); ?>

<title>Thêm mới đơn đặt hàng hộ</title>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

<?php

$array = array(

    [

        "title" => "Danh sách đơn đặt hàng hộ",

        "src" => route('carts.index'),

    ],

    [

        "title" => "Thêm mới",

        "src" => 'javascript:void(0)',

    ]

);

echo breadcrumb_backend($array, "Thêm mới");

?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<form role="form" action="<?php echo e(route('carts.store')); ?>" method="post" enctype="multipart/form-data">

    <?php echo csrf_field(); ?>

    <div class="row">

        <div class="col-xl-9">

            <div class="card">

                <div class="card-header">

                    <h5 class="card-title mb-0 d-flex align-items-center">

                        <span>Chọn khách hàng</span>

                    </h5>

                </div>

                <div class="card-body">

                    <?php echo Form::select('customer_id', $customers, old('customer_id'), ['class' => 'tom-select tom-select-field w-full', 'data-placeholder' => "Select your favorite actors"]); ?>

                </div>

            </div>

            <div class="js_boxShowInfoCustomer">

                <div class="cart mb-5 js_showInfoCustomerLoading d-none">

                    <!-- Load More Buttons -->

                    <div class="hstack flex-wrap gap-2 mb-3 mb-lg-0">

                        <button class="btn btn-outline-primary btn-load">

                            <span class="d-flex align-items-center">

                                <span class="spinner-border flex-shrink-0" role="status">

                                    <span class="visually-hidden">Loading...</span>

                                </span>

                                <span class="flex-grow-1 ms-2">

                                    Loading...

                                </span>

                            </span>

                        </button>

                    </div>

                </div>

            </div>

            <!--end col-->

            <div class="js_showInfoCustomer d-none">

            </div>

            <!--end card-->

        </div>

        <!--end col-->

        <div class="col-xl-3">

            <div class="card sticky-content" id="sidebar" style="border: 1px solid #0ab39c;background: #daf4f0;">

                <div class="card-header" style="background: #0ab39c">

                    <div class="d-flex">

                        <h5 class="card-title flex-grow-1 mb-0" style="color: #fff;"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted" style="color: #fff;"></i> Tổng đơn hàng</h5>

                        <div class="flex-shrink-0">

                            <a href="" class="badge bg-primary-subtle text-primary fs-11">Ngày <?php echo e($dateEnd); ?></a>

                        </div>

                    </div>

                </div>

                <div class="card-body mt-2">

                    <div class="table-responsive table-card">

                        <table class="table table-borderless">

                            <tbody>

                                <tr>

                                    <td class="fw-semibold" colspan="2">Tạm tính:</td>

                                    <td class="fw-semibold text-end cart-subtotal">0</td>

                                </tr>

                                <tr>

                                    <td colspan="2">Thuế<span>(<?php echo e(!empty($tax) ? $tax->value : 0); ?>%)</span> </td>

                                    <td class="text-end cart-tax">0</td>

                                </tr>

                                <tr>

                                    <th colspan="2" style="padding: 3px;">Tổng tiền:</th>

                                    <td class="text-end">

                                        <span class="fw-semibold cart-total">0</span>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <div class="text-end mt-4">

                        <button type="submit" class="btn btn-secondary">Thêm mới</button>

                    </div>

                </div>

            </div>

            <!--end card-->



        </div>

        <!--end row-->

    </div>

    <div class="main-content-end-padding">

    </div>

</form>

<script>
    $(document).on('change', 'select[name="customer_id"]', function(e) {

        var id = $(this).val();

        $.ajax({

            type: "POST",

            url: "<?php echo route('carts.customer') ?>",

            headers: {

                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(

                    "content"

                ),

            },

            beforeSend: function() {

                $('.js_showInfoCustomerLoading').removeClass('d-none')

                $('.js_showInfoCustomer').addClass('d-none');

            },

            data: {

                id: id

            },

            success: function(data) {

                if (data.error) {

                    swal({

                            title: "Thông báo!",

                            text: data.error,

                            type: "success",

                        },

                        function() {

                            window.location.href = BASE_URL + "tp-admin/carts/edit/" + data.detail.id;

                        }

                    );

                } else {

                    $('.js_showInfoCustomer').html(data).removeClass('d-none');

                }

            },

            complete: function() {

                $('.js_showInfoCustomerLoading').addClass('d-none')

                $('.js_showInfoCustomer').removeClass('d-none');

                (function() {

                    $('.sticky-content').StickyDL({

                        paddingTop: 0,

                        heightRefElement: '.main-content-end-padding',

                        optionalBottomFix: 40

                    })

                })()

            },

        });

    })
</script>

<script>
    function numberWithCommas(nStr) {

        const formattedNumber = nStr.toLocaleString("de-DE");

        return formattedNumber;

    }

    $(document).on('click', '.plus', function() {

        var id = $(this).attr('data-id')

        var price = $(this).attr('data-price')

        var quantity = parseFloat($('.product-quantity-' + id).val());

        quantity += 0.1;

        loader(id, price, quantity)

    });

    $(document).on('click', '.minus', function() {

        var id = $(this).attr('data-id')

        var quantity = parseFloat($('.product-quantity-' + id).val());

        var price = $(this).attr('data-price')

        if (quantity <= 0.1) {

            quantity = 0.1;

        } else {

            quantity -= 0.1;

        }

        loader(id, price, quantity)

    });

    $(document).on('change', '.product-quantity', function() {

        var quantity = parseFloat($(this).val());

        var id = $(this).attr('data-id')

        var price = $(this).attr('data-price')

        loader(id, price, quantity)

    });



    function loader(id, price, quantity) {

        $('.product-quantity-' + id).val(parseFloat(quantity.toFixed(1)));

        $('.price-' + id).html(numberWithCommas(quantity.toFixed(1) * parseInt(price)));

        $('.value-price-' + id).val(parseFloat(quantity.toFixed(1)) * parseInt(price));

        cartSubtotal()

    }



    function cartSubtotal() {

        var total = 0;

        var tax = 0;

        $('.value-price').each(function(e) {

            total += parseInt($(this).val())

        })

        tax = total / 100 * 7;

        $('.cart-subtotal').html(numberWithCommas(total) + 'đ')

        $('.cart-tax').html(numberWithCommas(tax) + 'đ')

        $('.cart-total').html(numberWithCommas(total + tax) + 'đ')

    }
</script>
<script src="<?php echo e(asset('backend/assets/libs/scroll/sticky.jquery.js')); ?>"></script>
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
</script>
<script>
    $(document).on('keyup', 'input.floatCustom', function(e) {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/cart/backend/create.blade.php ENDPATH**/ ?>