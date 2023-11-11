
<?php $__env->startSection('title'); ?>
<title>Cấu hình hiển thị</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Cấu hình hiển thị",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Cấu hình hiển thị");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end p-2">

                <a href="<?php echo e(route('config_colums.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
            </div>
            <div class="px-2 mb-3">
                <form action="" class="row gy-2" id="search">
                    <?php if(!empty($table)): ?>
                    <div class="col-md-2">
                        <select class="form-control" name="module">
                            <option value="">Chọn module</option>
                            <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php if (request()->get('module') == $key) { ?>selected<?php } ?>><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-3">
                        <input type="search" name="keyword" class="keyword form-control filter" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="<?php echo request()->get('keyword') ?>">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-label waves-effect waves-light" type="submit">
                            <i class="ri-search-2-line label-icon align-middle fs-16 me-2"></i> Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TIÊU ĐỀ</th>
                            <th>Module</th>
                            <th>Type</th>
                            <th>Hiển thị</th>
                            <th>NGÀY TẠO</th>
                            <th class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">

                            <td>
                                <?php echo e($v->id); ?>

                            </td>
                            <td>
                                <?php echo $v->title; ?> (<?php echo count($v->postmetas) ?>)
                            </td>
                            <td>
                                <?php echo $table[$v->module]; ?>
                            </td>
                            <td>
                                <?php echo $v->type; ?>
                            </td>
                            <td class="w-40">
                                <?php echo $__env->make('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                                $v->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <td>
                                <?php if($v->created_at): ?>
                                <?php echo e(Carbon\Carbon::parse($v->created_at)->diffForHumans()); ?>

                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="<?php echo e(route('config_colums.edit',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                <?php if(count($v->postmetas) <= 0): ?> <a href="javascript:;" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-config-colums" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa page, trang sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> Delete
                                    </a>
                                    <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- end col -->
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<script type="text/javascript">
    $(document).on("click", ".ajax-delete-config-colums", function(e) {
        e.preventDefault();

        let _this = $(this);
        let param = {
            title: _this.attr("data-title"),
            id: _this.attr("data-id"),
        };
        let parent = _this.attr("data-parent"); /*Đây là khối mà sẽ ẩn sau khi xóa */
        swal({
                title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
                text: param.title,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Thực hiện!",
                cancelButtonText: "Hủy bỏ!",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(isConfirm) {
                if (isConfirm) {
                    let formURL = "<?php echo route('config_colums.destroy') ?>";
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        url: formURL,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            module: param.module,
                            id: param.id,
                            router: param.router,
                            child: param.child,
                        },
                        success: function(data) {
                            if (data.code === 200) {
                                if (typeof parent != "undefined") {
                                    _this
                                        .parents("." + parent + "")
                                        .hide()
                                        .remove();
                                } else {
                                    _this.parent().parent().parent().hide().remove();
                                }
                                if (param.child == 1) {
                                    $("#listData" + param.id).remove();
                                }
                                swal({
                                    title: "Xóa thành công!",
                                    text: "Hạng mục đã được xóa khỏi danh sách.",
                                    type: "success"
                                }, function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: "Có vấn đề xảy ra",
                                    text: "Vui lòng thử lại",
                                    type: "error"
                                }, function() {
                                    location.reload();
                                });
                            }
                        },
                        error: function(jqXhr, json, errorThrown) {
                            var errors = jqXhr.responseJSON;
                            var errorsHtml = "";
                            $.each(errors["errors"], function(index, value) {
                                errorsHtml += value + "/ ";
                            });
                            $("#myModal .alert").html(errorsHtml).show();
                        },
                    });
                } else {
                    swal({
                        title: "Hủy bỏ",
                        text: "Thao tác bị hủy bỏ",
                        type: "error"
                    }, function() {
                        location.reload();
                    });
                }
            }
        );
    });
    /*START: XÓA tất cả bản ghi */
    $(document).on('change', '.ajax-delete-all-config-colums', function() {
        let _this = $(this);
        let id_checked = []; /*Lấy id bản ghi */
        $('.checkbox-item:checked').each(function() {
            id_checked.push($(this).val());
        });
        if (id_checked.length <= 0) {
            swal({
                title: "Có vấn đề xảy ra",
                text: "Bạn phải chọn ít nhất 1 bản ghi để thực hiện chức năng này",
                type: "error"
            }, function() {
                location.reload();
            });
            return false;
        }
        let param = {
            'list': id_checked,
        }
        let parent = _this.attr('data-parent'); /*Đây là khối mà sẽ ẩn sau khi xóa */
        swal({
                title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
                text: param.title,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Thực hiện!",
                cancelButtonText: "Hủy bỏ!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo route('config_colums.delete_all') ?>',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            param: param
                        },
                        success: function(data) {
                            if (data.code == 200) {
                                setTimeout(function() {
                                    location.reload();
                                }, 1500);
                                for (let i = 0; i < id_checked.length; i++) {
                                    $('#post-' + id_checked[i]).hide().remove()
                                }
                                swal({
                                    title: "Xóa thành công!",
                                    text: "Các bản ghi đã được xóa khỏi danh sách.",
                                    type: "success"
                                }, function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: "Có vấn đề xảy ra",
                                    text: "Vui lòng thử lại",
                                    type: "error"
                                }, function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                } else {
                    swal({
                        title: "Hủy bỏ",
                        text: "Thao tác bị hủy bỏ",
                        type: "error"
                    }, function() {
                        location.reload();
                    });


                }
            });
    });
    /*END: XÓA tất cả bản ghi */
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/config/colums/index.blade.php ENDPATH**/ ?>