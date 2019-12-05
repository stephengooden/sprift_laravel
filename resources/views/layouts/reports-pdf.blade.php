<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Report for  {{ $postcode ? $postcode : '-' }}</title>
    <script src="//code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Scripts -->
    <!-- Required to convert named colors to RGB -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.4/rgbcolor.min.js"></script>
    <!-- Optional if you want blur -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stackblur-canvas/1.4.1/stackblur.min.js"></script>
    <!-- Main canvg code -->
    <script src="https://cdn.jsdelivr.net/npm/canvg/dist/browser/canvg.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link media="all" href="{{ asset('css/reports/pdf.css') }}" rel="stylesheet">
    <!-- optional -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>


    <link rel="stylesheet" media="print" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <style media="print">@page { size: A4 landscape }</style>
    <style type="text/css">
        @font-face {
           font-family: Avenir;
           src: url(../../fonts/avenir/AvenirLTStd-Roman.otf);
        }

        @font-face {
           font-family: Avenir Bold;
           src: url(../../fonts/avenir/AvenirLTStd-Black.otf);
        }
        html,
        body {
          font-family: 'Avenir', sans-serif !important;
        }
    </style>
</head>
<body class="A4 landscape">
<div class="page-wrap" id="app">
    @yield('content')
</div>
<script>
    $(document).ready(function() {
        // $('#app').fullpage();
    });
</script>
<script>
    let below = false
    if ($(window).width() > 980) {
        $('#app').fullpage();
        below = false
    } else {
        $('.infogrey-table').slick({
            dots: false,
            infinite: false,
            slidesToShow: 1,
            adaptiveHeight: true
        })

        below = true
    }
</script>
<script>
    $(function(){
    Highcharts.chart('listed-propreties-bar', {
            colors: ["#6DA5E8"],
            chart: {
                marginLeft: 100,
                backgroundColor: '#000000',
                type: 'column',
                style: {
                    fontFamily: 'Avenir'
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                showEmpty: false,
                categories: [
                    @foreach ($report['listing'] as $nam => $viewd)
                        @php
                            $labs[] = '"'.$nam.'"';
                        @endphp
                        '{{$nam}}' , 
                    @endforeach
                ],
                labels: {
                    style: {
                        fontSize: '15px',
                        color: '#fff'
                    }
                },
                title: {
                    text: null
                }
            },
            yAxis: {
               gridLineColor: '#000',
               visible: false,
               useHTML: true,
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                series: {
                    animation: false,
                    borderColor: '#6DA5E8',
                    pointPadding: 0.05,
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            if (this.y > 0) {
                              return this.y;
                            }
                          }
                    },
                },
                column: {
                    dataLabels: {
                        style: {
                            fontSize: '14px',
                        },
                        enabled: true,
                        color: '#fff',
                    }
                }
            },
            credits: {
                enabled: false
            },
            exporting: { 
                enabled: false
            },
            series: [{
                name: 'Listings by property category',
                data: [
                         @foreach ($report['listing'] as $viewd)
                        @php
                            $dats[] = $viewd;
                        @endphp
                        {
                            y: {{$viewd}}, 
                        },
                    @endforeach
                ],
                dataLabels: {
                    useHTML: true,
                }
            }]
        });

        Highcharts.chart('listed-propreties-by-value-bar', {
            colors: ["#B9DE6E"],
            chart: {
                backgroundColor: '#000000',
                marginLeft: 100,
                type: 'column',
                style: {
                    fontFamily: 'Avenir'
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    @foreach ($report['by_value'] as $nam => $viewd)
                        @php
                            $labs[] = '"'.$nam.'"';
                        @endphp
                        '{{$nam}}' , 
                    @endforeach
                ],
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '15px',
                        color: '#fff'
                    }
                },
                title: {
                    text: null
                }
            },
            yAxis: {
               gridLineColor: '#000',
               visible: false
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                series: {
                    animation: false,
                    borderColor: '#B9DE6E',
                    pointPadding: 0.05,
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            if (this.y > 0) {
                                return this.y;
                            }
                        }
                    },
                },
                column: {
                    dataLabels: {
                        style: {
                            fontSize: '14px',
                        },
                        color: '#fff'
                    },
                    enabled: true
                }
            },
            credits: {
                enabled: false
            },
            exporting: { 
                enabled: false
            },
            series: [{
                name: 'Sales Listings by Value',
                data: [
                         @foreach ($report['by_value'] as $viewd)
                        @php
                            $dats[] = $viewd;
                        @endphp
                        {
                            y: {{$viewd}}, 
                        },
                    @endforeach
                ]
            }]
        });


        //  NEW CHARTS
        /*
        Highcharts.chart('listed-for-sale', {
            colors: ["#6DA5E8"],
            chart: {
                backgroundColor: '#000000',
                type: 'bar',
                style: {
                    fontFamily: 'Avenir'
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    @foreach ($report['listing'] as $nam => $viewd)
                        @php
                            $labs[] = '"'.$nam.'"';
                        @endphp
                        '{{$nam}}' , 
                    @endforeach
                ],
                labels: {
                    style: {
                        fontSize: '15px',
                        color: '#fff'
                    }
                },
                title: {
                    text: null
                }
            },
            yAxis: {
               gridLineColor: '#000',
               visible: false
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                series: {
                    borderColor: '#6DA5E8',
                    pointPadding: 0.05,
                    formatter: function() {
                        if (this.y > 0) {
                            return this.y;
                        }
                    }
                },
                bar: {
                    dataLabels: {
                        style: {
                            fontSize: '14px',
                        },
                        enabled: true,
                        color: '#fff'
                    }
                }
            },
            credits: {
                enabled: false
            },
            exporting: { 
                enabled: false
            },
            series: [{
                name: 'Sale Listings',
                data: [
                        @foreach ($report['listing'] as $viewd)
                        @php
                            $dats[] = $viewd;
                        @endphp
                    {{$viewd}},
                    @endforeach
                ]
            }]
        });

        Highcharts.chart('listed-for-rent', {
            colors: ["#B9DE6E"],
            chart: {
                backgroundColor: '#000000',
                type: 'bar',
                style: {
                    fontFamily: 'Avenir'
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    @foreach ($report['listing'] as $nam => $viewd)
                        @php
                            $labs[] = '"'.$nam.'"';
                        @endphp
                        '{{$nam}}' , 
                    @endforeach
                ],
                labels: {
                    style: {
                        fontSize: '15px',
                        color: '#fff'
                    }
                },
                title: {
                    text: null
                }
            },
            yAxis: {
               gridLineColor: '#000',
               visible: false
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                series: {
                    borderColor: '#B9DE6E',
                    pointPadding: 0.05,
                    formatter: function() {
                        if (this.y > 0) {
                            return this.y;
                        }
                    }
                },
                bar: {
                    dataLabels: {
                        style: {
                            fontSize: '13px',
                        },
                        enabled: true,
                        color: '#fff'
                    }
                }
            },
            credits: {
                enabled: false
            },
            exporting: { 
                enabled: false
            },
            series: [{
                name: 'Rental Listing',
                data: [
                        @foreach ($report['listing'] as $nam => $viewd)
                        @php
                            $dats[] = $viewd;
                        @endphp
                    {
                        y: {{$viewd}}, 
                    },
                    @endforeach
                ]
            }]
        });
        */


        // Agency bar chart
        Highcharts.chart('agency-bar', {
            colors: [
                '#EF9A9A',
                '#B39DDB',
                '#81D4FA',
                '#A5D6A7',
                '#FFF59D',
                '#FFAB91',
                '#F48FB1',
                '#9FA8DA',
                '#80DEEA',
                '#80CBC4',
                '#90CAF9',
                '#FFAB40',
            ],
            chart: {
                marginLeft: 100,
                backgroundColor: '#000000',
                type: 'column',
                style: {
                    fontFamily: 'Avenir'
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    @foreach ($report['by_agent'] as $nam => $viewd)
                        @php
                            $labs[] = '"'.$nam.'"';
                        @endphp
                        '{{$nam}}' , 
                    @endforeach
                ],
                labels: {
                    rotation: -55,
                    style: {
                        fontSize: '15px',
                        color: '#fff'
                    }
                },
                title: {
                    text: null
                }
            },
           legend: {
                enabled: true
            },
            yAxis: {
               gridLineColor: '#000',
               visible: false
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                series: {
                    animation: false,
                    borderColor: '#000',
                    pointPadding: 0.05,
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            if (this.y > 0) {
                                return this.y;
                            }
                        }
                    },
                },
                column: {
                    colorByPoint: true,
                    dataLabels: {
                        style: {
                            fontSize: '14px',
                        },
                        color: '#fff'
                    },
                    enabled: true
                }
            },
            credits: {
                enabled: false
            },
            exporting: { 
                enabled: false
            },
            series: [{
                name: 'Top agents by market share',
                data: [
                        @foreach ($report['by_agent'] as $viewd)
                        @php
                            $dats[] = $viewd;
                        @endphp
                    {
                        y: {{$viewd}}, 
                    },
                    @endforeach
                ]
            }]
        });
    });
</script>
</body>
</html>
