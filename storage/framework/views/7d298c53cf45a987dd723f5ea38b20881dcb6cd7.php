
<!--Start: title SEO -->
<?php $__env->startSection('title'); ?>
<title>Quản trị website</title>
<?php $__env->stopSection(); ?>
<!--END: title SEO -->
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Dashboard",
        "src" => route('admin.dashboard'),
    ]
);
echo breadcrumb_backend($array, $seo['meta_title']);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row project-wrapper">
    <div class="col-xxl-12">
        <div class="row">
            <div class="col-xl-12">
                <h2 class="fw-bold fs-4">Kiểm số lượng</h2>
            </div>
            <div class="col-xl-4">
                <!-- Table Dark -->
                <table class="table table-striped table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">Vào LIST</th>
                            <th scope="col">123</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nhận LIST</th>
                            <td>Bobby Davis</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>Bobby Davis</td>
                        </tr>
                        <tr>
                            <th>Cộng</th>
                            <td>Bobby Davis</td>
                        </tr>
                        <tr>
                            <th>Chênh lệch</th>
                            <td>Bobby Davis</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xl-4">
            </div>
        </div>
    </div><!-- end col -->
</div><!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<!-- highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>
    Highcharts.chart('container', {
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: 'Thống kê đơn hàng',
            align: 'left'
        },
        xAxis: [{
            categories: [<?php foreach ($data as $key => $val) { ?> '<?php echo $key ?>', <?php } ?>],
            crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: '',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            title: {
                text: '',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        series: [{
            name: 'Doanh số',
            type: 'column',
            yAxis: 1,
            data: [<?php foreach ($data as $key => $val) { ?><?php echo $val['y'] ?>, <?php } ?>],
            tooltip: {
                valueSuffix: ' đơn hàng'
            }
        }, {
            name: 'Doanh thu bán hàng',
            type: 'spline',
            data: [<?php foreach ($data as $key => $val) { ?><?php echo $val['x'] ?>, <?php } ?>],
            tooltip: {
                valueSuffix: 'đ'
            }
        }]
    });
</script>
<script>
    $(document).on('change', '#orderSearch', function() {
        let value = $(this).val();
        $.ajax({
            type: 'POST',
            url: "<?php echo route('admin.searchOrder') ?>",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                value: value
            },
            success: function(response) {
                const categories = Object.keys(response.data);
                let dataX = [];
                let dataY = [];
                $.each(response.data, function(i, val) {
                    dataX.push(val.x);
                });
                $.each(response.data, function(i, val) {
                    dataY.push(val.y);
                });
                Highcharts.chart('container', {
                    chart: {
                        zoomType: 'xy'
                    },
                    title: {
                        text: 'Thống kê đơn hàng',
                        align: 'left'
                    },
                    xAxis: [{
                        categories: categories,
                        crosshair: true
                    }],
                    yAxis: [{ // Primary yAxis
                        labels: {
                            format: '{value}',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        title: {
                            text: '',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        }
                    }, { // Secondary yAxis
                        title: {
                            text: '',
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        },
                        labels: {
                            format: '{value}',
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        },
                        opposite: true
                    }],
                    tooltip: {
                        shared: true
                    },
                    series: [{
                        name: 'Doanh số',
                        type: 'column',
                        yAxis: 1,
                        data: dataY,
                        tooltip: {
                            valueSuffix: ' đơn hàng'
                        }
                    }, {
                        name: 'Doanh thu bán hàng',
                        type: 'spline',
                        data: dataX,
                        tooltip: {
                            valueSuffix: 'đ'
                        }
                    }]
                });
            },
            error: function(jqXhr, json, errorThrown) {
                swal({
                    title: "ERROR",
                    text: "Lỗi hiển thị",
                    type: "error"
                });
            },
        });
        return false;
    });
</script>
<!-- Thống kê tình trạng -->
<script>
    Highcharts.chart('containerStatus', {
        chart: {
            type: 'variablepie'
        },
        title: {
            text: 'Tình trạng đơn hàng',
            align: 'left'
        },
        tooltip: {
            headerFormat: '',
            pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
                'Tổng tiền: <b>{point.y}</b><br/>' +
                'Số đơn hàng: <b>{point.z}</b><br/>'
        },
        series: [{
            minPointSize: 10,
            innerSize: '20%',
            zMin: 0,
            name: 'countries',
            data: [{
                    name: 'Chờ xác nhận',
                    y: <?php echo $returnStatus['wait'] ?>,
                    z: <?php echo $returnStatusCount['wait'] ?>
                }
                <?php if ($returnStatusCount['pending'] > 0) { ?>, {
                        name: 'Đang giao',
                        y: <?php echo $returnStatus['pending'] ?>,
                        z: <?php echo $returnStatusCount['pending'] ?>
                    }
                <?php } ?>
                <?php if ($returnStatusCount['completed'] > 0) { ?>, {
                        name: 'Đã giao',
                        y: <?php echo $returnStatus['completed'] ?>,
                        z: <?php echo $returnStatusCount['completed'] ?>
                    }
                    <?php } ?><?php if ($returnStatusCount['canceled'] > 0) { ?>, {
                        name: 'Đã hủy',
                        y: <?php echo $returnStatus['canceled'] ?>,
                        z: <?php echo $returnStatusCount['canceled'] ?>
                    }
                <?php } ?>
                <?php if ($returnStatusCount['returns'] > 0) { ?>, {
                        name: 'Trả hàng/Hoàn tiền',
                        y: <?php echo $returnStatus['returns'] ?>,
                        z: <?php echo $returnStatusCount['returns'] ?>
                    }
                <?php } ?>
            ]
        }]
    });
</script>
<script>
    $(document).on('change', '#orderSearchStatus', function() {
        let value = $(this).val();
        $.ajax({
            type: 'POST',
            url: "<?php echo route('admin.searchOrderStatus') ?>",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                value: value
            },
            success: function(response) {
                let returnStatus = response.returnStatus
                let returnStatusCount = response.returnStatusCount
                Highcharts.chart('containerStatus', {
                    chart: {
                        type: 'variablepie'
                    },
                    title: {
                        text: 'Tình trạng đơn hàng',
                        align: 'left'
                    },
                    tooltip: {
                        headerFormat: '',
                        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
                            'Tổng tiền: <b>{point.y}</b><br/>' +
                            'Số đơn hàng: <b>{point.z}</b><br/>'
                    },
                    series: [{
                        minPointSize: 10,
                        innerSize: '20%',
                        zMin: 0,
                        name: 'countries',
                        data: [{
                            name: 'Chờ xác nhận',
                            y: returnStatus.wait,
                            z: returnStatusCount.wait
                        }, {
                            name: 'Đang giao',
                            y: returnStatus.pending,
                            z: returnStatusCount.pending
                        }, {
                            name: 'Đã giao',
                            y: returnStatus.completed,
                            z: returnStatusCount.completed
                        }, {
                            name: 'Đã hủy',
                            y: returnStatus.canceled,
                            z: returnStatusCount.canceled
                        }, {
                            name: 'Trả hàng/Hoàn tiền',
                            y: returnStatus.returns,
                            z: returnStatusCount.returns
                        }]
                    }]
                });
            },
            error: function(jqXhr, json, errorThrown) {
                swal({
                    title: "ERROR",
                    text: "Lỗi hiển thị",
                    type: "error"
                });
            },
        });
        return false;
    });
</script>
<!--END Thống kê tình trạng -->
<!-- Sản phẩm bán chạy -->
<script>
    Highcharts.chart('containerProduct', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Sản phẩm bán chạy',
            align: 'left'
        },
        xAxis: {
            categories: [<?php if (!$topProductPayment->isEmpty()) { ?> <?php foreach ($topProductPayment as $item) { ?> '<?php echo $item->product_title ?>',
                    <?php } ?>
                <?php } ?>
            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Số lượng',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' sản phẩm'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Số lượng',
            data: [
                <?php if (!$topProductPayment->isEmpty()) { ?>
                    <?php foreach ($topProductPayment as $key => $item) { ?>
                        <?php echo (int)$item->quantity ?>,
                    <?php } ?>
                <?php } ?>
            ]
        }]
    });
</script>
<script>
    $(document).on('change', '#orderSearchProduct', function() {
        let value = $(this).val();
        $.ajax({
            type: 'POST',
            url: "<?php echo route('admin.searchOrderProduct') ?>",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                value: value
            },
            success: function(response) {
                let dataValue = [];
                let dataTitle = [];
                $.each(response.data, function(i, val) {
                    dataValue.push(parseFloat(val.quantity));
                });
                $.each(response.data, function(i, val) {
                    dataTitle.push(val.product_title);
                });
                Highcharts.chart('containerProduct', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Sản phẩm bán chạy',
                        align: 'left'
                    },
                    xAxis: {
                        categories: dataTitle,
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Số lượng',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' sản phẩm'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Số lượng',
                        data: dataValue
                    }]
                });
            },
            error: function(jqXhr, json, errorThrown) {
                swal({
                    title: "ERROR",
                    text: "Lỗi hiển thị",
                    type: "error"
                });
            },
        });
        return false;
    });
</script>
<!-- END:Sản phẩm bán chạy -->
<!-- end highcharts -->
<style>
    .highcharts-credits {
        display: none
    }
</style>
<?php $__env->stopPush(); ?>
<!--END: add css only index.html -->
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\order.local\resources\views/dashboard/home/index.blade.php ENDPATH**/ ?>