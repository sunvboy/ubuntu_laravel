

<?php $__env->startSection('title'); ?>

<title>Cập nhập đơn đặt hàng hộ</title>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

<?php

$array = array(

    [

        "title" => "Danh sách đơn đặt hàng hộ",

        "src" => route('carts.index'),

    ],

    [

        "title" => "Cập nhập",

        "src" => 'javascript:void(0)',

    ]

);

echo breadcrumb_backend($array, "Cập nhập");

?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form role="form" action="<?php echo e(route('carts.update',['id' => $detail->id])); ?>" method="post" enctype="multipart/form-data">

    <?php echo csrf_field(); ?>

    <div class="row">

        <div class="col-xl-9">

            <div class="card d-none">

                <div class="card-header">

                    <h5 class="card-title mb-0 d-flex align-items-center">

                        <span>Chọn khách hàng</span>

                    </h5>

                </div>

                <div class="card-body">

                    <?php echo Form::select('customer_id', $customers, $detail->customer_id, ['class' => 'tom-select tom-select-field w-full', 'data-placeholder' => "Select your favorite actors", "disabled"]); ?>

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

            <?php if(!empty($detail->cart_histories) && count($detail->cart_histories) > 0): ?>

            <!--end card-->

            <div class="card">

                <div class="card-header">

                    <div class="d-sm-flex align-items-center">

                        <h5 class="card-title flex-grow-1 mb-0">Lịch sử đơn hàng</h5>

                    </div>

                </div>

                <div class="card-body">

                    <div class="profile-timeline">

                        <div class="accordion accordion-flush" id="accordionFlushExample">

                            <?php $__currentLoopData = $detail->cart_histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="accordion-item border-0">

                                <div class="accordion-header" id="headingOne">

                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                                        <div class="d-flex align-items-center">

                                            <div class="flex-shrink-0 avatar-xs">

                                                <div class="avatar-title bg-success rounded-circle">

                                                    <i class="ri-shopping-bag-line"></i>

                                                </div>

                                            </div>

                                            <div class="flex-grow-1 ms-3">

                                                <h6 class="fs-15 mb-0 fw-semibold"><?php echo e(!empty($item->user)?$item->user->name:''); ?> - <span class="fw-normal"><?php echo e($item->created_at); ?></span></h6>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">

                                    <div class="accordion-body ms-2 ps-5 pt-0">

                                        <h6 class="mb-1"><?php echo $item->note; ?></h6>

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

                            <?php
                            $percent = !empty($detail->tax) ? $detail->tax : 0;
                            $subtotal = $detail->cart_items->sum('amount');
                            $tax = $detail->cart_items->sum('amount') / 100 * $percent;
                            ?>

                            <tbody>

                                <tr>

                                    <td class="fw-semibold" colspan="2">Tạm tính:</td>

                                    <td class="fw-semibold text-end cart-subtotal"><?php echo e(number_format($subtotal,'0',',','.')); ?>đ</td>

                                </tr>

                                <tr>

                                    <td colspan="2">Thuế<span>(<?php echo e($percent); ?>%)</span> </td>

                                    <td class="text-end cart-tax"><?php echo e(number_format($tax,'0',',','.')); ?>đ</td>

                                </tr>

                                <tr>

                                    <th colspan="2" style="padding: 3px;">Tổng tiền:</th>

                                    <td class="text-end">
                                        <span class="fw-semibold cart-total"><?php echo e(number_format($subtotal+$tax,'0',',','.')); ?>đ</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($detail->date_end == $dateEnd) { ?>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-secondary">Cập nhập</button>
                        </div>
                    <?php } ?>

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
    $('select[name="customer_id"]').each(function(index) {

        var id = $(this).val();

        $.ajax({

            type: "POST",

            url: "<?php echo route('carts.customer.edit') ?>",

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

                id: id,

                cart_id: "<?php echo $detail->id ?>"

            },

            success: function(data) {

                $('.js_showInfoCustomer').html(data).removeClass('d-none');

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

    });
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

        $('.product-quantity-' + id).val(quantity.toFixed(1));

        $('.price-' + id).html(numberWithCommas(quantity.toFixed(1) * parseInt(price)));

        $('.value-price-' + id).val(quantity.toFixed(1) * parseInt(price));

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

    $(document).ready(function() {

        $('.card-radio input').prop('checked', false);

        $('#shippingAddress' + <?php echo !empty($detail->customer_addresses_id) ? $detail->customer_addresses_id : 0 ?>).prop('checked', true);

    })
</script>

<script src="<?php echo e(asset('backend/assets/libs/scroll/sticky.jquery.js')); ?>"></script>
<script>
    $(document).on('keyup', 'input.floatCustom', function(e) {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('article.backend.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/cart/backend/edit.blade.php ENDPATH**/ ?>