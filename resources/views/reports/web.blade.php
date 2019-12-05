@extends('layouts.reports-' . $outer)

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
                    <img src="{{ asset('images/header-img.png') }}">
                </div>
            </header>
            <div class="content">
                <div class="container">
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

    <section id="sec2" class="sheet section sec2">
        <div class="inner vcenter">
            <header class="sec-header">
            </header>
            <div class="container-bs">
                <div class="container">
                    <div class="txt-group">
                        <h2>Welcome to this week’s “Sprift Insider” for {{$postcode}}</h2>
                        <p>
                            The "Sprift Insider" report is a vital resource for leading property professionals who need access to the latest and most accurate information about their local market.
                        </p>
                        <p>
                            During our many conversations with local agents, we realised a major frustration with other property market reports is the age and accuracy of the data.
                        </p>
                    </div>
                    <div class="txt-group">
                        <h3>ENSURING ACCURACY OF OUR DATA </h3>
                        <p>To counter this problem and maximize the value of our information to you and your clients, we create this report within 24 hours of updating our data vault from the portals and local estate agent websites.</p>
                        <p>
                            We then take care to remove any duplicate listings to give you a clear, simple and true picture of the latest property updates in your local market area including detailed reports on all new listings, price reductions, sales, fall-throughs and planning applications.
                        </p>
                    </div>

                    <div class="txt-group mb-0">
                        <h3>WHERE DOES YOUR AGENCY RANK?</h3>
                        <p>To fire your competitive spirit we have also developed a market share ranking for estate agencies in the {{$postcode}} area –  so scroll down to discover if you have bragging rights this week! If you have any questions on the data included in this report or suggestions for information you’d like included in future issues please email us at hello@sprift.com.</p>
                    </div>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center good-week">Have a good week - we'll send you your updated report next week! </div>
                <div class="text-center dark-text">sprift.com</div>
            </footer>
        </div>
    </section>

    <section id="sec2" class="sheet section sec3" style="background-image: url('{{$report['img2']}}');">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="yellow-banner">
                    <h2>{{$postcode}} MARKET SUMMARY REPORT</h2>
                    <h3>{{$fromTo}}</h3>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>

    <section id="sec4" class="sheet section sec-tables1 sec4">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <h2>SUMMARY</h2>
                <h3>MARKET MOVEMENTS FOR {{$postcode}}</h3>
                <div class="table-summary">
                    <div class="inforow">
                        <div class="wtx">Total</div>
                        <div class="mdl"></div>
                        <div class="wtx">Weekly Change</div>
                    </div>
                    <div class="datarows">
                        <div class="datarow">
                            <div class="numbr">{{-- {{ $report['summary']['for_sale'] }} --}}</div>
                            <div class="labl">For Sale</div>
                            <div class="numbr {{-- {{ $report['summary']['for_sale_change'] >= 0 ? ( $report['summary']['for_sale_change'] == 0 ? 'same' : 'pos' ) : 'neg' }} --}}">{{-- {{ $report['summary']['for_sale_change'] >= 0 ? ( $report['summary']['for_sale_change'] == 0 ? 'NO CHANGE' : '+' . $report['summary']['for_sale_change'] ) : '' .$report['summary']['for_sale_change'] }} --}}</div>
                        </div>
                        <div class="datarow">
                            <div class="numbr">{{ $report['summary']['for_sale'] }}</div>
                            <div class="labl"><img src="{{ asset('images/rightmove.png') }}"></div>
                            <div class="numbr {{ $report['summary']['for_sale_change'] >= 0 ? ( $report['summary']['for_sale_change'] == 0 ? 'same' : 'pos' ) : 'neg' }}">{{ $report['summary']['for_sale_change'] >= 0 ? ( $report['summary']['for_sale_change'] == 0 ? 'NO CHANGE' : '+' . $report['summary']['for_sale_change'] ) : '' .$report['summary']['for_sale_change'] }}</div>
                        </div>
                       {{--  <div class="datarow">
                            <div class="numbr">{{ count($report['recently_reduced']) }}</div>
                            <div class="labl"><img src="{{ asset('images/zoopla.png') }}"></div>
                            <div class="numbr {{ $report['summary']['reduced_change'] >= 0 ? ( $report['summary']['reduced_change'] == 0 ? 'same' : 'pos' ) : 'neg' }}">{{ $report['summary']['reduced_change'] >= 0 ? ( $report['summary']['reduced_change'] == 0 ? 'NO CHANGE' : '+' . $report['summary']['reduced_change'] ) : '' .$report['summary']['reduced_change'] }}</div>
                        </div> --}}
                    {{--     <div class="datarow">
                            <div class="numbr">{{ $report['summary']['sold_sstc'] }}</div>
                            <div class="labl"><img src="{{ asset('images/otm.png') }}"></div>
                            <div class="numbr {{ $report['summary']['sold_sstc_change'] >= 0 ? ( $report['summary']['sold_sstc_change'] == 0 ? 'same' : 'pos' ) : 'neg' }}">{{ $report['summary']['sold_sstc_change'] >= 0 ? ( $report['summary']['sold_sstc_change'] == 0 ? 'ACQUIRING DATA' : '+' . $report['summary']['sold_sstc_change'] ) : '' .$report['summary']['sold_sstc_change'] }}</div>
                        </div> --}}
                        <div class="datarow">
                            <div class="numbr">{{ count($report['recently_listed']) }}</div>
                            <div class="labl">New Listings</div>
                            <div class="numbr {{ $report['summary']['new_listing_change'] >= 0 ? ( $report['summary']['new_listing_change'] == 0 ? 'same' : 'pos' ) : 'neg' }}">{{ $report['summary']['new_listing_change'] >= 0 ? ( $report['summary']['new_listing_change'] == 0 ? 'NO CHANGE' : '+' . $report['summary']['new_listing_change'] ) : '' .$report['summary']['new_listing_change'] }}</div>
                        </div>
                        <div class="datarow">
                            <div class="numbr">{{ count($report['recently_reduced']) }}</div>
                            <div class="labl">Reduced</div>
                            <div class="numbr {{ $report['summary']['reduced_change'] >= 0 ? ( $report['summary']['reduced_change'] == 0 ? 'same' : 'pos' ) : 'neg' }}">{{ $report['summary']['reduced_change'] >= 0 ? ( $report['summary']['reduced_change'] == 0 ? 'NO CHANGE' : '+' . $report['summary']['reduced_change'] ) : '' .$report['summary']['reduced_change'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
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
    -->

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
    
    <!-- New page with graph lister for sale and lister for rent , scheduled for next week -->
{{--     <section id="sec7" class="sheet section sec7">
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
                            <h3>LISTED FOR SALE</h3>
                            <p>The chart below shows the number of sales listings in the {{$postcode}} area by property category</p>
                            <div class="graph-box">
                                <div id="listed-for-sale" class="chart"></div>
                            </div>
                        </div>
                        <div class="half-ofrow">
                            <h3>LISTED FOR RENT</h3>
                            <p>The chart below shows the number of rental listings in the {{$postcode}} area by property value.</p>
                            <div class="graph-box">
                                <div id="listed-for-rent" class="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section id="sec27 "class="sheet section sec27">
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
                            <h3>PROPERTIES CURRENTLY LISTED</h3>
                            <p>The chart below shows the number of total listings in the {{$postcode}} area by property category</p>
                            <div class="graph-box">
                                <div id="listed-propreties-bar" class="chart"></div>
                            {{--     <div id="props-bygroup2" style="display: none"></div>
                                <canvas id="props-bygroup"></canvas> --}}
                            </div>
                        </div>
                        <div class="half-ofrow">
                            <h3>NEW LISTINGS BY VALUE</h3>
                            <p>The chart below shows the number of new listings in the {{$postcode}} area by property value.</p>
                            <div class="graph-box">
                                <div id="listed-propreties-by-value-bar" class="chart"></div>
                           {{--      <div id="props-byvalue2" style="display: none"></div>
                                <canvas id="props-byvalue"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                    <h3>Market share by agent</h3>
                    <p>How does your agency compare against your competitors this week?  Here are the top agents serving {{$postcode}} by market share.</p>
                    <div class="graph-box" style="margin-top: 30px">
                        <div id="agency-bar" style="min-width: 310px; max-width: 100%; height: auto;"></div>
                        <div style="display:none" id="props-byagencywin"></div>
                        <canvas id="props-byagency" width="800" height="500"></canvas>
                    </div>
                </div>
            </div>
            <div class="half-ofrow first-ofrow thiweekbg halfaimg bottom-image" style="background-size: cover; background-repeat: no-repeat; display: none; background-image: url('{{asset('/images/default/key.jpg')}}')">
            </div>
        </div>
    </section>

    <section id="sec9" class="sheet section sec9">
        <div class="rowflex fullh">
            <div class="half-ofrow first-ofrow thiweekbg">
                <div class="right-inner">
                    <div class=" logo-wrap mb-30">
                        <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                    </div>
                    <h2>THIS WEEK IN {{$postcode}}</h2>
                    <h3>SUPPLY vs DEMAND ANALYSIS</h3>
                    <p>To give you a picture of the properties currently listed and demand for those, we've ranked the top property types by the number of listings versus number of viewings.  Over time this data should tell you which properties you need to be including and/or focusing on your within your marketing.</p>

                    <h4>PROPERTY CATEGORY RANKED BY:</h4>
                    <div class="rowflex">
                        <div class="half-ofrow supply">
                            <h5>LISTINGS <span>(SUPPLY)</span></h5>
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
                                <h5>VIEWINGS <span>(DEMAND)</span></h5>
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

    <section id="sec10" class="sheet section sec10 sec-middle" style="background-image: url('{{$report['img5']}}');">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="yellow-banner">
                    <h2>THIS WEEK IN {{$postcode}}: LISTINGS REPORT</h2>
                    <h3>{{$fromTo}}</h3>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
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
                        <h3>New Listings</h3>
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
                                            @if(is_numeric($elm["Bedroom_Number"]))
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
                                            <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW REPORT</a>
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
                                <h3>New Listings - Page {{ $pag }}</h3>
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
                                                    @if(is_numeric($elm["Bedroom_Number"]))
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
                                                    <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW REPORT</a>
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
        
       {{--  @php $ima = 20; $pag = 1; @endphp
        @for($i = 6; $i < count($report['recently_listed']); $i+=20) --}}

          <!--   Mobile slider for recently lister reports
          <div id="sec20" class="sec20 sec-table mobile-section mobile">
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
                               <h3>New Listings</h3>
                               <p>Below is an overview of the most recent new listings in the {{$postcode}} area including price and agent</p>
                           </div>
                           <div class="infogrey-table infogrey-table-mobile">
          
                             {{--   @php $pos = 1; $ostl = count(array_slice($report['recently_listed'], $i, ($ima)));  @endphp --}}
                               @foreach($report['recently_listed'] as $elm)
                                       <div>
                                           <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                               <div class="date-box">
                                                   <span>
                                                       {{$elm["Date"]}}
                                                   </span>
                                               </div>
                                               <div class="adrbox">
                                                   @if(is_numeric($elm["Bedroom_Number"]))
                                                       <span class="type">{{$elm["Bedroom_Number"]}}-Bedroom {{$elm["Property_Type"]}}</span>
                                                   @else
                                                       <span class="type">{{$elm["Bedroom_Number"]}}</span>
                                                   @endif
                                                   <span class="name">
                                                       <p>
                                                           {!!strlen($elm["Address"]) > ($ostl<5 ? 75 : 120) ? substr($elm["Address"],0,($ostl<5 ? 75 : 120)).'...' :$elm["Address"] !!}
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
                                                       {!!strlen($elm["Agent1"]) > ($ostl<5 ? 20 : 30) ? substr($elm["Agent1"],0,($ostl<5 ? 20 : 30)).'...' :$elm["Agent1"] !!}
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
               </div>
           </div> -->



    <!--
    <section class="sheet section sec12 sec-table">
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
                        <h3>Sold STC</h3>
                        <p>The properties below have all gone under offer in the past seven days. </p>
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
                        <h3>Price Reductions</h3>
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
                                            @if(is_numeric($elm["Bedroom_Number"]))
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
                                            <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW REPORT</a>
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
                                <h3>Price Reductions - Page {{ $pag }}</h3>
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
                                                    @if(is_numeric($elm["Bedroom_Number"]))
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
                                                    <a class="outer-dirlink" href="{{$elm["URL"]}}">VIEW REPORT</a>
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
                        <h3>Price Reductions</h3>
                        <p>The properties below have all been reduced in price over the past seven days.</p>
                   </div>
                    <div class="infogrey-table infogrey-table-mobile">

                        @foreach($report['recently_reduced'] as $elm)
                                <div>
                                    <div class="infogrey-table-row {{($ostl<5 ? 'bigit' : '')}}">
                                        <div class="date-box">
                                            <span>
                                                {{$elm["Date"]}}
                                            </span>
                                        </div>
                                        <div class="adrbox">
                                            @if(is_numeric($elm["Bedroom_Number"]))
                                                <span class="type">{{$elm["Bedroom_Number"]}}-Bedroom {{$elm["Property_Type"]}}</span>
                                            @else
                                                <span class="type">{{$elm["Bedroom_Number"]}}</span>
                                            @endif
                                            <span class="name">{!!strlen($elm["Address"]) > ($ostl<5 ? 75 : 120) ? substr($elm["Address"],0,($ostl<5 ? 75 : 120)).'...' :$elm["Address"] !!}</span>
                                        </div>
                                        <div class="pricebox">
                                            <span>
                                                {{$elm["Guide_Price"]}}
                                            </span>
                                        </div>
                                        <div  class="ownr-box">
                                            <p>
                                                {!!strlen($elm["Agent1"]) > ($ostl<5 ? 20 : 30)  ? substr($elm["Agent1"],0,($ostl<5 ? 20 : 30) ).'...' :$elm["Agent1"] !!}
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

    @if(count($report['planning_validated']) || count($report['planning_decided']))
    <section id="secvals" class="sheet section sec15 sec-middle" style="background-image: url('{{$report['img6']}}');">
        <div class="inner vcenter">
            <header class="sec-header">
                <div class="text-center">
                    <img src="/img/logo_white.svg" alt="" class="sprift-logo"/>
                </div>
            </header>
            <div class="content">
                <div class="yellow-banner">
                    <h2>THIS WEEK IN {{$postcode}}: PLANNING APPLICATIONS REPORT</h2>
                    <h3>{{$fromTo}}</h3>
                </div>
            </div>
            <footer class="sec-footer">
                <div class="text-center white-text">sprift.com</div>
            </footer>
        </div>
    </section>
    @endif

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
                        <h3>Planning applications validated</h3>
                        <p>The properties below have had planning applications validated in the last seven days.</p>
                    </div>
                    <div class="infogrey-table">

                        @php $pos = 1;  $ostl = count(array_slice($planning_validated_array, 0, 6)); @endphp
                        @foreach($planning_validated_array as $elm)
                            @if($pos<=6)
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
                            <h3>Planning applications validated - Page {{ $pag }}</h3>
                        </div>
                        <div class="infogrey-table">

                            @php $pos = 1; $ostl = count(array_slice($planning_validated_array, $i, $ima)); @endphp
                            @foreach($planning_validated_array as $elm)
                                @if($pos>$i && $pos<=($i+$ima))
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
                        <h3>Planning applications decided</h3>
                        <p>The properties have received decisions on their planning applications.</p>
                    </div>
                    <div class="infogrey-table">
                        @php $pos = 1;  $ostl = count(array_slice($planning_decided_array, 0, 6)); @endphp
                        @foreach($planning_decided_array as $elm)
                            @if($pos<=6)
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
                                <h3>Planning applications decided - Page {{ $pag }}</h3>
                            </div>
                            <div class="infogrey-table">

                                @php $pos = 1;  $ostl = count(array_slice($planning_decided_array, $i, $ima)); @endphp
                                @foreach($planning_decided_array as $elm)
                                    @if($pos>$i && $pos<=($i+$ima))
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
