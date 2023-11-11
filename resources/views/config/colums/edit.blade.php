@extends('dashboard.layout.dashboard')
@section('title')
<title>Cập nhập </title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách ",
        "src" => route('config_colums.index'),
    ],
    [
        "title" => "Cập nhập",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
@section('content')
<form role="form" action="{{route('config_colums.update',['id' => $detail->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <label for="basiInput" class="form-label">Tiêu đề</label>
                        <?php echo Form::text('title', $detail->title, ['class' => 'form-control']); ?>
                    </div>
                    <div class="mt-3">
                        <label for="basiInput" class="form-label">Keyword(Ví dụ: name=[keyword])</label>
                        <?php echo Form::text('keyword', $detail->keyword, ['class' => 'form-control']); ?>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Module</label>
                        <?php echo Form::select('module', $table, $detail->module, ['class' => 'tom-select tom-select-field', 'data-placeholder' => ""]); ?>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Type</label>
                        <?php echo Form::select('type', $type, $detail->type, ['class' => 'tom-select tom-select-field-2', 'data-placeholder' => ""]); ?>
                    </div>
                    <?php
                    $content_item =  [];
                    $type = '';
                    if ($errors->any()) {
                        $content_item =  old('data');
                        $type = old('type');
                    } else {
                        $content_item =  json_decode($detail->data, TRUE);
                        $type = $detail->type;
                    }
                    ?>
                    <div class="mt-3" id="showItemJson" <?php if ($type == 'input' || $type == 'textarea' || $type == 'editor') { ?>style="display: none" <?php } ?>>
                        <label class="form-label text-base font-semibold">Add Item of type</label>
                        <div class="box">
                            <div id="schedule">
                                @if(isset($content_item['title']) && is_array($content_item['title']) &&
                                count($content_item['title']))
                                @foreach ($content_item['title'] as $key => $val)
                                <div class="mt-2 desc-more position-relative">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="data[title][]" value="<?php echo $val ?>" class="form-control" placeholder="Tiêu đề">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="data[keyword][]" value="<?php echo $content_item['keyword'][$key] ?>" class="form-control" placeholder="Keyword" <?php if ($type == 'select' || $type == 'checkbox' || $type == 'radio') { ?>style="display: none" <?php } ?>>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="data[type][]" <?php if ($type == 'select' || $type == 'checkbox' || $type == 'radio') { ?>style="display: none" <?php } ?>>
                                                <option value="image" <?php if ($content_item['type'][$key] == 'image') { ?>selected<?php } ?>>image</option>
                                                <option value="files" <?php if ($content_item['type'][$key] == 'files') { ?>selected<?php } ?>>files</option>
                                                <option value="input" <?php if ($content_item['type'][$key] == 'input') { ?>selected<?php } ?>>input</option>
                                                <option value="textarea" <?php if ($content_item['type'][$key] == 'textarea') { ?>selected<?php } ?>>textarea</option>
                                                <option value="editor" <?php if ($content_item['type'][$key] == 'editor') { ?>selected<?php } ?>>editor</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-danger text-white delete-attr position-absolute" type="button" style="right:0px;top: 50%;transform: translateY(-50%);width: 50px;height: 38px;display: flex;justify-content: center;align-items: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 ">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <a href="javascript:void(0)" class="add-schedule btn btn-success text-white" onclick="return false;">Thêm mới +</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-2">
                        <button type="submit" class="btn btn-primary btn-submit">Thêm mới</button>
                    </div>
                </div><!-- end card-body -->

            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
</form>
@endsection
@push('javascript')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect(".tom-select-field", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect(".tom-select-field-2", {});
</script>
<script>
    $(document).ready(function() {
        $(document).on('change', 'select[name="type"]', function() {
            var value = $(this).val();
            var check = $('input[name="data[title][]"]').length;
            if (value == 'json') {
                $('input[name="data[keyword][]"]').show();
                $('select[name="data[type][]"]').show();
                if (check == 0) {
                    render_schedule();
                }
                $('#showItemJson').show();
            } else if (value == 'select' || value == 'radio' || value == 'checkbox') {
                $('input[name="data[keyword][]"]').hide();
                $('select[name="data[type][]"]').hide();
                if (check == 0) {
                    render_schedule();
                }
                $('#showItemJson').show();
            } else {
                $('#showItemJson').hide();
            }
        })
    })
</script>
<script>
    $(document).on('click', '.add-schedule', function() {
        let _this = $(this);
        render_schedule();
    })

    function render_schedule() {
        let html = '';
        var microtime = (Date.now() % 1000) / 1000;
        var editorId = 'editor_' + microtime;
        html = html + '<div class="mt-2 desc-more position-relative">'
        html = html + '<div class="row">'
        html = html + '<div class="w-full col-md-3">'
        html = html + '<input type="text" name="data[title][]" class="form-control" placeholder="Tiêu đề">'
        html = html + '</div>'
        html = html + '<div class="w-full col-md-3">'
        html = html + '<input type="text" name="data[keyword][]" class="form-control" placeholder="Keyword">'
        html = html + '</div>'

        html = html + '<div class="w-full col-md-3">'
        html = html + '<select name="data[type][]" class="form-control"><option value="image">image</option><option value="files">files</option><option value="input">input</option><option value="textarea">textarea</option><option value="editor">editor</option></select>'
        html = html + '</div>'


        html = html + '</div>'
        html = html + '<button class="btn btn-danger text-white delete-attr" type="button" style="position: absolute;right:0px;top: 50%;transform: translateY(-50%);width: 50px;height: 38px;display: flex;justify-content: center;align-items: center;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 "><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>'
        html = html + '</div>'
        html = html + '</div>';
        $('#schedule').append(html);
        var type = $('select[name="type"] option:selected').val();
        if (type == 'select' || type == 'radio' || type == 'checkbox') {
            $('input[name="data[keyword][]"]').hide();
            $('select[name="data[type][]"]').hide();
        }
    }
    $(document).on('click', '.delete-attr', function() {
        let _this = $(this);
        _this.parents('.desc-more').remove();
    });
    $(document).on('click', '.btn-submit', function() {
        var type = $('select[name="type"] option:selected').val();
        var check = 0;
        if (type == 'json') {
            $("input[name='data[keyword][]']").each(function(index) {
                if ($(this).val() == '') {
                    $("input[name='data[keyword][]']").eq(index).css('border', '1px solid red');
                    check = 1;
                } else {
                    $("input[name='data[keyword][]']").eq(index).css('border', '0px');
                }
            });
            $("input[name='data[title][]']").each(function(index) {
                if ($(this).val() == '') {
                    $("input[name='data[title][]']").eq(index).css('border', '1px solid red');
                    check = 1;
                } else {
                    $("input[name='data[title][]']").eq(index).css('border', '0px');
                }
            });
        }
        if (type == 'select' || type == 'radio' || type == 'checkbox') {
            $("input[name='data[title][]']").each(function(index) {
                if ($(this).val() == '') {
                    $("input[name='data[title][]']").eq(index).css('border', '1px solid red');
                    check = 1;
                } else {
                    $("input[name='data[title][]']").eq(index).css('border', '0px');
                }
            });
        }
        if (check == 1) {
            return false;
        } else {
            return true;
        }
    })
</script>
@endpush