<?php $__env->startSection('title'); ?>
<title>Danh sách bài viết</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách bài viết",
        "src" => route('articles.index'),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách bài viết");

?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between p-2">
                <button id="ajax-delete-all" disabled="true" type="button" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-all fs-sm-14" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="<?php echo e($module); ?>">
                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> <span class="">Xóa tất cả</span>
                </button>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('articles_create')): ?>
                <!-- Buttons with Label -->
                <a href="<?php echo e(route('articles.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới
                </a>
                <?php endif; ?>
            </div>
            <div class="px-2 mb-3">
                <form action="" class="row gy-2" id="search">
                    <?php if(isset($htmlOption)): ?>
                    <div class="col-md-3">
                        <?php echo Form::select('catalogueid', $htmlOption, request()->get('catalogueid'), ['id' => 'select-beast', 'class' => 'tom-select tom-select-field', 'data-placeholder' => "Select your favorite actors"]); ?>
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('articles_destroy')): ?>
                            <th>
                                <input type="checkbox" id="checkbox-all" class="form-check-input">
                            </th>
                            <?php endif; ?>
                            <th>STT</th>
                            <th>TIÊU ĐỀ</th>
                            <th>VỊ TRÍ</th>
                            <th>NGƯỜI TẠO</th>
                            <th>HIỂN THỊ</th>
                            <?php echo $__env->make('components.table.is_thead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <th class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('articles_destroy')): ?>
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                            </td>
                            <?php endif; ?>
                            <td>
                                <?php echo e($data->firstItem()+$loop->index); ?>

                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="image-fit zoom-in me-2" style="width: 40px;height: 40px;">
                                        <img class="rounded-circle" style="width: 40px;height: 40px;" src="<?php echo e(File::exists(base_path($v->image)) ? getImageUrl($module,$v->image,'small') : asset('images/404.png')); ?>">
                                    </div>
                                    <div class="flex-1">
                                        <a href="<?php echo e(route('routerURL',['slug' => $v->slug])); ?>" target="_blank" class=" text-primary font-medium"><?php echo $v->title; ?></a>
                                        <div>
                                            <?php $__currentLoopData = $v->relationships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kc=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a class="text-danger" href="<?php echo e(route('articles.index',['catalogueid' => $c->id])); ?>"><?php echo !empty($kc == 0) ? '' : ',' ?><?php echo e($c->title); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <?php echo $__env->make('components.order',['module' => $module], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <td>
                                <?php echo e($v->user->name); ?><br>
                                <?php if($v->created_at): ?>
                                <i><?php echo e(Carbon\Carbon::parse($v->created_at)->diffForHumans()); ?></i>
                                <?php endif; ?>
                            </td>
                            <td class="w-40">
                                <?php echo $__env->make('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                                $v->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <?php echo $__env->make('components.table.is_tbody', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <td class="text-end">
                                <a href="<?php echo e(route('routerURL',['slug' => $v->slug])); ?>" class="btn btn-primary btn-label waves-effect waves-light" target="_blank">
                                    <i class="ri-eye-fill label-icon align-middle fs-16 me-2"></i> Xem trước
                                </a>
                                <div class="mt-1">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('articles_edit')): ?>
                                    <a href="<?php echo e(route('articles.edit',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                                        <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('articles_destroy')): ?>
                                    <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa bài viết, bài viết sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                        <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> Delete
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3 px-3">
                <?php echo e($data->links()); ?>

            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('article.backend.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/article/backend/article/index.blade.php ENDPATH**/ ?>