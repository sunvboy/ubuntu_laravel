

<?php $__env->startSection('title'); ?>

<title>Danh sách đơn đặt hộ</title>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

<?php

$array = array(

    [

        "title" => "Danh sách đơn đặt hộ",

        "src" => 'javascript:void(0)',

    ]

);

echo breadcrumb_backend($array, "Danh sách đơn đặt hộ");

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

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('carts_create')): ?>

                <!-- Buttons with Label -->

                <a href="<?php echo e(route('carts.create')); ?>" class="btn btn-primary btn-label waves-effect waves-light">

                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Thêm mới

                </a>

                <?php endif; ?>

            </div>

            <div class="px-2 mb-3">

                <form action="" class="row gy-2" id="search">



                    <div class="col-md-3">

                        <?php echo Form::select('customer_id', $customers, request()->get('customer_id'), ['class' => 'tom-select tom-select-field', 'data-placeholder' => "Select your favorite actors"]); ?>

                    </div>

                    <div class="col-md-2">

                        <?php echo Form::text('date_end', request()->get('date_end'), ['class' => 'form-control h-10',  'autocomplete' => 'off', 'placeholder' => 'Ngày đặt hàng']); ?>

                    </div>

                    <div class="col-md-2 d-none">

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

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('carts_destroy')): ?>

                            <th>

                                <input type="checkbox" id="checkbox-all" class="form-check-input">

                            </th>

                            <?php endif; ?>

                            <th>STT</th>

                            <th>Tên khách hàng</th>

                            <th>Ngày đặt</th>

                            <th>Ngày tạo</th>

                            <th>Người tạo</th>

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

                                <?php echo e(!empty($v->customer)?$v->customer->code .' - '.$v->customer->name:''); ?>


                            </td>

                            <td class="<?php if($v->date_end == $dateEnd): ?> fw-bold text-danger <?php endif; ?>">

                                <?php echo e($v->date_end); ?>


                            </td>

                            <td>

                                <?php echo e($v->created_at); ?>


                            </td>

                            <td>

                                <?php echo e(!empty($v->user)?$v->user->name:''); ?>


                            </td>

                            <td class="text-end">

                                <!-- <a href="<?php echo e(route('carts.show',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">

                                    <i class="ri-eye-2-line label-icon align-middle fs-16 me-2"></i> Xem

                                </a> -->

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('carts_create')): ?>

                                <?php if($v->date_end != $dateEnd): ?>

                                <a href="<?php echo e(route('carts.duplicate',['id'=>$v->id])); ?>" class="btn btn-success btn-label waves-effect waves-light d-none">

                                    <i class=" ri-file-copy-fill label-icon align-middle fs-16 me-2"></i> Đặt lại

                                </a>

                                <?php endif; ?>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('carts_edit')): ?>


                                <a href="<?php echo e(route('carts.edit',['id'=>$v->id])); ?>" class="btn btn-primary btn-label waves-effect waves-light">

                                    <i class="ri-file-edit-fill label-icon align-middle fs-16 me-2"></i> Edit

                                </a>


                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('carts_destroy')): ?>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js" integrity="sha512-+UiyfI4KyV1uypmEqz9cOIJNwye+u+S58/hSwKEAeUMViTTqM9/L4lqu8UxJzhmzGpms8PzFJDzEqXL9niHyjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script type="text/javascript">
    $(function() {

        $('input[name="date_end"]').datetimepicker({

            format: 'd-m-Y',

        });

    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('article.backend.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/cart/backend/index.blade.php ENDPATH**/ ?>