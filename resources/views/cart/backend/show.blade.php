@extends('dashboard.layout.dashboard')
@section('title')
<title>Chi tiết đơn đặt hàng hộ</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách đơn đặt hàng hộ",
        "src" => route('carts.index'),
    ],
    [
        "title" => "Chi tiết",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Chi tiết");
?>
@endsection
@section('content')
<?php
$percent = 7;
$quantity = $detail->cart_items->sum('quantity');
$subtotal = $detail->cart_items->sum('amount');
$tax = $detail->cart_items->sum('amount') / 100 * $percent;
?>
<div class="row">
    <div class="col-xl-9">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="table-responsive table-card">
                        <table class="table align-middle" style="margin-bottom: 0;">
                            <thead class="text-muted">
                                <tr>
                                    <th>
                                        STT
                                    </th>
                                    <th>
                                        Tên sản phẩm
                                    </th>
                                    <th>
                                        Nhà cung cấp
                                    </th>
                                    <th>
                                        Đơn giá
                                    </th>
                                    <th>
                                        Số lượng
                                    </th>
                                    <th>
                                        Thành tiền
                                    </th>
                                    <th>
                                        Ghi chú
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="invoice-list-data">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="font-weight: bold; background-color: yellow; color: #ff0000; font-size: 16px;">
                                        {{$quantity}}
                                    </td>
                                    <td style="font-weight: bold; background-color: yellow; color: #ff0000; font-size: 16px;">
                                        {{number_format($subtotal,'0',',','.')}}đ
                                    </td>
                                    <td></td>
                                </tr>
                                @if(!empty($products))
                                @foreach($products as $key=>$item)
                                <?php
                                $quantity = 0;
                                $description = '';
                                $amount = 0;
                                if (!empty($item->cart_items)) {
                                    $quantity = $item->cart_items->quantity;
                                    $description = $item->cart_items->description;
                                    $amount = $item->cart_items->amount;
                                    $price = $item->cart_items->price;
                                }

                                ?>
                                @if(!empty($quantity))
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td class="customer_name">
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset($item->image)}}" alt="" class="avatar-xs rounded-circle me-2">
                                            <a href="{{route('products.edit',['id' => $item->id])}}" target="_blank">
                                                {{$item->title}}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="Deutsch"> {{!empty($item->brand)?$item->brand->title:''}}</td>
                                    <td class="invoice_amount">
                                        {{number_format($price,'0',',','.')}}đ
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{$quantity}}
                                            <span class="ms-1">{{$item->unit}}</span>
                                        </div>
                                    </td>
                                    <td class="gesamt price-{{$item->id}}">{{number_format($amount,'0',',','.')}}đ</td>
                                    <td class="date">
                                        {{$description}}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($detail->cart_histories) && count($detail->cart_histories) > 0)
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
                        @foreach($detail->cart_histories as $item)
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
                                            <h6 class="fs-15 mb-0 fw-semibold">{{!empty($item->user)?$item->user->name:''}} - <span class="fw-normal">{{$item->created_at}}</span></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body ms-2 ps-5 pt-0">
                                    <h6 class="mb-1">{{$item->note}}</h6>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!--end accordion-->
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--end col-->
    <div class="col-xl-3">
        <div class="card sticky-content" id="sidebar" style="border: 1px solid #0ab39c;background: #daf4f0;">
            <div class="card-header" style="background: #0ab39c">
                <div class="d-flex">
                    <h5 class="card-title flex-grow-1 mb-0" style="color: #fff;"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted" style="color: #fff;"></i> Tổng đơn hàng</h5>
                    <div class="flex-shrink-0">
                        <a href="" class="badge bg-primary-subtle text-primary fs-11">Ngày {{$dateEnd}}</a>
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <div class="table-responsive table-card">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="fw-semibold" colspan="2">Tạm tính:</td>
                                <td class="fw-semibold text-end cart-subtotal">{{number_format($subtotal,'0',',','.')}}đ</td>
                            </tr>
                            <tr>
                                <td colspan="2">Thuế<span>({{$percent}}%)</span> </td>
                                <td class="text-end cart-tax">{{number_format($tax,'0',',','.')}}đ</td>
                            </tr>
                            <tr>
                                <th colspan="2">Tổng tiền:</th>
                                <td class="text-end">
                                    <span class="fw-semibold cart-total">{{number_format($subtotal+$tax,'0',',','.')}}đ</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end card-->
        @if(!empty($detail->customer))
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h5 class="card-title flex-grow-1 mb-0">Thông tin khách hàng</h5>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 vstack gap-3">
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{asset('backend/assets/images/users/avatar-3.jpg')}}" alt="{{$detail->customer->name}}" class="avatar-sm rounded">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fs-14 mb-1">{{$detail->customer->name}}</h6>
                                <p class="text-muted mb-0">{{$detail->customer->code}}</p>
                            </div>
                        </div>
                    </li>
                    <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{$detail->customer->email}}</li>
                    <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{$detail->customer->phone}}</li>
                </ul>
            </div>
        </div>
        <!--end card-->
        @if(!empty($detail->customer_addresses))
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0 d-flex align-items-center">
                    <i class="ri-map-pin-line align-middle me-1 text-muted"></i>
                    <span>Địa chỉ giao hàng</span>
                </h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                    <li class="fw-medium fs-14">{{$detail->customer_addresses->name}}</li>
                    <li>{{$detail->customer_addresses->phone}}</li>
                    <li>{{$detail->customer_addresses->address}}</li>
                </ul>
            </div>
        </div>
        @endif
        @endif

        @if(!empty($data) && count($data) > 0)
        <!--end card-->
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Lịch sử đặt hàng</h5>
                    <div class="flex-shrink-0">
                        <a href="{{route('carts.index',['customer_id' => $detail->customer_id])}}" class="badge bg-primary-subtle text-primary fs-11">View all</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead>
                                <tr>

                                    <th scope="col">STT</th>
                                    <th scope="col"> Ngày đặt </th>
                                    <th scope="col">Số lượng </th>
                                    <th scope="col">Tổng tiền</th>
                                    <!-- <th scope="col">#</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <?php
                                $percent = 7;
                                $subtotal = $item->cart_items->sum('amount');
                                $tax = $item->cart_items->sum('amount') / 100 * $percent;
                                ?>
                                <tr>
                                    <td><a href="{{ route('carts.show',['id'=>$item->id]) }}">{{$data->firstItem()+$loop->index}}</a></td>
                                    <td><a href="{{ route('carts.show',['id'=>$item->id]) }}">{{$item->date_end}}</a></td>
                                    <td><a href="{{ route('carts.show',['id'=>$item->id]) }}">{{$item->cart_items->sum('quantity')}}</a></td>
                                    <td><a href="{{ route('carts.show',['id'=>$item->id]) }}">{{number_format($subtotal+$tax,'0',',','.')}}đ</a></td>
                                    <td class="d-none">
                                        <a href="{{ route('carts.duplicate',['id'=>$item->id]) }}" class="btn btn-primary btn-label waves-effect waves-light">
                                            <i class=" ri-file-copy-fill label-icon align-middle fs-16 me-2"></i> Đặt lại
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--end row-->
</div>
<div class="main-content-end-padding">
</div>
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
    $(document).on('change keyup', '.product-quantity', function() {
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
        $('#shippingAddress' + <?php echo $detail->customer_addresses_id ?>).prop('checked', true);
    })
</script>
<script src="{{asset('backend/assets/libs/scroll/sticky.jquery.js')}}"></script>
@endsection
@include('article.backend.script')