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
echo breadcrumb_backend($array);
?>
@endsection
<!--Start: add javascript only index.html -->
@section('css-dashboard')

@endsection
<!--END: add javascript only index.html -->

<!-- START: main -->
@section('content')
<<div class="content">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-6">
                    <div class=" report-box mt-12 sm:mt-4">
                        <div class="box py-0 xl:py-5 grid grid-cols-4 gap-0 divide-y xl:divide-y-0 divide-x divide-dashed divide-slate-200 dark:divide-white/5">
                            <?php if (in_array('orders', $dropdown)) { ?>
                                <div class="report-box__item py-5 xl:py-0 px-5 ">
                                    <a href="{{route('orders.index')}}" class="report-box__content">
                                        <div class="flex">
                                            <div class="report-box__item__icon text-warning bg-warning/20 border border-warning/20 flex items-center justify-center rounded-full">
                                                <i data-lucide="shopping-bag"></i>
                                            </div>
                                        </div>
                                        <div class="text-2xl font-medium leading-7 mt-6">{{$totalOrder}}</div>
                                        <div class="text-slate-500 mt-1">Đơn hàng</div>
                                    </a>
                                </div>
                            <?php } ?>
                            <?php if (in_array('products', $dropdown)) { ?>
                                <div class="report-box__item py-5 xl:py-0 px-5 ">
                                    <a href="{{route('products.index')}}" class="report-box__content">
                                        <div class="flex">
                                            <div class="report-box__item__icon text-warning bg-warning/20 border border-warning/20 flex items-center justify-center rounded-full">
                                                <i data-lucide="shopping-bag"></i>
                                            </div>
                                        </div>
                                        <div class="text-2xl font-medium leading-7 mt-6">{{$totalProduct}}</div>
                                        <div class="text-slate-500 mt-1">Sản phẩm</div>
                                    </a>
                                </div>
                            <?php } ?>
                            <?php if (in_array('articles', $dropdown)) { ?>
                                <div class="report-box__item py-5 xl:py-0 px-5 sm:!border-t-0">
                                    <a href="{{route('articles.index')}}" class="report-box__content">
                                        <div class="flex">
                                            <div class="report-box__item__icon text-pending bg-pending/20 border border-pending/20 flex items-center justify-center rounded-full">
                                                <i data-lucide="credit-card"></i>
                                            </div>
                                        </div>
                                        <div class="text-2xl font-medium leading-7 mt-6">{{$totalArticle}}</div>
                                        <div class="text-slate-500 mt-1">Bài viết</div>
                                    </a>
                                </div>
                            <?php } ?>
                            <?php if (in_array('contacts', $dropdown)) { ?>
                                <div class="report-box__item py-5 xl:py-0 px-5">
                                    <a href="{{route('contacts.index')}}" class="report-box__content">
                                        <div class="flex">
                                            <div class="report-box__item__icon text-success bg-success/20 border border-success/20 flex items-center justify-center rounded-full">
                                                <i data-lucide="hard-drive"></i>
                                            </div>
                                        </div>
                                        <div class="text-2xl font-medium leading-7 mt-6">{{$totalContact}}</div>
                                        <div class="text-slate-500 mt-1">Liên hệ</div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>
                <!-- END: General Report -->
                <!-- BEGIN: Sales Report -->
                @can('orders_index')
                <?php if (in_array('orders', $dropdown)) { ?>
                    <div class="col-span-12 mt-7">
                        <div class=" block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Đơn hàng
                            </h2>
                        </div>
                        <div class=" box p-5 mt-12 sm:mt-4">
                            <div class="md:flex items-center">
                                <select class="form-select w-40 md:ml-auto mt-3 md:mt-0 dark:bg-darkmode-600 dark:border-darkmode-400" id="orderSearch">
                                    <option value="week" selected>7 ngày qua</option>
                                    <option value="month">Tháng này</option>
                                    <option value="month_before">Tháng trước</option>
                                    <option value="year">Năm nay</option>
                                </select>
                            </div>
                            <div class="mt-6">
                                <div class="chartreport">
                                    <canvas id="myChartOrder" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 mt-7">
                        <div class=" block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Đơn hàng
                            </h2>
                        </div>
                        <div class=" box p-5 mt-12 sm:mt-4">
                            <div class="md:flex items-center">
                                <select class="form-select w-40 md:ml-auto mt-3 md:mt-0 dark:bg-darkmode-600 dark:border-darkmode-400" id="orderSearch">
                                    <option value="week" selected>7 ngày qua</option>
                                    <option value="month">Tháng này</option>
                                    <option value="month_before">Tháng trước</option>
                                    <option value="year">Năm nay</option>
                                </select>
                            </div>
                            <div class="mt-6">
                                <div class="chartreport">
                                    <figure class="highcharts-figure">
                                        <div id="container"></div>
                                    </figure>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                @endcan
            </div>
        </div>

    </div>
    </div>


    @endsection
    <!-- END: main -->
    <!--Start: add javascript only index.html -->
    @push('javascript')
    <!-- highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/pareto.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        Highcharts.chart('container', {
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Restaurants Complaints'
            },
            tooltip: {
                shared: true
            },
            xAxis: {
                categories: [
                    'Overpriced',
                    'Small portions',
                    'Wait time',
                    'Food is tasteless',
                    'No atmosphere',
                    'Not clean',
                    'Too noisy',
                    'Unfriendly staff'
                ],
                crosshair: true
            },
            yAxis: [{
                title: {
                    text: ''
                }
            }, {
                title: {
                    text: ''
                },
                minPadding: 0,
                maxPadding: 0,
                max: 100,
                min: 0,
                opposite: true,
                labels: {
                    format: '{value}%'
                }
            }],
            series: [{
                type: 'pareto',
                name: 'Pareto',
                yAxis: 1,
                zIndex: 10,
                baseSeries: 1,
                tooltip: {
                    valueDecimals: 2,
                    valueSuffix: '%'
                }
            }, {
                name: 'Complaints',
                type: 'column',
                zIndex: 2,
                data: [755, 222, 151, 86, 72, 51, 36, 10]
            }]
        });
    </script>
    <!-- end highcharts -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function loadChart(data) {
            let timeFormat = 'DD/MM/YYYY';
            let config = {
                type: 'bar',
                data: {
                    datasets: [{
                        label: "Đơn hàng",
                        data: data,
                        backgroundColor: 'red'
                    }]
                }
            };
            $("div.chartreport").html('').append('<canvas id="myChart"  height="100"></canvas>');
            var ctx = document.getElementById("myChart").getContext("2d");
            window.myLine = new Chart(ctx, config);
        }

        function sortFunction(a, b) {
            var dateA = new Date(a.x).getTime();
            var dateB = new Date(b.y).getTime();
            return dateA > dateB ? 1 : -1;
        };
    </script>
    <script>
        let value = [
            <?php foreach ($data as $val) { ?> {
                    x: "<?php echo $val['x'] ?>",
                    y: <?php echo $val['y'] ?>
                },
            <?php } ?>
        ];
        loadChart(value);
    </script>
    <!-- ajax search click -->
    <script>
        $(document).on('change', '#orderSearch', function() {
            let value = $(this).val();
            $.ajax({
                type: 'POST',
                url: BASE_URL_AJAX + "dashboard/search/bookTour",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    value: value
                },
                success: function(response) {
                    let data = [];
                    $.each(response.data, function(i, val) {
                        data.push({
                            x: val.x,
                            y: val.y
                        });
                    });
                    data.sort(function(a, b) {
                        return new Date(a.x) - new Date(b.x);
                    });
                    loadChart(data);
                    //endchartjs
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
    @endpush
    <!--END: add css only index.html -->