<?php $__env->startPush('javascript'); ?>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<script>
    new TomSelect(".tom-select-field", {

        plugins: {

            remove_button: {

                title: 'Remove this item',

            }

        },

        persist: false,

        create: true,

        sortField: {

            field: "text",

            direction: "asc"

        }

    });

    new TomSelect(".tom-select-multiple", {

        plugins: {

            remove_button: {

                title: 'Remove this item',

            }

        },

        persist: false,

        create: true,

    });

    new TomSelect(".tom-select-tag", {

        plugins: {

            remove_button: {

                title: 'Remove this item',

            }

        },

        persist: false,

        create: true,

    });
</script>

<?php $__env->stopPush(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/article/backend/script.blade.php ENDPATH**/ ?>