<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Report for  {{ $postcode ? $postcode : '-' }}</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.7//jquery.fullpage.css" />
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.7/jquery.fullpage.js"></script>
    <!-- Scripts -->
    <!-- Required to convert named colors to RGB -->
    <link rel="stylesheet" type="text/css" href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.4/rgbcolor.min.js"></script>
    <!-- Optional if you want blur -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stackblur-canvas/1.4.1/stackblur.min.js"></script>
    <!-- Main canvg code -->
    <script src="https://cdn.jsdelivr.net/npm/canvg/dist/browser/canvg.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <script type="text/javascript" src="{{ asset('js/collapse.js') }}"></script>
    <link media="all" href="{{ asset('css/reports/web.css') }}?ea" rel="stylesheet">
    <!-- optional -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"/>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">

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
         let below = false
         if ($(window).width() > 980) {
             $('#app').fullpage();
            //  new fullpage('#app', {
            //     anchors:['firstPage', 'secondPage', 'thirdPage']
            // });
             below = false
         } else {
            if($(window).width() < 768)
                 $('.infogrey-table').slick({
                    dots: false,
                    infinite: false,
                    slidesToShow: 1,
                    adaptiveHeight: true,
                    nextArrow: '<div class="custom-slick-next-btn"><i class="fa fa-chevron-right"></i></div>',
                    prevArrow: '<div class="custom-slick-prev-btn"><i class="fa fa-chevron-left"></i></div>',
                    settings: {
                        arrows: true
                      }
                 });

            below = true
        }
        // let below = false
        // if ($(window).width() > 980) {
        //     $('#app').fullpage();
        // }

        // if ($(window).width() < 768) {
        //     $('.infogrey-table').slick({
        //         dots: false,
        //         infinite: false,
        //         slidesToShow: 1,
        //         adaptiveHeight: true,
        //         nextArrow: '<div class="custom-slick-next-btn"><i class="fa fa-chevron-right"></i></div>',
        //         prevArrow: '<div class="custom-slick-prev-btn"><i class="fa fa-chevron-left"></i></div>',
        //         settings: {
        //             arrows: true
        //           }
        //     })
        // }
    </script>
    <script>
        Highcharts.chart('listed-for-sale-type', {
            chart: {
                backgroundColor: '#000000',
                type: 'column',
                marginLeft: 100,
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
                    @foreach ($report['salesbytype'] as $nam => $viewd)
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
            legend: {
                itemStyle: {
                    color: '#fff',
                }
            },
            series: [{
                name: 'Sale Listings by Property Type',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#9bc1ff'],
                        [1, '#4282cf']
                    ]
                },
                data: [
                        @foreach ($report['salesbytype'] as $viewd)
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

        Highcharts.chart('isted-for-sale-value', {
            chart: {
                backgroundColor: '#000000',
                type: 'column',
                marginLeft: 100,
                marginBottom: 160,
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
                    @foreach ($report['salesbyvalue'] as $nam => $viewd)
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
            legend: {
                itemStyle: {
                    color: '#fff',
                }
            },
            series: [{
                name: 'Sale Listings by Value',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#dcffa0'],
                        [1, '#B9DE6E']
                    ]
                },
                data: [
                         @foreach ($report['salesbyvalue'] as $viewd)
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

        Highcharts.chart('listed-rental-by-type', {
            chart: {
                backgroundColor: '#000000',
                type: 'column',
                marginLeft: 100,
                marginBottom: 160,
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
                    @foreach ($report['rentalsbytype'] as $nam => $viewd)
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
                    borderColor: '#e24c31',
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
            legend: {
                itemStyle: {
                    color: '#fff',
                }
            },
            series: [{
                name: 'Rental Listings by Property Type',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#ff9a99'],
                        [1, '#e24c31']
                    ]
                },
                data: [
                         @foreach ($report['rentalsbytype'] as $viewd)
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

        Highcharts.chart('listed-rental-by-value', {
            chart: {
                backgroundColor: '#000000',
                type: 'column',
                marginLeft: 100,
                marginBottom: 160,
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
                    @foreach ($report['rentalsbyvalue'] as $nam => $viewd)
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
                    borderColor: '#e2af31',
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
            legend: {
                itemStyle: {
                    color: '#fff',
                }
            },
            series: [{
                name: 'Rental Listings by Value',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#ffb977'],
                        [1, '#e2af31']
                    ]
                },
                data: [
                        @foreach ($report['rentalsbyvalue'] as $viewd)
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
        Highcharts.chart('agency-bar', {
            chart: {
                backgroundColor: '#00000000',
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
                    style: {
                        fontSize: '15px',
                        color: '#fff'
                    },
                    rotation: -45                    
                },
                title: {
                    text: null
                }
            },
           legend: {
                enabled: false
            },
            yAxis: {
                gridLineColor: '#197F07',
                gridLineWidth: 0,
                lineWidth:1,
               tickInterval:10,
               title:{
                   text:null
               },
                labels: {
                    style: {
                        fontSize: '20px',
                        color: '#fff'
                    }
                },
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                series: {
                    borderColor: '#bf9ee5',
                    pointPadding: 0.05,
                    pointWidth:20,
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
            legend: {
                itemStyle: {
                    color: '#fff',
                }
            },
            series: [{
                showInLegend: false,
                name: 'Rental Listings by Value',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#c8b0ed'],
                        [1, '#805cac']
                    ]
                },
                data: [
                        @foreach ($report['by_agent'] as $nam => $viewd)
                        @php
                            $dats[] = $viewd; 
                        @endphp
                    { name: '{{$nam}}', y: {{$viewd}} },
                    @endforeach
                ]
            }]
        });
    </script>
</body>
</html>
