<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Postcode;
use PDF;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index_uid($uid)
    {

        $report = Report::where('uid', $uid)->first();
        
        if(!$report) {
            abort(404);
        }

        $data = [
            'outer' => 'web',
            'postcode' => $report->postcode,
            'weekdate' => $report->weekdate,
            'fromTo' => date( 'd F Y', strtotime( 'friday last week',  strtotime($report->weekdate) ) ) . ' - ' .date( 'd F Y', strtotime( 'thursday this week', strtotime($report->weekdate) ) ), // 26 December 2018 - 4 January 2019
            'report' => $report->details
        ];

        return view('reports.web', $data);
    }
    public function index_safe($postcode, $weekid)
    {

        $report = Report::where('postcode', $postcode)->where('weekid', $weekid)->first();

        if(!$report) {
            abort(404);
        }

        $data = [
            'outer' => 'web',
            'postcode' => $postcode,
            'weekdate' => $report->weekdate,
            'fromTo' => date( 'd F Y', strtotime( 'friday last week',  strtotime($report->weekdate) ) ) . ' - ' .date( 'd F Y', strtotime( 'friday this week', strtotime($report->weekdate) ) ), // 26 December 2018 - 4 January 2019
            'report' => $report->details
        ];

        return view('reports.web', $data);
    }

    public function index($postcode, $weekdate = null)
    {
    	if(!$weekdate) {
    		$weekdate = date( 'Y-m-d', strtotime( 'friday this week' ) );
    	}

    	$report = Report::where('postcode', $postcode)->where('weekdate', $weekdate)->first();

    	if(!$report) {
    		abort(404);
    	}

    	$data = [
            'outer' => 'web',
    		'postcode' => $postcode,
    		'weekdate' => $weekdate,
            'fromTo' => date( 'd F Y', strtotime( 'friday last week',  strtotime($report->weekdate) ) ) . ' - ' .date( 'd F Y', strtotime( 'friday this week', strtotime($report->weekdate) ) ), // 26 December 2018 - 4 January 2019
            'report' => $report->details
    	];

        return view('reports.web', $data);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function plain($postcode, $weekdate = null)
    {
        if(!$weekdate) {
            $weekdate = date( 'Y-m-d', strtotime( 'friday this week' ) );
        }

        $report = Report::where('postcode', $postcode)->where('weekdate', $weekdate)->first();

        if(!$report) {
            abort(404);
        }

        $data = [
            'outer' => 'plain',
            'postcode' => $postcode,
            'weekdate' => $weekdate,
            'fromTo' => date( 'd F Y', strtotime( 'friday last week',  strtotime($report->weekdate) ) ) . ' - ' .date( 'd F Y', strtotime( 'friday this week', strtotime($report->weekdate) ) ), // 26 December 2018 - 4 January 2019
            'report' => $report->details
        ];

        return view('reports.web', $data);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pdf($postcode, $weekdate = null)
    {
        if(!$weekdate) {
            $weekdate = date( 'Y-m-d', strtotime( 'friday this week' ) );
        }

        $report = Report::where('postcode', $postcode)->where('weekdate', $weekdate)->first();

        if(!$report) {
            abort(404);
        }

        $data = [
            'outer' => 'pdf',
            'postcode' => $postcode,
            'weekdate' => $weekdate,
            'fromTo' => date( 'd F Y', strtotime( 'friday last week',  strtotime($report->weekdate) ) ) . ' - ' .date( 'd F Y', strtotime( 'friday this week', strtotime($report->weekdate) ) ), // 26 December 2018 - 4 January 2019
            'report' => $report->details
        ];

        return view('reports.pdf', $data);
    }

    public function download_pdf($uid)
    {
        $report = Report::where('uid', $uid)->first();

        if(!$report) {
            abort(404);
        }

        return redirect(url('/pdf/'.$report->weekdate).'/'.$report->uid.'.pdf');
    }
}
