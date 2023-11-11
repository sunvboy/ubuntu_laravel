<div class="row">
    <div class="col-md-9">
        @include('components.alert-error')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div>
                        <label class="form-label text-base font-semibold">Tiêu đề</label>
                        <?php echo Form::text('title', !empty($detail) ? $detail->title : '', ['class' => 'form-control w-full title', 'required']); ?>
                    </div>
                    <div class="mt-3">
                        <label class="form-label text-base font-semibold">Đường dẫn</label>
                        <div class="input-group">
                            <div class="input-group-text vertical-1"><span class="vertical-1"><?php echo url(''); ?></span>
                            </div>
                            <?php echo Form::text('slug', !empty($detail) ? $detail->slug : '', ['class' => 'form-control canonical', 'data-flag' => 0, 'required']); ?>
                        </div>
                    </div>
                    <div class="mt-3 d-none">
                        <label class="form-label text-base font-semibold">Mô tả</label>
                        <div class="mt-2">
                            <?php echo Form::textarea('description', !empty($detail) ? $detail->description : '', ['id' => 'ckDescription', 'class' => 'ck-editor', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab" aria-selected="true">
                            Chung
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab" aria-selected="false" tabindex="-1">
                            Hạn chế sử dụng
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab" aria-selected="false" tabindex="-1">
                            Các giới hạn sử dụng
                        </a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active show" id="home1" role="tabpanel">
                        <div>
                            <label class="form-label text-base font-semibold">Mã
                                ưu đãi</label>
                            <div class="input-group">
                                <?php echo Form::text('name', !empty($detail) ? $detail->name : '', ['class' => 'form-control', 'autocomplete' => 'off', 'required']); ?>
                                <div class="input-group-text render_code cursor-pointer w-52">Tạo mã tự
                                    động
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="form-label text-base font-semibold">Loại ưu đãi</label>
                            <?php echo Form::select('typecoupon', config('cart.coupon'), !empty($detail) ? $detail->type : '', ['class' => 'form-control ']); ?>
                        </div>
                        <div class="mt-2">
                            <label class="form-label text-base font-semibold  flex items-center">Mức ưu đãi <a href="" class="text-primary tooltip" title="Giá trị của mã ưu đãi.">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <?php echo Form::number('value', !empty($detail) ? $detail->value : '', ['class' => 'form-control', 'autocomplete' => 'off', 'required']); ?>
                        </div>
                        <div class="mt-2">
                            <label class="form-label text-base font-semibold">Sử dụng kết hợp cùng các mã ưu đãi
                                khác</label>
                            <?php echo Form::select('individual_use', config('cart.individual_use'), !empty($detail) ? $detail->individual_use : '', ['class' => 'form-control ']); ?>
                        </div>
                        <div class="mt-2">
                            <label class="form-label text-base font-semibold  flex items-center">Ngày bắt đầu <a href="" class="text-primary tooltip" title="Phiếu giảm giá sẽ bắt đầu vào lúc 00:00:00">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <?php echo Form::text('date_start', !empty($detail) ? $detail->date_start : '', ['class' => 'form-control datepicker',  'autocomplete' => 'off']); ?>
                        </div>

                        <?php
                        if ($errors->any()) {
                            $expiry_date = old('expiry_date');
                        } else if ($action == 'update') {
                            $expiry_date = $detail->expiry_date;
                        }
                        ?>
                        <div class="d-flex mt-3 align-items-center">
                            <div class="me-1">
                                <?php if (isset($expiry_date) && $expiry_date == 1) { ?>
                                    <input type="checkbox" checked name="expiry_date" value="1" class="checkbox-item">
                                <?php } else { ?>
                                    <input type="checkbox" name="expiry_date" value="1" class="checkbox-item">
                                <?php } ?>
                            </div>
                            <span>
                                Ngày kết thúc
                            </span>
                        </div>
                        <div class="show_date_end mt-3" <?php if (isset($expiry_date) && $expiry_date == 1) { ?>style="display: block" <?php } else { ?> style="display: none" <?php } ?>>
                            <label class="form-label text-base font-semibold  flex items-center">Ngày kết thúc <a href="" class="text-primary tooltip" title="Phiếu giảm giá sẽ kết thúc vào lúc 00:00:00">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <?php echo Form::text('date_end', !empty($detail) ? $detail->date_end : '', ['class' => 'form-control datepicker',  'autocomplete' => 'off']); ?>
                        </div>

                    </div>
                    <div class="tab-pane" id="profile1" role="tabpanel">
                        <div>
                            <label class="form-label text-base font-semibold  flex items-center">Chi tiêu tối
                                thiểu<a href="" class="text-primary tooltip" title="Trường này cho phép bạn thiết lập giá trị đơn hàng tối thiểu để sử dụng các mã ưu đãi.">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <?php echo Form::text('min_price', !empty($detail) ? $detail->min_price : '', ['class' => 'form-control ', 'autocomplete' => 'off']); ?>
                        </div>
                        <div class="mt-2">
                            <label class="form-label text-base font-semibold  flex items-center">Chi tiêu tối
                                đa<a href="" class="text-primary tooltip" title="Trường này cho phép bạn thiết lập giá trị đơn hàng tối đa để sử dụng các mã ưu đãi.">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <?php echo Form::text('max_price', !empty($detail) ? $detail->max_price : '', ['class' => 'form-control ', 'autocomplete' => 'off']); ?>
                        </div>
                        <div class="mt-2">
                            <label class="form-label text-base font-semibold  flex items-center">Số lượng đơn
                                hàng tối thiểu<a href="" class="text-primary tooltip" title="Trường này cho phép bạn thiết lập số lượng đơn hàng tối thiểu để sử dụng các mã ưu đãi.">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <?php echo Form::text('min_count', !empty($detail) ? $detail->min_count : '', ['class' => 'form-control ', 'autocomplete' => 'off']); ?>
                        </div>
                        <div class="mt-2">
                            <label class="form-label text-base font-semibold  flex items-center">Số lượng đơn
                                hàng tối đa<a href="" class="text-primary tooltip" title="Trường này cho phép bạn thiết lập số lượng đơn hàng tối đa để sử dụng các mã ưu đãi.">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <?php echo Form::text('max_count', !empty($detail) ? $detail->max_count : '', ['class' => 'form-control ', 'autocomplete' => 'off']); ?>
                        </div>

                        <div class="mt-2">
                            <label class="form-label text-base font-semibold  flex items-center">Sản phẩm
                                <a href="" class="text-primary tooltip" title="Các sản phẩm được sử dụng mã ưu đãi, hoặc cần trong giỏ hàng để có thể áp dụng.">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <select id="product_ids" class="tom-select-field tom-select" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm.." data-module="products" name="product_ids[]" tabindex="-1" hidden="hidden">
                                <?php if (!empty($product_ids) && count($product_ids) > 0) { ?>
                                    <?php foreach ($product_ids as  $v) { ?>
                                        <option value="<?php echo $v->id ?>"> <?php echo $v->title ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label class=" form-label text-base font-semibold flex items-center">Danh mục sản phẩm <a href="" class="text-primary tooltip" title="Các danh mục sản phẩm được sử dụng mã ưu đãi, hoặc cần trong giỏ hàng để có thể áp dụng.">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <select id="product_categories" class="tom-select-product-category tom-select" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm.." data-module="products" name="product_categories[]" tabindex="-1" hidden="hidden">
                                <?php if (!empty($product_categories) && count($product_categories) > 0) { ?>
                                    <?php foreach ($product_categories as  $v) { ?>
                                        <option value="<?php echo $v->id ?>"> <?php echo $v->title ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="tab-pane" id="messages1" role="tabpanel">
                        <div>
                            <label class="form-label text-base font-semibold  flex items-center">Giới hạn sử
                                dụng cho mỗi mã giảm giá<a href="" class="text-primary tooltip" title="Mỗi mã ưu đãi được sử dụng bao nhiêu lần trước khi hết hạn.">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <?php echo Form::text('limit', !empty($detail) ? $detail->limit : '', ['class' => 'form-control ', 'autocomplete' => 'off']); ?>

                        </div>

                        <div class="mt-2">
                            <label class="form-label text-base font-semibold  flex items-center">Giới hạn sử
                                dụng trên mỗi người dùng<a href="" class="text-primary tooltip" title="Bao nhiêu lần mỗi mã ưu đãi có thể sử dụng bởi một khách hàng. Sử dụng địa chỉ email thanh toán cho khách không đăng nhập, và mã khách hàng nếu đã đăng nhập.">
                                    <i data-lucide="alert-circle" class="w-4 h-4 ml-2"></i></a></label>
                            <?php echo Form::text('limit_user', !empty($detail) ? $detail->limit_user : '', ['class' => 'form-control ', 'autocomplete' => 'off']); ?>

                        </div>
                    </div>

                </div>
            </div><!-- end card-body -->
        </div>

        <!-- END: Album Ảnh -->
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <!-- start: SEO -->
                    @include('components.seo')
                    <!-- end: SEO -->
                    <div class="text-right mt-5">
                        @if ($action == 'update')
                        <button type="submit" class="btn btn-primary">Cập nhập</button>
                        @else
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Form Layout -->
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    @include('components.image',['action' => $action,'name' => 'image','title'=> 'Ảnh đại diện'])
                    @include('components.publish')
                </div>
            </div>
        </div>
    </div>

</div>
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
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        },
        persist: false,
    });
    new TomSelect(".tom-select-product-category", {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        },
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        },
        persist: false,
    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
<script>
    $(document).on('click', '.checkbox-item', function() {
        var value = $(this).val();
        if (value == 1) {
            $('.show_date_end').show();
        }
    })
</script>
<style>
    #ui-datepicker-div {
        z-index: 9999999 !important;
    }
</style>
@endpush