@extends('layouts.reportsnew-' . $outer)

@php
    function date_compare($a, $b)
    {
        $t1 = strtotime($a['Date']);
        $t2 = strtotime($b['Date']);
        return $t2 - $t1;
    }    

    $recently_listed_array = $report['recently_listed'];
    $recently_reduced_array = $report['recently_reduced'];
    $planning_decided_array = $report['planning_decided'];
    $planning_validated_array = $report['planning_validated'];

    usort($recently_listed_array, 'date_compare');
    usort($recently_reduced_array, 'date_compare');
    usort($planning_decided_array, 'date_compare');
    usort($planning_validated_array, 'date_compare');
@endphp

@section('content')

    <div class="mobheader" style="display: none">
        <div class="inner">

            <img src="/img/logo_grey.svg" alt="" class="minlogo"/>
            <div style="float:right">
                <a class="btn" href="javascript:void(0);" onclick="$('.mobheader').toggleClass('active')"> Menu</a>
            </div>
        </div>
        <div class="dropdown-menu" id="mobmen">
            <div class="dropdown-item">
                <a class="navsite" href="#sec1">Top</a>
                <a class="navsite" href="#sec2">Intro</a>
                <a class="navsite" href="#sec4">Summary</a>
                <a class="navsite" href="#sec7">Properties Currently Listed</a>
                <a class="navsite" href="#sec8">Market share by agent</a>
                <a class="navsite" href="#sec9">Supply vs Demand</a>
                @if(count($report['recently_listed']))
                <a class="navsite" href="#sec11">New Listings</a>
                @endif
                @if(count($report['recently_reduced']))
                <a class="navsite" href="#sec13">Price Reductions</a>
                @endif
                @if(count($report['planning_validated']))
                <a class="navsite" href="#secval">Planning Applications Validated</a>
                @endif
                @if(count($report['planning_decided']))
                <a class="navsite" href="#secdec">Planning Applications Decided</a>
                @endif

            </div>
        </div>
    </div>
    <section id="sec1" class="sheet section sec1" style="background-image: url('{{$report['img1']}}');">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
                <div class="absoulute-logo">
                    <img style="width:200%;height:200%" src="{{ asset('images/header-img.png') }}">
                </div>
            </header>
            <div class="content">
                <div class="containe">
                    <h1>Sprift Insider Report</h1>
                    <h2>Postcode Area: {{$postcode}}</h2>
                    <h4>{{$fromTo}}</h4>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>

<!-- New page with statistics for planning , scheduled for next week -->
{{--     <section id="sec4" class="sheet section sec-tables1 sec4">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <h2>SUMMARY</h2>
                <h3>PLANNING APPLICATIONS FOR {{$postcode}}</h3>
                <div class="table-summary">
                    <div class="inforow">
                        <div class="wtx">Total</div>
                        <div class="mdl"></div>
                        <div class="wtx">Weekly Change</div>
                    </div>
                    <div class="datarows">
                        <div class="datarow">
                            <!-- Used app_subm and app_subm_change parameters -->
                            <div class="numbr">{{ count($report['planning_validated']) }}</div>
                            <div class="labl">APPLICATIONS VALIDATED</div>
                            <div class="numbr {{ $report['summary']['app_subm_change'] >= 0 ? ( $report['summary']['app_subm_change'] == 0 ? 'same' : 'pos' ) : 'neg' }}">{{ $report['summary']['app_subm_change'] >= 0 ? ( $report['summary']['app_subm_change'] == 0 ? 'NO CHANGE' : '+' . $report['summary']['app_subm_change'] ) : '' .$report['summary']['app_subm_change'] }}</div>
                        </div>
                        <div class="datarow">
                            <div class="numbr">{{ $report['summary']['app_decided'] }}</div>
                            <div class="labl">APPLICATIONS DECIDED</div>
                            <div class="numbr {{ $report['summary']['app_decided_change'] >= 0 ? ( $report['summary']['app_decided_change'] == 0 ? 'same' : 'pos' ) : 'neg' }}">{{ $report['summary']['app_decided_change'] >= 0 ? ( $report['summary']['app_decided_change'] == 0 ? 'NO CHANGE' : '+' . $report['summary']['app_decided_change'] ) : '' .$report['summary']['app_decided_change'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!--
    <section class="sheet section sec-tables1 sec5">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <h2>SUMMARY</h2>
                <h3>Planning Applications for {{$postcode}}</h3>
                <div class="table-summary">
                    <div class="inforow">
                        <div class="wtx">Total</div>
                        <div class="mdl"></div>
                        <div class="wtx">Weekly Change</div>
                    </div>
                    <div class="datarows">
                        <div class="datarow">
                            <div class="numbr">185</div>
                            <div class="labl">Applications Submited</div>
                            <div class="numbr pos">+6</div>
                        </div>
                        <div class="datarow">
                            <div class="numbr">4</div>
                            <div class="labl">Applications decided</div>
                            <div class="numbr neg">-1</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="sec6" class="sheet section sec6" style="background-image: url('{{$report['img3']}}');">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="yellow-banner">
                    <h2>THIS WEEK IN {{$postcode}}</h2>
                    <h3>{{$fromTo}}</h3>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    
    -->
    <!-- New page with graph lister for sale and lister for rent , scheduled for next week -->
     <section id="sec7" class="sheet section sec7">
        <header class="sec-header">
            <div class="text-center">
                <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
            </div>
        </header>
        <div class="inner vcenter">
            <div class="content">
                <div class="container-bs charcont">
                    <div class="text-center">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                    </div>
                    <!-- <div class="rowflex">
                        <div class="half-ofrow">
                            <h3>SALE LISTINGS by TYPE</h3>
                            <p>The chart below shows the number of sales listings in the {{$postcode}} area by property category</p>
                            <div class="graph-box">
                                <div id="listed-for-sale-type" class="chart"></div>
                            </div>
                        </div>
                        <div class="half-ofrow">
                            <h3>SALE LISTINGS by VALUE</h3>
                            <p>The chart below shows the number of rental listings in the {{$postcode}} area by property value.</p>
                            <div class="graph-box">
                                <div id="isted-for-sale-value" class="chart"></div>
                            </div>
                        </div>
                    </div> -->
                    <!--for this week -->
                    <h3>SALE LISTINGS by TYPE</h3>
                    <p>The chart below shows the number of sales listings in the {{$postcode}} area by property category</p>
                    <div class="graph-box">
                        <div id="listed-for-sale-type" class="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(count($report['rentalsbytype']) || count($report['rentalsbyvalue']))
    <section id="sec27"class="sheet section sec27">
        <header class="sec-header">
            <div class="text-center">
                <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
            </div>
        </header>
        <div class="inner vcenter">
            <div class="content">
                <div class="container-bs charcont">
                    <div class="text-center">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                    </div>
                    <div class="rowflex">
                        <div class="half-ofrow">
                            <h3>RENTAL LISTINGS by TYPE</h3>
                            <p>The chart below shows the number of rental listings in the {{$postcode}} area by property type.</p>
                            <div class="graph-box">
                                <div id="listed-rental-by-type" class="chart"></div>
                            {{--     <div id="props-bygroup2" style="display: none"></div>
                                <canvas id="props-bygroup"></canvas> --}}
                            </div>
                        </div>
                        <div class="half-ofrow">
                            <h3>RENTAL LISTINGS by VALUE</h3>
                            <p>The chart below shows the number of rental listings in the {{$postcode}} area by property value.</p>
                            <div class="graph-box">
                                <div id="listed-rental-by-value" class="chart"></div>
                           {{--      <div id="props-byvalue2" style="display: none"></div>
                                <canvas id="props-byvalue"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(count($report['by_agent']))
    <section id="sec8" class="sheet section sec8">
        <div class="rowflex fullh">
            <div class="half-ofrow first-ofrow thiweekbg halfaimg top-img" style="background-size: cover; background-repeat: no-repeat; background-image: url('{{asset('/images/default/key.jpg')}}')">
            </div>
            <div class="half-ofrow second-ofrow">
                <div class="right-inner">
                    <div class="logo-wrap mb-30">
                        <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                    </div>

                    <h2>THIS WEEK IN {{$postcode}}</h2>
                    <h3>SALES LISTINGS by AGENT</h3>
                    <p>How does your agency compare against your competitors this week?  Here are the top agents serving {{$postcode}} by market share.</p>
                </div>
            </div>
            <div class="graph-box" style="position: absolute; width: 100%; height: 90vh;margin-top: 100px">
                <div id="agency-bar" style="min-width: 310px; max-width: 100%; width: 85%; height: 90vh;"></div>
                    <div style="display:none" id="props-byagencywin"></div>
                    <canvas id="props-byagency" width="800" height="500"></canvas>
            </div>
            <div class="half-ofrow first-ofrow thiweekbg halfaimg bottom-image" style="background-size: cover; background-repeat: no-repeat; display: none; background-image: url('{{asset('/images/default/key.jpg')}}')">
            </div>
        </div>
    </section>
    @endif
    <section id="sec9" class="sheet section sec9">
        <div class="rowflex fullh">
            <div class="half-ofrow first-ofrow thiweekbg">
                <div class="right-inner">
                    <div class=" logo-wrap mb-30" style="text-align:right">
                        <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                    </div>
                    <h2>THIS WEEK IN {{$postcode}}</h2>
                    <h3>SUPPLY vs DEMAND ANALYSIS</h3>
                    <p>To give you a picture of the properties currently listed and demand for those, we've ranked the top property types by the number of listings versus number of viewings.  Over time this data should tell you which properties you need to be including and/or focusing on your within your marketing.</p>

                    <h4><span>PROPERTY CATEGORY RANKED</span></h4>
                    <div class="rowflex">
                        <div class="half-ofrow supply">
                            <h5><span>BY LISTINGS (SUPPLY)</span></h5>
                            <ul>
                                @php $pos = 1; @endphp
                                @foreach ($report['most_viewed'] as $nam => $viewd)
                                    @if($pos<=10)
                                    <li>
                                        <span data-val="{{$viewd}}">{{$pos}})</span> {{$nam}}
                                    </li>
                                    @endif
                                    @php $pos = $pos + 1; @endphp
                                @endforeach
                            </ul>
                        </div>
                            <div class="half-ofrow demand">
                                <h5>VIEWINGS<span>(DEMAND)</span></h5>
                                <ul>
                                    @php $pos = 1; @endphp
                                    @foreach ($report['most_demanded'] as $nam => $viewd)
                                        @if($pos<=10)
                                        <li>
                                            <span data-val="{{$viewd}}">{{$pos}})</span> {{$nam}}
                                        </li>
                                        @endif
                                        @php $pos = $pos + 1; @endphp
                                    @endforeach
                                </ul>
                            </div>

                    </div>
                </div>
            </div>
            <div class="half-ofrow second-ofrow halfaimg supply-demand-img" style="background-size: cover; background-repeat: no-repeat; background-image: url('{{$report['img4']}}');">

            </div>
        </div>
    </section>

    @if(count($recently_listed_array)>0)
    <section id="sec11" class="sheet section sec11 sec-table fit15 desktop">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="container-bs">

                    <div class="txt1-group">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                        @if (count($recently_listed_array)>6)
                            <h3>NEW LISTINGS - Page 1</h3>
                        @else
                            <h3>NEW LISTINGS</h3>   
                        @endif                         
                        <p>Below is an overview of the most recent new listings in the {{$postcode}} area including price and agent</p>
                    </div>
                    <div class="infogrey-table">
                        @php $pos = 1; $ostl = count(array_slice($recently_listed_array, 0, 6)); @endphp
                        @foreach($recently_listed_array as $elm)
                            @if($pos<=6)
                                <div>
                                    <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                        <div class="date-box">
                                            <span>
                                                {{$elm["Date"]}}
                                            </span>
                                        </div>
                                        <div class="adrbox">
                                            @if((int)$elm["Bedroom_Number"])
                                                <span class="type">{{$elm["Bedroom_Number"]}}-Bedroom {{$elm["Property_Type"]}}</span>
                                            @else
                                                <span class="type">{{$elm["Bedroom_Number"]}}</span>
                                            @endif
                                            <span class="name">
                                                <p>
                                                    {!! $elm["Address"] !!}
                                                </p>
                                            </span>
                                        </div>
                                        <div class="pricebox">
                                            <span>
                                                {{$elm["Guide_Price"]}}
                                            </span>
                                        </div>
                                        <div  class="ownr-box">
                                            <p>
                                                {!! $elm["Agent1"] !!}
                                            </p>
                                        </div>
                                        <div class="outer-link">
                                            <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW LISTING</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @php $pos = $pos + 1; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    @endif

    @if(count($report['recently_listed'])>6)
        @php $ima = 6; $pag = 1; $page_num = 1; @endphp
        @for($i = 6; $i < count($recently_listed_array); $i+=6)
            <section class="sheet section sec16 sec-table moretabl desktop">
                <div class="inner vcenter">
                    <div class="content-n">
                        <div class="container-bs">
                            <div class="txt1-group">
                                <h2>THIS WEEK IN {{$postcode}}</h2>
                                <h3>New Listings - Page {{ $pag + 1 }}</h3>
                            </div>
                            <div class="infogrey-table">

                                @php $pos = 1; $ostl = count(array_slice($recently_listed_array, $i, ($ima)));  @endphp
                                @foreach($recently_listed_array as $elm)
                                    @if($pos>$i && $pos<=($i+$ima))
                                        <div>

                                            <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                                <div class="date-box">
                                                    <span>
                                                        {{$elm["Date"]}}
                                                    </span>
                                                </div>
                                                <div class="adrbox">
                                                    @if((int)$elm["Bedroom_Number"])
                                                        <span class="type">{{$elm["Bedroom_Number"]}}-Bedroom {{$elm["Property_Type"]}}</span>
                                                    @else
                                                        <span class="type">{{$elm["Bedroom_Number"]}}</span>
                                                    @endif
                                                    <span class="name">
                                                        <p>
                                                            {!! $elm["Address"] !!}
                                                        </p>
                                                    </span>
                                                </div>
                                                <div class="pricebox">
                                                    <span>
                                                        {{$elm["Guide_Price"]}}
                                                    </span>
                                                </div>
                                                <div  class="ownr-box">
                                                    <p>
                                                        {!! $elm["Agent1"] !!}
                                                    </p>
                                                </div>
                                                <div class="outer-link">
                                                    <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW LISTING</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @php $pos = $pos + 1; @endphp
                                @endforeach
                                @php $pag++; @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endfor
    @endif
        
    @if(count($report['recently_reduced'])>0)
    <section id="sec13" class="sheet section sec13 sec-table fit15 desktop">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="container-bs">

                    <div class="txt1-group">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                        @if (count($recently_reduced_array)>6)
                            <h3>REDUCED - Page 1</h3>
                        @else
                            <h3>REDUCED</h3>
                        @endif
                        <p>The properties below have all been reduced in price over the past seven days.</p>
                   </div>
                    <div class="infogrey-table">

                        @php $pos = 1; $ostl = count(array_slice($recently_reduced_array, 0, 6)); @endphp
                        @foreach($recently_reduced_array as $elm)
                            @if($pos<=6)
                                <div>
                                    <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                        <div class="date-box">
                                            <span>
                                                {{$elm["Date"]}}
                                            </span>
                                        </div>
                                        <div class="adrbox">
                                            @if((int)$elm["Bedroom_Number"])
                                                <span class="type">{{$elm["Bedroom_Number"]}}-Bedroom {{$elm["Property_Type"]}}</span>
                                            @else
                                                <span class="type">{{$elm["Bedroom_Number"]}}</span>
                                            @endif
                                            <span class="name">
                                                <p>
                                                    {!! $elm["Address"] !!}
                                                </p>
                                            </span>
                                        </div>
                                        <div class="pricebox">
                                            <span>
                                                {{$elm["Guide_Price"]}}
                                            </span>
                                        </div>
                                        <div  class="ownr-box">
                                            <p>
                                                {!! $elm["Agent1"] !!}
                                            </p>
                                        </div>
                                        <div class="outer-link">
                                            <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW LISTING</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @php $pos = $pos + 1; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    @endif

    @if(count($report['recently_reduced'])>6)
        @php $ima = 6; $pag = 1; @endphp
        @for($i = 6; $i < count($recently_reduced_array); $i+=6)
            <section class="sheet section sec16 sec-table moretabl desktop">
                <div class="inner vcenter">
                    <div class="content-n">
                        <div class="container-bs">
                            <div class="txt1-group">
                                <h2>THIS WEEK IN {{$postcode}}</h2>
                                <h3>Reduced - Page {{ $pag + 1}}</h3>
                           </div>
                            <div class="infogrey-table">

                                @php $pos = 1;$ostl = count(array_slice($recently_reduced_array, $i, $ima)); @endphp
                                @foreach($recently_reduced_array as $elm)
                                    @if($pos>$i && $pos<=($i+$ima))
                                        <div>
                                            <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                                <div class="date-box">
                                                    <span>
                                                        {{date('d/m/y', strtotime($elm["Date"]))}}
                                                    </span>
                                                </div>
                                                <div class="adrbox">
                                                    @if((int)$elm["Bedroom_Number"])
                                                        <span class="type">{{$elm["Bedroom_Number"]}}-Bedroom {{$elm["Property_Type"]}}</span>
                                                    @else
                                                        <span class="type">{{$elm["Bedroom_Number"]}}</span>
                                                    @endif
                                                    <span class="name">
                                                        <p>
                                                            {!! $elm["Address"] !!}
                                                        </p>
                                                    </span>
                                                </div>
                                                <div class="pricebox">
                                                    <span>
                                                        {{$elm["Guide_Price"]}}
                                                    </span>
                                                </div>
                                                <div  class="ownr-box">
                                                    <p>
                                                        {!! $elm["Agent1"] !!}
                                                    </p>
                                                </div>
                                                <div class="outer-link">
                                                    <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW LISTING</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @php $pos = $pos + 1; @endphp
                                @endforeach
                                @php $pag++; @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endfor
    @endif

    <!-- mobile table slider for recently reduced -->
   {{--  @if(count($report['recently_reduced'])>0)
    <section id="sec13" class="sheet section sec13 sec-table fit15 mobile">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="container-bs">

                    <div class="txt1-group">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                        <h3>REDUCED</h3>
                        <p>The properties below have all been reduced in price over the past seven days.</p>
                   </div>
                    <div class="infogrey-table infogrey-table-mobile">

                        @foreach($report['recently_reduced'] as $elm)
                                <div>
                                    <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                        <div class="date-box">
                                            <span>
                                                {{date('d/m/y', strtotime($elm["Date"]))}}
                                            </span>
                                        </div>
                                        <div class="adrbox">
                                            <span class="type">{{$elm["Type"]}}</span>
                                            <span class="name">{!!strlen($elm["Address"]) > ($ostl<5 ? 75 : 120) ? substr($elm["Address"],0,($ostl<5 ? 75 : 120)).'...' :$elm["Address"] !!}</span>
                                        </div>
                                        <div class="pricebox">
                                            <span>
                                                {{$elm["Price"]}}
                                            </span>
                                        </div>
                                        <div  class="ownr-box">
                                            <p>
                                                {!!strlen($elm["Agent"]) > ($ostl<5 ? 20 : 30)  ? substr($elm["Agent"],0,($ostl<5 ? 20 : 30) ).'...' :$elm["Agent"] !!}
                                            </p>
                                        </div>
                                        <div class="outer-link">
                                            <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW LISTING</a>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    @endif --}}

    <!--
    <section class="sheet section sec14 sec-table">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="container-bs">

                    <div class="txt1-group">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                        <h3>Fall Throughs</h3>
                        <p>The properties below are suspected of having had a sale fall-through in the past seven days. </p>
                   </div>
                    <div class="infogrey-table">
                        <div class="infogrey-table-row">
                            <div>01.01.2019</div>
                            <div class="adrbox">
                                <span class="type">4-Bedroom Detached House</span>
                                <span class="name">1 Manor House Drive Walton-On-Thames KT12 5DF</span>
                            </div>
                            <div>£539,000</div>
                            <div>Frost & Co</div>
                            <div class="outer-link">
                                <a class="outer-dirlink" href="#">VIEW REPORT</a>
                            </div>
                        </div>
                        <div class="infogrey-table-row">
                            <div>01.01.2019</div>
                            <div class="adrbox">
                                <span class="type">4-Bedroom Detached House</span>
                                <span class="name">1 Manor House Drive Walton-On-Thames KT12 5DF</span>
                            </div>
                            <div>£539,000</div>
                            <div>Frost & Co</div>
                            <div class="outer-link">
                                <a class="outer-dirlink" href="#">VIEW REPORT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    -->
    <!--
    <section class="sheet section sec14a sec-table">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="container-bs">
                    <div class="txt1-group">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                        <h3>Withdrawn</h3>
                        <p>The properties below are suspected of being withdrawn in the past seven days. </p>
                    </div>
                    <div class="infogrey-table">
                        <div class="infogrey-table-row">
                            <div>01.01.2019</div>
                            <div class="adrbox">
                                <span class="type">4-Bedroom Detached House</span>
                                <span class="name">1 Manor House Drive Walton-On-Thames KT12 5DF</span>
                            </div>
                            <div>£539,000</div>
                            <div>Frost & Co</div>
                            <div class="outer-link">
                                <a class="outer-dirlink" href="#">VIEW REPORT</a>
                            </div>
                        </div>
                        <div class="infogrey-table-row">
                            <div>01.01.2019</div>
                            <div class="adrbox">
                                <span class="type">4-Bedroom Detached House</span>
                                <span class="name">1 Manor House Drive Walton-On-Thames KT12 5DF</span>
                            </div>
                            <div>£539,000</div>
                            <div>Frost & Co</div>
                            <div class="outer-link">
                                <a class="outer-dirlink" href="#">VIEW REPORT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    -->


    @if(count($report['planning_validated']))
    <section id="secval" class="sheet section sec16 sec-table fit15 desktop">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="container-bs">
                    <div class="txt1-group">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                        @if (count($planning_validated_array)>6)
                            <h3>PLANNING APPLICATION VALIDATED - Page 1</h3>
                        @else
                            <h3>PLANNING APPLICATION VALIDATED</h3>
                        @endif
                        <p>The properties below have had planning applications validated in the last seven days.</p>
                    </div>
                    <div class="infogrey-table">

                        @php $pos = 1;  $ostl = count(array_slice($planning_validated_array, 0, 6)); @endphp
                        @foreach($planning_validated_array as $elm)
                            @if($pos<=6)
                                @if(!isset($elm["Reference"]) || !isset($elm["Address"]))
                                    @continue;
                                @endif
                                <div>
                                    <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                        <div class="date-box">
                                            <span>
                                                {{date('d/m/y', strtotime($elm["Date"]))}}
                                            </span>
                                        </div>
                                        <div class="adrbox">
                                            <span class="dateful">{{$elm["Reference"]}}</span>
                                            <span class="name">
                                                <p>
                                                    {!! $elm["Address"] !!}
                                                </p>
                                            </span>
                                        </div>
                                        <div  class="ownr-box planvald2">
                                            <p>
                                                {!! $elm["Proposal"] !!}
                                            </p>
                                        </div>
                                        <div class="outer-link">
                                            <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW RECORD</a>
                                        </div>
                                    </div>

                                </div>
                            @endif
                            @php $pos = $pos + 1; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    @endif
    
    @if(count($report['planning_validated'])>6)
        @php $ima = 6; $pag = 1; @endphp
        @for($i = 6; $i < count($planning_validated_array); $i+=6)
        <section class="sheet section sec16 sec-table moretabl desktop">
            <div class="inner vcenter">
                <div class="content-n">
                    <div class="container-bs">
                        <div class="txt1-group">
                            <h2>THIS WEEK IN {{$postcode}}</h2>
                            <h3>PLANNING APPLICATION VALIDATED - Page {{ $pag + 1}}</h3>
                        </div>
                        <div class="infogrey-table">

                            @php $pos = 1; $ostl = count(array_slice($planning_validated_array, $i, $ima)); @endphp
                            @foreach($planning_validated_array as $elm)
                                @if($pos>$i && $pos<=($i+$ima))
                                    @if(!isset($elm["Reference"]) || !isset($elm["Address"]))
                                        @continue;
                                    @endif
                                    <div>
                                        <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                            <div class="date-box">
                                                <span>
                                                    {{date('d/m/y', strtotime($elm["Date"]))}}
                                                </span>
                                            </div>
                                            <div class="adrbox">
                                                <span class="dateful">{{$elm["Reference"]}}</span>
                                                <span class="name">
                                                    <p>
                                                        {!! $elm["Address"] !!}
                                                    </p>
                                                </span>
                                            </div>
                                            <div  class="ownr-box planvald2">
                                                <p>
                                                    {!! $elm["Proposal"] !!}
                                                </p>
                                            </div>
                                            <div class="outer-link">
                                                <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW RECORD</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @php $pos = $pos + 1; @endphp
                            @endforeach
                            @php
                                $pag++;
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endfor
    @endif
     <!-- mobile table slider for planning validated -->
    {{-- @if(count($report['planning_validated']))
    <section id="secval" class="sheet section sec16 sec-table fit15 mobile">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="container-bs">
                    <div class="txt1-group">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                        <h3>Planning applications validated</h3>
                        <p>The properties below have had planning applications validated in the last seven days.</p>
                    </div>
                    <div class="infogrey-table infogrey-table-mobile">

                        @foreach($report['planning_validated'] as $elm)
                                <div>
                                    <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                        <div class="date-box">
                                            <span>
                                                {{date('d/m/y', ($elm["FIELD12"] ? strtotime($elm["FIELD12"]) : strtotime($elm["Date"]) ) )}}
                                            </span>
                                        </div>
                                        <div class="adrbox">
                                            <span class="dateful">{{$elm["Reference"]}}</span>
                                            <span class="name">
                                                <p>
                                                    {!! $elm["Address"] !!}
                                                </p>
                                            </span>
                                        </div>
                                        <div  class="ownr-box planvald2">
                                            <p>
                                                {!! $elm["Proposal"] !!}
                                            </p>
                                        </div>
                                        <div class="outer-link">
                                            <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW REPORT</a>
                                        </div>
                                    </div>

                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    @endif --}}


    @if(count($report['planning_decided']))
    <section id="secdec" class="sheet section sec17 sec-table fit15 desktop">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="container-bs">
                    <div class="txt1-group">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                        @if (count($planning_decided_array)>6)
                            <h3>PLANNING APPLICATIONS DECIDED - Page 1</h3>
                        @else
                            <h3>PLANNING APPLICATIONS DECIDED</h3>
                        @endif
                        <p>The properties have received decisions on their planning applications.</p>
                    </div>
                    <div class="infogrey-table">
                        @php $pos = 1;  $ostl = count(array_slice($planning_decided_array, 0, 6)); @endphp
                        @foreach($planning_decided_array as $elm)
                            @if($pos<=6)
                                @if(!isset($elm["Reference"]) || !isset($elm["Address"]))
                                    @continue;
                                @endif
                                <div>
                                    <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                        <div class="date-box">
                                            <span>
                                                {{date('d/m/y', strtotime($elm["Date"]))}}
                                            </span>
                                        </div>
                                        <div class="adrbox">
                                            <span class="dateful">{{$elm["Reference"]}}<span class="badge"> @if($elm["Decision"]) {{$elm["Decision"]}} @endif </span></span>
                                            <span class="name">
                                                <p>
                                                    {!! $elm["Address"] !!}
                                                </p>
                                            </span>
                                        </div>
                                        <div  class="ownr-box">
                                            <p>
                                                {!! $elm["Proposal"] !!}
                                            </p>
                                        </div>
                                        <div class="outer-link">
                                            <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW RECORD</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @php $pos = $pos + 1; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    @endif

    @if(count($report['planning_decided'])>6)
        @php $ima = 6; $pag = 1; @endphp
        @for($i = 6; $i < count($planning_decided_array); $i+=6)
            <section class="sheet section sec16 sec-table moretabl desktop">
                <div class="inner vcenter">
                    <div class="content-n">
                        <div class="container-bs">
                            <div class="txt1-group">
                                <h2>THIS WEEK IN {{$postcode}}</h2>
                                <h3>PLANNING APPLICATIONS DECIDED - Part {{ $pag + 1 }}</h3>
                            </div>
                            <div class="infogrey-table">

                                @php $pos = 1;  $ostl = count(array_slice($planning_decided_array, $i, $ima)); @endphp
                                @foreach($planning_decided_array as $elm)
                                    @if($pos>$i && $pos<=($i+$ima))
                                        @if(!isset($elm["Reference"]) || !isset($elm["Address"]))
                                            @continue;
                                        @endif
                                        <div>

                                            <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                                <div class="date-box">
                                                    <span>
                                                        {{date('d/m/y', strtotime($elm["Date"]))}}
                                                    </span>
                                                </div>
                                                <div class="adrbox">
                                                    <span class="dateful">{{$elm["Reference"]}}<span class="badge"> @if($elm["Decision"]) {{$elm["Decision"]}} @endif </span></span>
                                                    <span class="name">
                                                        <p>
                                                            {!! $elm["Address"] !!}
                                                        </p>
                                                    </span>
                                                </div>
                                                <div  class="ownr-box">
                                                    <p>
                                                        {!! $elm["Proposal"] !!}
                                                    </p>
                                                </div>
                                                <div class="outer-link">
                                                    <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW RECORD</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @php $pos = $pos + 1; @endphp
                                @endforeach
                                @php
                                    $pag++;
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endfor
    @endif

     <!-- mobile table slider for planning decided -->
    {{-- @if(count($report['planning_decided']))
    <section id="secdec" class="sheet section sec17 sec-table fit15 mobile">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="container-bs">
                    <div class="txt1-group">
                        <h2>THIS WEEK IN {{$postcode}}</h2>
                        <h3>Planning applications decided</h3>
                        <p>The properties have received decisions on their planning applications.</p>
                    </div>
                    <div class="infogrey-table infogrey-table-mobile">
                        @foreach($report['planning_decided'] as $elm)
                                <div>
                                    <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                        <div class="date-box">
                                            <span>
                                                {{date('d/m/y', ($elm["FIELD12"] ? strtotime($elm["FIELD12"]) : strtotime($elm["Date"]) ) )}}
                                            </span>
                                        </div>
                                        <div class="adrbox">
                                            <span class="dateful">{{$elm["Reference"]}}<span class="badge"> @if($elm["Decision"]) {{$elm["Decision"]}} @endif </span></span>
                                            <span class="name">
                                                <p>
                                                    {!! $elm["Address"] !!}
                                                </p>
                                            </span>
                                        </div>
                                        <div  class="ownr-box">
                                            <p>
                                                {!! $elm["Proposal"] !!}
                                            </p>
                                        </div>
                                        <div class="outer-link">
                                            <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW REPORT</a>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    @endif --}}
    <section id="sec18" class="sheet section sec18" style="background-image: url('{{$report['img7']}}');">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="container-bs">
                    <div class="txt1-group">
                        <h2>WE’D LOVE TO HEAR FROM YOU…</h2>
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <p>We hope you've found this issue of the "Sprift Insider" for the {{$postcode}} area useful. If you have any suggestions for future issues please email our team at <b>hello@sprift.com</b></p>
                <h4>Have a great week!</h4>
            </footer>
        </div>
    </section>
<script>
    $('.navsite').on('click', function(ev) {
        $('.mobheader').toggleClass('active')
    })
</script>
@endsection
