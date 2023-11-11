<?php $__env->startSection('title'); ?>
<title>Danh sách comment</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách comment",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Danh sách comment");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $array_star = ['' => 'Đánh giá', '1' => '1 sao', '2' => '2 sao', '3' => '3 sao', '4' => '4 sao', '5' => '5 sao',]; ?>
<?php $array_module = ['' => 'Chọn module', 'articles' => 'Bài viết', 'products' => 'Sản phẩm']; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between p-2">
                <button id="ajax-delete-all" disabled="true" type="button" class="btn btn-danger btn-label waves-effect waves-light ajax-delete-all fs-sm-14" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="<?php echo e($module); ?>">
                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> <span class="">Xóa tất cả</span>
                </button>
            </div>
            <div class="px-2 mb-3">
                <form action="" class="row gy-2" id="search">
                    <div class="col-md-2">
                        <?php echo Form::select('rating', $array_star, request()->get('rating'), ['class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-2 hidden">
                        <?php echo Form::select('module', $array_module, request()->get('module'), ['class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-2">
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brands_destroy')): ?>
                            <th>
                                <input type="checkbox" id="checkbox-all" class="form-check-input">
                            </th>
                            <?php endif; ?>
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Module</th>
                            <th>Chủ đề</th>
                            <th>Đánh giá</th>
                            <th>Hiển thị</th>
                            <th class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd align-middle" id="post-<?php echo $v->id; ?>">
                            <td>
                                <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item form-check-input">
                            </td>
                            <td><?php echo e($data->firstItem()+$loop->index); ?></td>
                            <td>
                                <?php echo  $v->fullname; ?>
                                <br> <?php echo e($v->phone); ?>

                                <br> <?php echo e($v->created_at); ?>

                            </td>

                            <td>
                                <?php echo e($v->module); ?>

                            </td>
                            <td>
                                <?php if($v->module == 'tours'): ?>
                                <?php if(!empty($v->tour)): ?>
                                <a href="<?php echo e(route('routerURL',['slug' => $v->tour->slug])); ?>" class="text-primary" target="_blank"><?php echo e($v->tour->title); ?></a>
                                <?php endif; ?>
                                <?php elseif($v->module == 'products'): ?>
                                <?php if(!empty($v->product)): ?>
                                <a href="<?php echo e(route('routerURL',['slug' => $v->product->slug])); ?>" class="text-primary" target="_blank"><?php echo e($v->product->title); ?></a>
                                <?php endif; ?>
                                <?php elseif($v->module == 'articles'): ?>
                                <?php if(!empty($v->article)): ?>
                                <a href="<?php echo e(route('routerURL',['slug' => $v->article->slug])); ?>" class="text-primary" target="_blank"><?php echo e($v->article->title); ?></a>
                                <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <?php for ($i = 1; $i <= $v->rating; $i++) { ?>
                                        <i data-lucide="star" class="ri-star-s-fill fs-16" style="color:#ea9d02;fill:#ea9d02;"></i>
                                    <?php } ?>
                                    <?php for ($i = 1; $i <= 5 - $v->rating; $i++) { ?>
                                        <i data-lucide="star" class="ri-star-line fs-16" style="color:#ea9d02"></i>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                                <?php echo $__env->make('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                                $v->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <td class="text-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('comments_edit')): ?>
                                <a href="<?php echo e(route('comments.edit',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('comments_destroy')): ?>
                                <a class="btn btn-danger btn-label waves-effect waves-light ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa bài viết, bài viết sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> Delete
                                </a>
                                <?php endif; ?>
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
<?php $__env->startPush('javascript'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/comment/backend/index.blade.php ENDPATH**/ ?>