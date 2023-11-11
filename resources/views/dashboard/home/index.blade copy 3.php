@extends('dashboard.layout.dashboard')
<!--Start: title SEO -->
@section('title')
<title>Quản trị website</title>
@endsection
<!--END: title SEO -->
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Dashboard",
        "src" => route('admin.dashboard'),
    ]
);
echo breadcrumb_backend($array, $seo['meta_title']);
?>
@endsection
@section('content')
<div class="row project-wrapper">
    <div class="col-xxl-12">
        <div class="row">
            <div class="col-xl-4">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                    <i data-feather="briefcase" class="text-primary"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-3">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Active Projects</p>
                                <div class="d-flex align-items-center mb-3">
                                    <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="825">0</span></h4>
                                    <span class="badge bg-danger-subtle text-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02 %</span>
                                </div>
                                <p class="text-muted text-truncate mb-0">Projects this month</p>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div><!-- end col -->
            <div class="col-xl-4">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                    <i data-feather="award" class="text-warning"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-medium text-muted mb-3">New Leads</p>
                                <div class="d-flex align-items-center mb-3">
                                    <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="7522">0</span></h4>
                                    <span class="badge bg-success-subtle text-success fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58 %</span>
                                </div>
                                <p class="text-muted mb-0">Leads this month</p>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div><!-- end col -->
            <div class="col-xl-4">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-info-subtle text-info rounded-2 fs-2">
                                    <i data-feather="clock" class="text-info"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-3">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Hours</p>
                                <div class="d-flex align-items-center mb-3">
                                    <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="168">0</span>h <span class="counter-value" data-target="40">0</span>m</h4>
                                    <span class="badge bg-danger-subtle text-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35 %</span>
                                </div>
                                <p class="text-muted text-truncate mb-0">Work this month</p>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Projects Overview</h4>
                        <div>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                ALL
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1M
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                6M
                            </button>
                            <button type="button" class="btn btn-soft-primary btn-sm">
                                1Y
                            </button>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-header p-0 border-0 bg-light-subtle">
                        <div class="row g-0 text-center">
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="9851">0</span></h5>
                                    <p class="text-muted mb-0">Number of Projects</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="1026">0</span></h5>
                                    <p class="text-muted mb-0">Active Projects</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1">$<span class="counter-value" data-target="228.89">0</span>k</h5>
                                    <p class="text-muted mb-0">Revenue</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0 border-end-0">
                                    <h5 class="mb-1 text-success"><span class="counter-value" data-target="10589">0</span>h</h5>
                                    <p class="text-muted mb-0">Working Hours</p>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body p-0 pb-2">
                        <div>
                            <div id="projects-overview-chart" data-colors='["--vz-primary", "--vz-warning", "--vz-success"]' dir="ltr" class="apex-charts"></div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end col -->
</div><!-- end row -->
@endsection
@push('javascript')
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
@endpush
<!--END: add css only index.html -->