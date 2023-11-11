<?php $__env->startSection('title'); ?>
<title>Quản lý Banner & Slide</title>
<?php $__env->stopSection(); ?>
<!--START: breadcrumb -->
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách slide",
        "src" => route('slides.index'),
    ]
);
echo breadcrumb_backend($array, "Danh sách slide");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="row mt-3">
    <div class="col-md-4 col-lg-3">
        <div class="card">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager">
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basic-modal-upload-image" class="btn btn-primary btn-block btn-upload w-100">Upload hình ảnh</a>
                        <div class="hr-line-dashed"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 style="font-weight: bold;">Nhóm Slide</h5>
                            <?php if(env('APP_ENV') == "local"): ?>
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basic-modal-add-group">+ Thêm mới</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <ul class="folder-list" id="folder-list" style="padding: 0">
                        <?php $__currentLoopData = $slideGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mt-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="javascript:void(0)" class="slide-catalogue" data-id="<?php echo e($v->id); ?>"><?php echo e($v->title); ?>

                                </a>
                                <div>
                                    <a type="button" class="slide-group-edit text-danger mr-2" href="javascript:void(0)" data-id="<?php echo e($v->id); ?>" data-title="<?php echo e($v->title); ?>" data-bs-toggle="modal" data-bs-target="#basic-modal-edit-group"> Sửa</a>
                                    <?php if(env('APP_ENV') == "local"): ?>
                                    <a type="button" class="slide-group-delete ajax-delete text-danger" href="javascript:void(0)" data-title="Lưu ý: Dữ liệu sẽ không thể khôi phục. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!" data-module="category_slides" data-id="<?php echo e($v->id); ?>" data-child="1" style="color:#676a6c;"> Xóa</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-md-8 col-lg-9">
        <?php $__currentLoopData = $slideGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($val->slides) > 0): ?>
        <div class="row" id="listData<?php echo e($val->id); ?>">
            <h2 class="mb-3" style="font-size: 20px;font-weight: bold;">
                <?php echo e($val->title); ?>

            </h2>
            <div class="row">
                <?php $__currentLoopData = $val->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <img src="<?php echo $v->src; ?>" class="card-img-top object-fit-contain" alt="..." style="height: 150px;background: #eeeeee;">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: 700;font-size: 15px;"> <?php echo (!empty($v->title)) ? $v->title : '-'; ?></h5>
                            <p class="card-text"><?php echo (!empty($v->description)) ? $v->description : '-'; ?></p>
                            <div class="d-flex">
                                <a href="javascript:void(0)" data-json="<?php echo base64_encode(json_encode($v)) ?>" data-bs-toggle="modal" data-bs-target="#basic-modal-edit-slide" data-id="<?php echo $v->id; ?>" class="edit-slide btn btn-primary stretched-link">Chỉnh sửa</a>
                                <a href="javascript:void(0)" type="button" data-parent="file-box" data-title="Lưu ý: Dữ liệu sẽ không thể khôi phục. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!" data-module="slides" data-id="<?php echo $v->id; ?>" class="btn btn-danger stretched-link ms-1 ajax-delete">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <hr>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <!--end col-->
</div>
<!-- Default Modals -->
<!--START: add group slide -->
<div class="modal inmodal" id="basic-modal-add-group" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="monitor" data-lucide="monitor" style="height:94px;width:100px;color:#dddddd" class="lucide lucide-monitor">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>

                <h4 class="modal-title mb-1">Thêm mới nhóm Banner &amp; Slide</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible bg-danger text-white alert-label-icon fade show mb-3" role="alert" style="display: none;">
                    <i class="ri-error-warning-line label-icon"></i><strong>ERROR</strong>
                    <span class="title_error"></span>
                </div>
                <form class="m-t slide-group" role="form" method="post" action="<?php echo e(route('slides.category_store')); ?>">
                    <div class="form-group">
                        <label class="form-label text-base font-semibold">Tên nhóm Slide</label>
                        <input type="text" placeholder="" id="title" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label text-base font-semibold">Từ khóa</label>
                        <input type="text" placeholder="" id="keyword" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-group">Tạo mới</button>
            </div>
        </div>
    </div>
</div>
<!--END: add group slide -->
<!--START: edit group slide -->
<div class="modal inmodal" id="basic-modal-edit-group" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="monitor" data-lucide="monitor" style="height:94px;width:100px;color:#dddddd" class="lucide lucide-monitor">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>

                <h4 class="modal-title mb-1">Sửa nhóm Banner &amp; Slide</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible bg-danger text-white alert-label-icon fade show mb-3" role="alert" style="display: none;">
                    <i class="ri-error-warning-line label-icon"></i><strong>ERROR</strong>
                    <span class="title_error"></span>
                </div>
                <form class="m-t slide-group" role="form" method="post" action="<?php echo e(route('slides.category_update')); ?>">
                    <div class="form-group">
                        <label class="form-label text-base font-semibold">Tên nhóm Slide</label>
                        <input type="text" placeholder="" class="title form-control" class="form-control">
                        <input type="hidden" placeholder="" class="id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary edit-group">Cập nhập</button>
            </div>
        </div>
    </div>
</div>
<!--END: add edit slide -->
<!--START: upload image to slide group -->
<div id="basic-modal-upload-image" class="modal inmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content animated fadeIn">
            <div class="modal-header space-y-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="monitor" data-lucide="monitor" style="height:94px;width:100px;color:#dddddd" class="lucide lucide-monitor">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
                <h4 class="modal-title mb-1">Upload hình ảnh</h4>
                <small class="font-bold">Kích thước banner hiển thị tốt nhất <span class="text-danger" style="font-size:16px;">1920x760</span> pixel, các banner nên có kích thước bằng
                    nhau.</small>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible bg-danger text-white alert-label-icon fade show mb-3" role="alert" style="display: none;">
                    <i class="ri-error-warning-line label-icon"></i><strong>ERROR</strong>
                    <span class="title_error"></span>
                </div>
                <form class="m-t slide-group" role="form" method="post" action="">
                    <div class="form-group flex items-center">
                        <label style="width:110px;margin-right:10px;">Chọn nhóm slide</label>
                        <div class="col-sm-6">
                            <select name="catalogueid" class="form-control catalogueid">
                                <option value="0">[Chọn nhóm slide]</option>
                                <?php $__currentLoopData = $slideGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($v->id); ?>"><?php echo e($v->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="text-right" style="margin-bottom:5px;"><a onclick="openKCFinderSlide(this);return false;" href="javascript:void(0)" title="" class="upload-picture text-primary">Chọn hình</a></div>
                    <div class="click-to-upload ">
                        <div class="icon">
                            <a type="button" class="upload-picture" onclick="openKCFinderSlide(this);return false;">
                                <svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                    <path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <div class="small-text">Sử dụng nút <b>Chọn hình</b> để thêm hình.</div>
                    </div>
                    <div class="upload-list" style="padding: 5px; margin-top: 15px; display: none;">
                        <div class="row">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-slide">Tạo mới</button>
            </div>
        </div>
    </div>
</div>
<!--END: upload image to slide group -->
<!--START: edit slide -->
<div id="basic-modal-edit-slide" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Cập nhập Banner &amp; Slide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger-soft show flex items-center mb-5" role="alert" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="alert-octagon" data-lucide="alert-octagon" class="lucide lucide-alert-octagon w-6 h-6 mr-2">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                        </polygon>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span class="title_error"></span>
                </div>
                <form class="m-t update-group" role="form" method="post" action="">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update-slide">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
<!--END: edit slide -->
<style>
    #basic-modal-edit-slide .img-thumbnail {
        width: 100%;
        height: 100%;
    }
</style>
<?php echo $__env->make('slide.backend.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('slide.backend.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/slide/backend/index.blade.php ENDPATH**/ ?>