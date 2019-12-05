<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Postcode;
use PDF;

class ReportnewController extends Controller
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

        return view('reportsnew.web', $data);
    }
}
