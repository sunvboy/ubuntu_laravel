@extends('dashboard.layout.dashboard')
@section('title')
<title>Thêm mới mã giảm giá</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách coupon",
        "src" => route('coupons.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0);',
    ]
);
echo breadcrumb_backend($array, "Thêm mới");
?>
@endsection
@section('content')
<form role="form" action="{{route('coupons.store')}}" method="post" enctype="multipart/form-data">
    @include('coupon.common.coupon',['action' => 'create'])
</form>
@endsection
@push('javascript')
<script>
    var product_ids = '<?php echo json_encode(old('product_ids')); ?>';
    var exclude_product_ids = '<?php echo json_encode(old('exclude_product_ids')); ?>';
    var product_categories = '<?php echo json_encode(old('product_categories')); ?>';
    var exclude_product_categories = '<?php echo json_encode(old('exclude_product_categories')); ?>';
</script>
@include('coupon.common.script')
@endpush