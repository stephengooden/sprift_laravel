<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Report for  {{ $postcode ? $postcode : '-' }}</title>
    <script src="//code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.7//jquery.fullpage.css" />
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.7/jquery.fullpage.js"></script>
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
    <link media="all" href="{{ asset('css/reports/web.css') }}?e" rel="stylesheet">
    <!-- optional -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>


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
    Highcharts.chart('listed-propreties-bar', {
            colors: ["#FFB74D"],
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
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
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
            series: [{
                name: '{{$postcode}}',
                data: [
                        @php $pos = 1; $labs = []; $cols = []; $dats = []; @endphp
                        @foreach ($report['listing'] as $nam => $viewd)
                        @if($pos<=10)
                        @php
                            $labs[] = '"'.$nam.'"';
                            $dats[] = $viewd;
                            $cols[] = '"'. sprintf('#%06X', mt_rand(0, 0xFFFFFF)).'"';
                        @endphp
                    {
                        y: {{$viewd}}, 
                    },
                    @endif
                    @php $pos = $pos + 1; @endphp
                    @endforeach
                ]
            }]
        });

        Highcharts.chart('listed-propreties-by-value-bar', {
            colors: ["#FFB74D"],
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
                    @foreach ($report['by_value'] as $nam => $viewd)
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
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
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
            series: [{
                name: '{{$postcode}}',
                data: [
                        @php $pos = 1; $labs = []; $cols = []; $dats = []; @endphp
                        @foreach ($report['by_value'] as $nam => $viewd)
                        @if($pos<=10)
                        @php
                            $labs[] = '"'.$nam.'"';
                            $dats[] = $viewd;
                            $cols[] = '"'. sprintf('#%06X', mt_rand(0, 0xFFFFFF)).'"';
                        @endphp
                    {
                        y: {{$viewd}}, 
                    },
                    @endif
                    @php $pos = $pos + 1; @endphp
                    @endforeach
                ]
            }]
        });

        // Agency bar chart
        Highcharts.chart('agency-bar', {
            colors: ["#FFB74D"],
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
                    }
                },
                title: {
                    text: null
                }
            },
            yAxis: {
               gridLineColor: '#000',
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
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
            series: [{
                name: '{{$postcode}}',
                data: [
                        @php $pos = 1; $labs = []; $cols = []; $dats = []; @endphp
                        @foreach ($report['by_agent'] as $nam => $viewd)
                        @if($pos<=10)
                        @php
                            $labs[] = '"'.$nam.'"';
                            $dats[] = $viewd;
                            $cols[] = '"'. sprintf('#%06X', mt_rand(0, 0xFFFFFF)).'"';
                        @endphp
                    {
                        y: {{$viewd}}, 
                    },
                    @endif
                    @php $pos = $pos + 1; @endphp
                    @endforeach
                ]
            }]
        });
</script>
<script>
    $(document).ready(function() {
        // $('#app').fullpage();
    });
</script>
</body>
</html>
