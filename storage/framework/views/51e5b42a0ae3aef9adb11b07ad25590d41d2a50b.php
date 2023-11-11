<?php $__env->startSection('title'); ?>
<title>Chi tiết comment</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>

<?php
$title = '';
if ($detail->module == 'products') {
    if (!empty($detail->product)) {
        $title = 'sản phẩm :<a href="' . route('routerURL', ['slug' => $detail->product->slug]) . '" class="text-primary" style="color: rgb(11, 116, 229);" target="_blank">' . $detail->product->title . '</a>';
    }
} elseif ($detail->module == 'articles') {
    if (!empty($detail->article)) {
        $title = 'bài viết :<a href="' . route('routerURL', ['slug' => $detail->product->slug]) . '" class="text-primary" style="color: rgb(11, 116, 229);" target="_blank">' . $detail->product->title . '</a>';
    }
}


$array = array(
    [
        "title" => "Danh sách comment",
        "src" => route('comments.index'),
    ],
    [
        "title" => "Chi tiết comment",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array, "Chi tiết comment $title");
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<style>
    /* review_images */
    .review-images__heading {
        margin: 0px 0px 16px;
        font-size: 17px;
        line-height: 24px;
        font-weight: 500;
    }



    .review-images__item {
        width: 120px;
        height: 120px;
        margin: 0px 16px 0px 0px;
        cursor: pointer;
        max-width: 100%;
    }

    .review-images__img {
        background-size: cover;
        border-radius: 4px;
        height: 100%;
        width: 100%;
        background-position: center center;
    }

    .review-images__item:last-child {
        position: relative;
        z-index: 1;
        margin: 0px;
    }

    .review-images__total {
        background-color: rgba(36, 36, 36, 0.7);
        font-size: 17px;
        font-weight: 500;
        position: absolute;
        inset: 0px;
        line-height: 120px;
        text-align: center;
        color: rgb(255, 255, 255);
        border-radius: 4px;
    }

    .write_review_buttons {
        flex: 1 1 0%;
        align-items: flex-end;
        display: flex;
        -webkit-box-pack: justify;
        justify-content: space-between;
        padding: 0px 0px 16px;
        margin: 0px;
    }

    .write-review__input {
        border: 1px solid rgb(238, 238, 238);
        padding: 12px;
        border-radius: 4px;
        resize: none;
        width: 100%;
        outline: 0px;
        margin: 12px 0px 12px;
    }

    .write_review_file {
        position: absolute;
        height: 0px;
        width: 0px;
        visibility: hidden;
        opacity: 0;
        clip: rect(0px, 0px, 0px, 0px);
    }

    .write-review__button {
        width: 49%;
        height: 36px;
        border: 0px;
        background: 0px center;
        padding: 0px;
        line-height: 36px;
        cursor: pointer;
        border-radius: 4px;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        align-items: center;
        outline: 0px;
    }

    .write-review__button--image {
        color: rgb(11, 116, 229);
        border: 1px solid rgb(11, 116, 229);
    }

    .write-review__button--image img {
        width: 15px;
        margin: 0px 4px 0px 0px;
    }

    .write-review__button--submit {
        background-color: rgb(11, 116, 229);
        color: rgb(255, 255, 255);
    }

    .write_review_images {
        text-align: left;
        margin: 0px 0px 12px;
    }

    .write-review__image {
        display: inline-block;
        width: 48px;
        height: 48px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        margin: 0px 12px 0px 0px;
        border: 1px solid rgb(224, 224, 224);
        border-radius: 4px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .write-review__image-close {
        width: 21px;
        height: 21px;
        background-color: rgb(255, 255, 255);
        border-radius: 50%;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        line-height: 21px;
        font-size: 18px;
        display: none;
        text-align: center;
    }

    .write-review__image:hover .js_delete_image_cmt {
        display: block;
    }

    .write-review__image:hover::after {
        content: "";
        position: absolute;
        inset: 0px;
        background-color: rgba(36, 36, 36, 0.7);
    }

    .write-review__info {
        flex: 1 1 0%;
        align-items: flex-end;
        display: flex;
        -webkit-box-pack: justify;
        justify-content: space-between;
        margin: 12px 0px 0px;
    }

    .write-review__info input {
        width: 49%;
        height: 36px;
        background: 0px center;

        line-height: 36px;
        cursor: pointer;
        border-radius: 4px;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        align-items: center;
        outline: 0px;
    }

    .fa.fa-star-o,
    .fa.fa-star {
        color: #fbc634 !important;
        font-size: 30px;
    }

    .js_delete_image_cmt {
        width: 21px;
        height: 21px;
        background-color: rgb(255, 255, 255);
        border-radius: 50%;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        line-height: 21px;
        font-size: 18px;
        display: none;
        text-align: center;
    }
</style>
<script>
    //upload image comment
    var inputFile = $('input.write_review_file');
    var uploadURI = '<?php echo route('commentFrontend.uploadImagesCmt') ?>';
    var processBar = $('#progress-bar');
    $('input.write_review_file').change(function(event) {
        var filesToUpload = inputFile[0].files;
        if (filesToUpload.length > 0) {
            var formData = new FormData();
            for (var i = 0; i < filesToUpload.length; i++) {
                var file = filesToUpload[i];
                formData.append('file[]', file, file.name);
            }
            // console.log(formData);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: uploadURI,
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('.error_comment').removeClass('alert alert-danger');
                    $('.write_review_images').show();
                    var json = JSON.parse(data);
                    $('.write_review_images').append(json.html);
                    load_src_img();
                },
                error: function(jqXhr, json, errorThrown) {
                    // this are default for ajax errors
                    var errors = jqXhr.responseJSON;
                    $('.error_comment').removeClass('alert alert-success').addClass(
                        'alert alert-danger');
                    $('.error_comment').html('').html(errors.message);
                },
            });
        }
    });

    function load_src_img() {
        var outputText = '';
        $('.write_review_images img').each(function() {
            var divHtml = $(this).attr('src');
            outputText += divHtml + '-+-';
        });
        $('#form-comment input[name="images"]').attr('value', outputText.slice(0, -3));
    }

    $(document).on('click', '.write-review__image-close', function() {
        var me = $(this);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            url: uploadURI,
            type: 'post',
            data: {
                file: me.attr('data-file'),
                delete: 'delete'
            },
            success: function() {
                $('.error_comment').removeClass('alert alert-danger').removeClass('alert alert-danger');
                me.parent().remove();
                load_src_img();
            },
            error: function(jqXhr, json, errorThrown) {
                // this are default for ajax errors
                var errors = jqXhr.responseJSON;
                var errorsHtml = "";
                $.each(errors["errors"], function(index, value) {
                    errorsHtml += value + "/ ";
                });
                $('.error_comment').removeClass('alert alert-success').addClass('alert alert-danger');
                $(".error_comment").html(errorsHtml).show();
            },
        });
    });
    $(document).on('click', '.write-review__button--image', function(e) {
        $(".write_review_file").click();
    });
    //end upload images
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/comment/backend/edit.blade.php ENDPATH**/ ?>