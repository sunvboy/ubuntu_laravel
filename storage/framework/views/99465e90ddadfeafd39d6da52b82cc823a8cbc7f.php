

<?php $__env->startSection('title'); ?>

<title>Danh sách đơn hàng nhập ngày <?php echo e($dateEnd); ?></title>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

<?php

$array = array(

    [

        "title" => "Danh sách nhà cung cấp",

        "src" => route("brands.index"),

    ],

    [

        "title" => "Danh sách đơn hàng nhập ngày $dateEnd",

        "src" => "javascript:void(0)",

    ]

);

echo breadcrumb_backend($array, "Danh sách đơn hàng nhập ngày $dateEnd");

?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">

    <div class="col-xl-12 col-lg-12">

        <div>

            <div class="card">

                <div class="card-header">

                    <div class="row align-items-center">

                        <div class="col">

                            <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">

                                <li class="nav-item" role="presentation">

                                    <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#productnav-all" role="tab" aria-selected="true">

                                        Tất cả <span class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1"><?php echo e($data->count()); ?> - Sản phẩm</span>

                                    </a>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

                <!-- end card header -->

                <div class="card-body">

                    <div class="tab-content text-muted">

                        <div class="tab-pane active" id="productnav-all" role="tabpanel">

                            <!-- <div id="table-product-list-all" class="table-card gridjs-border-none"></div> -->

                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="" id="invoiceList">

                                        <div class="card-header border-0">

                                            <div class="d-flex align-items-center">

                                                <h5 class="card-title mb-0 flex-grow-1"><?php echo e($detail->title); ?></h5>

                                                <div class="donhangngay"> Tổng list đơn hàng ngày <?php echo e($dateEnd); ?> </div>

                                                <div class="flex-shrink-0">

                                                    <div class="d-flex gap-2 flex-wrap">

                                                        <button class="btn btn-primary" id="remove-actions" onclick="deleteMultiple()">

                                                            <i class="ri-delete-bin-2-line"></i>

                                                        </button>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="card-body bg-light-subtle border border-dashed border-start-0 border-end-0">

                                            <form>

                                                <div class="row g-3">

                                                    <div class="col-xxl-5 col-sm-12">

                                                        <div class="search-box">

                                                            <input type="text" class="form-control search bg-light border-light" placeholder="Tìm kiếm sản phẩm...">

                                                            <i class="ri-search-line search-icon"></i>

                                                        </div>

                                                    </div>

                                                    <!--end col-->

                                                </div>

                                                <!--end row-->

                                            </form>

                                        </div>

                                        <form method="POST" action="<?php echo e(route('brand_orders.update',['id' => $detail->id])); ?>">

                                            <?php echo csrf_field(); ?>

                                            <div class="card-body">

                                                <div>

                                                    <div class="table-responsive table-card">

                                                        <table class="table align-middle table-nowrap" style="margin-bottom: 0;" id="invoiceTable">

                                                            <thead class="text-muted">

                                                                <tr>

                                                                    <th>

                                                                        STT

                                                                    </th>

                                                                    <th>

                                                                        Tên hàng

                                                                    </th>

                                                                    <th>

                                                                        Giá nhập

                                                                    </th>

                                                                    <th>

                                                                        Số lượng khách đặt

                                                                    </th>

                                                                    <th class="d-none">

                                                                        Số lượng nhập

                                                                    </th>

                                                                    <th>

                                                                        Đơn vị

                                                                    </th>

                                                                    <th>

                                                                        Thành tiền

                                                                    </th>



                                                                </tr>

                                                            </thead>

                                                            <tbody class="list form-check-all" id="invoice-list-data">

                                                                <?php

                                                                $totalQuantity = 0;

                                                                $totalQuantityCustomer = 0;

                                                                $total = 0;

                                                                ?>

                                                                <?php if(!empty($data)): ?>

                                                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                <?php

                                                                $quantity =  $item->quantity;

                                                                $totalQuantity = $totalQuantity + $quantity;

                                                                $price = $item->price_import * $quantity;

                                                                $total = $total + $price;

                                                                $product = json_decode($item->products);

                                                                $totalQuantityCustomer += $item->cart_items->sum('quantity');

                                                                ?>

                                                                <tr>

                                                                    <td>

                                                                        <?php echo e($key+1); ?>


                                                                    </td>

                                                                    <td>

                                                                        <div class="d-flex align-items-center">

                                                                            <img src="<?php echo e(!empty($product->image) ? asset($product->image) : ''); ?>" alt="<?php echo e($product->title); ?>" class="avatar-xs rounded-circle me-2">

                                                                            <?php echo e($product->title); ?>


                                                                        </div>

                                                                    </td>

                                                                    <td><?php echo e(number_format($item->price_import,'0',',','.')); ?>đ</td>

                                                                    <td><?php echo e($item->cart_items->sum('quantity')); ?></td>

                                                                    <td class="d-none">

                                                                        <?php echo Form::text('quantity[]', $quantity, ['class' => 'form-control float-number quantity quantity-' . $item->id . '', 'data-price' => $item->price_import, 'data-id' => $item->id]); ?>

                                                                        <input type="hidden" name="ids[]" value="<?php echo e($item->product_id); ?>">

                                                                        <input type="hidden" name="quantityOlds[]" value="<?php echo e($quantity); ?>">

                                                                    </td>

                                                                    <td><?php echo e(!empty($product->unit)?$product->unit:''); ?></td>

                                                                    <td class="total-<?php echo e($item->id); ?>"><?php echo e(number_format($price,'0',',','.')); ?>đ</td>

                                                                </tr>

                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                <?php endif; ?>

                                                            </tbody>

                                                            <tfoot>

                                                                <tr class="tr-last-">

                                                                    <td></td>

                                                                    <td></td>

                                                                    <td class="invoice_amount" style="font-style: italic; background-color: yellow; ">

                                                                        Tổng:

                                                                    </td>

                                                                    <td style="font-weight: bold; background-color: yellow; color: #ff0000; font-size: 16px;">

                                                                        <?php echo e($totalQuantityCustomer); ?>


                                                                    </td>

                                                                    <td style="font-weight: bold; background-color: yellow; color: #ff0000; font-size: 16px;" class="cart-quantity d-none">

                                                                        <?php echo e($totalQuantity); ?>


                                                                    </td>

                                                                    <td style="font-weight: bold; background-color: yellow; color: #ff0000; font-size: 16px;">

                                                                    </td>

                                                                    <td style="font-weight: bold; background-color: yellow; color: #ff0000; font-size: 16px;" class="cart-total">

                                                                        <?php echo e(number_format($total,'0',',','.')); ?>đ

                                                                    </td>

                                                                </tr>

                                                            </tfoot>

                                                        </table>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="mt-2 d-none">

                                                <button type="submit" class="btn btn-primary ">Cập nhập</button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <?php if(!empty($detail->brand_product_cart_histories) && count($detail->brand_product_cart_histories) > 0): ?>

            <div class="card d-none">

                <div class="card-header">

                    <div class="d-sm-flex align-items-center">

                        <h5 class="card-title flex-grow-1 mb-0">Lịch sử chỉnh sửa</h5>



                    </div>

                </div>

                <div class="card-body">

                    <div class="profile-timeline">

                        <div class="accordion accordion-flush" id="accordionFlushExample">

                            <?php $__currentLoopData = $detail->brand_product_cart_histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

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

                                        <?php echo $item->note; ?>


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

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript'); ?>

<script>
    $(document).ready(function() {

        $('.float-number').keypress(function(event) {

            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {

                event.preventDefault();

            }

        });

    });
</script>

<script>
    function numberWithCommas(nStr) {

        const formattedNumber = nStr.toLocaleString("de-DE");

        return formattedNumber;

    }

    $(document).on('change', '.quantity', function(e) {

        var value = parseFloat($(this).val())

        var id = $(this).attr('data-id')

        var price = parseFloat($(this).attr('data-price'))

        $('.total-' + id).html(numberWithCommas(value * price) + 'đ')

        loadData();

    })



    function loadData() {

        var total = quantity = 0;

        $('.quantity').each(function() {

            var value = parseFloat($(this).val())

            var price = parseFloat($(this).attr('data-price'))

            quantity += value;

            total += value * price;

        })

        $('.cart-quantity').html(quantity)

        $('.cart-total').html(numberWithCommas(total) + 'đ')

    }
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/brand/backend/brand-order/index.blade.php ENDPATH**/ ?>