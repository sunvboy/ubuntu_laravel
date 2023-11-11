@extends('dashboard.layout.dashboard')

@section('title')
<title>Thêm mới giao diện</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách giao diện",
        "src" => route('users.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection

@section('content')

<div class="content">
    <div class=" flex items-center mt-8">
        <h1 class="text-lg font-medium mr-auto">
            Thêm mới
        </h1>
    </div>
    <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="{{route('websites.store')}}" method="post" enctype="multipart/form-data">
        <div class="col-span-8">
            <!-- BEGIN: Form Layout -->
            <div class=" box p-5">
                @include('components.alert-error')
                @csrf
                <div>
                    <label class="form-label text-base font-semibold">Tiêu đề</label>
                    <?php echo Form::text('type', request()->get('type'), ['class' => 'form-control w-full hidden']); ?>
                    <?php echo Form::text('title', '', ['class' => 'form-control w-full ']); ?>
                </div>
                <div class="mt-3">
                    <label class="form-label text-base font-semibold">Chọn loại giao diện</label>
                    <div class="mt-2">
                        <?php echo Form::select('keyword', $data, '', ['class' => 'form-control tom-select tom-select-custom', 'id' => 'js_keyword']); ?>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label text-base font-semibold">Chọn file</label>
                    <div class="mt-2">
                        <?php echo Form::select('template', [], '', ['class' => 'form-control', 'id' => 'js_file', 'placeholder' => '']); ?>
                    </div>
                </div>
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary w-24">Thêm mới</button>
                </div>
            </div>

        </div>
        <div class="col-span-4">
            <div class="box p-5 pt-3">
                <label class="form-label text-base font-semibold">Hình ảnh</label>
                <img src="<?php echo asset('images/404.png') ?>" id="mainThmb-image" class="'w-full" style="width:100%;height:270px;object-fit: cover;">
                <div class="flex gap-2 mt-3">
                    <div class="input-file-container w-full">
                        <input class="hidden input-file" id="my-image" onchange="mainThamUrl(this,'image')" name="image" type="file">
                        <label class="btn btn-dark w-full mr-2 mb-2 input-file-trigger" for="my-image">
                            Upload file...
                        </label>
                    </div>
                    <p class="file-return"></p>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
@push('javascript')
<script>
    var keyword = '<?php echo !empty(old('keyword')) ? old('keyword') : (!empty($detail->keyword) ? $detail->keyword : "") ?>';
    $(document).on('change', '#js_keyword', function(e, data) {
        let _this = $(this);
        let formURL = '<?php echo route('websites.folder') ?>';
        $.post(formURL, {
                'folder': _this.val(),
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                let json = JSON.parse(data);
                $('#js_file').html(json.html).trigger('change');
            });
    });
    if (typeof(keyword) != 'undefined' && keyword != '') {
        $('#js_keyword').val(keyword).trigger('change', [{
            'trigger': true
        }]);
    }

    /*lấy hình ảnh khi upload */
    function mainThamUrl(input, image) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb-' + image).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    /*lấy tên file khi upload ảnh xong*/
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $(this).parent().parent().find('.file-return').html('Select file image: ' + fileName);;
    });
</script>
@endpush