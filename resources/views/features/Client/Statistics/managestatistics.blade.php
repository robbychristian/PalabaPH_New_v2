@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="h3 text-dark font-weight-bold">Transaction and Reports</div>
    </div>
    {{-- STATISTICS --}}
    <div class="row mx-2">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Today's Sales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">P{{ $total_profit }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Today's Machine Cycles</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $machine_cycles }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Today's Customer Count</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DATATABLES --}}
    <div class="px-5 mb-5 pb-5">
        <table id="recentSales" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Commodity Type</th>
                    <th>Date</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recent_orders as $recent_order)
                    <tr>
                        <td>{{ $recent_order->first_name }} {{ $recent_order->last_name }}</td>
                        <td>{{ $recent_order->commodity_type }}</td>
                        <td id="orderDate{{ $recent_order->id }}">{{ $recent_order->created_at }}</td>
                        <td>P{{ $recent_order->total_price }}</td>
                        <td>
                            <a href="/viewsalesinformation/{{ $recent_order->id }}">
                                <div class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </div>
                            </a>
                            <a href="/downloadreceipt/{{ $recent_order->id }}">
                                <div class="btn btn-primary">
                                    <i class="fas fa-download"></i>
                                </div>
                            </a>
                        </td>
                    </tr>

                    <script>
                        $(document).ready(() => {
                            const date = $("#orderDate{{ $recent_order->id }}").text()
                            const formattedDate = moment(date).format('LL')
                            $("#orderDate{{ $recent_order->id }}").html(formattedDate)
                        })
                    </script>
                @empty
                @endforelse
            </tbody>
            <script>
                $(document).ready(function() {
                    $('#recentSales').DataTable();
                });
            </script>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="earnings"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Mobile Earnings
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Store Earnings
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex justify-content-center">
                        <button class="btn" id="pieWeekly">Weekly</button>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <button class="btn" id="pieMonthly">Monthly</button>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <button class="btn" id="pieYearly">Yearly</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- SCRIPT FOR PIE GRAPH --}}
        <script>
            let weekly = true
            let monthly = false
            let yearly = false
            $(document).ready(() => {
                var ctx = document.getElementById("earnings");
                if (weekly == true) {
                    var earnings = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ["Mobile Earnings", "Store Earnings"],
                            datasets: [{
                                data: [{{ $total_mobile_weekly }}, {{ $total_store_weekly }}],
                                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                                hoverBorderColor: "rgba(234, 236, 244, 1)",
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                caretPadding: 10,
                            },
                            legend: {
                                display: false
                            },
                            cutoutPercentage: 80,
                        },
                    });
                }

            })
            $("#pieWeekly").click(() => {
                var ctx = document.getElementById("earnings");
                var earnings = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Mobile Earnings", "Store Earnings"],
                        datasets: [{
                            data: [{{ $total_mobile_weekly }}, {{ $total_store_weekly }}],
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 80,
                    },
                });
            })

            $("#pieMonthly").click(() => {
                var ctx = document.getElementById("earnings");
                var earnings = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Mobile Earnings", "Store Earnings"],
                        datasets: [{
                            data: [{{ $total_mobile_monthly }}, {{ $total_store_monthly }}],
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 80,
                    },
                });
            })

            $("#pieYearly").click(() => {
                var ctx = document.getElementById("earnings");
                var earnings = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Mobile Earnings", "Store Earnings"],
                        datasets: [{
                            data: [{{ $total_mobile_yearly }}, {{ $total_store_yearly }}],
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 80,
                    },
                });
            })
        </script>
        <div class="col-xl-6 col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex justify-content-center">
                        <button class="btn" id="lineWeekly">Weekly</button>
                    </div>
                    <div class="col-6 d-flex justify-content-center">
                        <button class="btn" id="lineMonthly">Monthly</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- LINE CHART SCRIPT --}}
        <script>
            $(document).ready(() => {
                var ctx = document.getElementById("lineChart");
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [@foreach ($weekly_orders as $weekly)
                            "{{ $weekly->dayname }}",
                        @endforeach
                        ],
                        datasets: [{
                            label: "Orders",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: [@foreach ($weekly_orders as $weekly)
                                "{{ $weekly->count }}",
                            @endforeach
                            ],
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                }
                            }
                        }
                    }
                });
            })

            $("#lineMonthly").click(() => {
                var ctx = document.getElementById("lineChart");
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [@foreach ($monthly_orders as $monthly)
                            "{{ $monthly->monthname }}",
                        @endforeach
                        ],
                        datasets: [{
                            label: "Orders",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: [@foreach ($monthly_orders as $monthly)
                                "{{ $monthly->count }}",
                            @endforeach
                            ],
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                }
                            }
                        }
                    }
                });
            })

            $("#lineWeekly").click(() => {
                var ctx = document.getElementById("lineChart");
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [@foreach ($weekly_orders as $weekly)
                            "{{ $weekly->dayname }}",
                        @endforeach
                        ],
                        datasets: [{
                            label: "Orders",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: [@foreach ($weekly_orders as $weekly)
                                "{{ $weekly->count }}",
                            @endforeach
                            ],
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                }
                            }
                        }
                    }
                });
            })
        </script>
    </div>
@endsection
