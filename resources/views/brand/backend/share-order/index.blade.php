@extends('dashboard.layout.dashboard')
@section('title')
<title>Chia hàng</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách hàng chia",
        "src" => "javascript:void(0)",
    ]
);
echo breadcrumb_backend($array, "Chia hàng");
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
                </div>
            </div>
        </div>
        <div id="outListData">
            <!-- Accordions Bordered -->
            @include('brand.backend.share-order.data')
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
    $(document).ready(function() {
        $('.lds-ripple-container').addClass('d-none')
    })
    $(document).on('change', '.filter', function(e) {
        var dateEnd = $('select[name="dateEnd"]').find(":selected").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "<?php echo route('share_order.filter') ?>",
            type: "POST",
            dataType: "JSON",
            beforeSend: function() {
                $('.lds-ripple-container').removeClass('d-none')
            },
            data: {
                dateEnd: dateEnd,
            },
            success: function(data) {
                $('#outListData').html(data.html)
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
@endpush