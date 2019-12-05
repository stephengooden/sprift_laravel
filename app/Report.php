<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'uid',
        'weekdate', 
        'postcode',
        'weekid',
        'details'
    ];

	/*
    protected $casts = [
        'details' => 'array',
    ];
    */


    public function getDetailsAttribute($details)
    {
    	$report_data = json_decode($details, true);

    	if(!isset($report_data['img1'])) {
			$report_data['img1'] = asset('images/default/1.jpg');
    	}
    	if(!isset($report_data['img2'])) {
			$report_data['img2'] = asset('images/default/2.jpg');
    	}
    	if(!isset($report_data['img3'])) {
			$report_data['img3'] = asset('images/default//3.jpg');
    	}
    	if(!isset($report_data['img4'])) {
			$report_data['img4'] = asset('images/default/4.jpg');
    	}
    	if(!isset($report_data['img5'])) {
			$report_data['img5'] = asset('images/default/5.jpg');
    	}
    	if(!isset($report_data['img6'])) {
			$report_data['img6'] = asset('images/default/6.jpg');
    	}
    	if(!isset($report_data['img7'])) {
			$report_data['img7'] = asset('images/default/7.jpg');
    	}
        if(!isset($report_data['recently_listed'])) {
            $report_data['recently_listed'] = [];
        }
        if(!isset($report_data['salesbytype'])) {
            $report_data['salesbytype'] = [];
        }
        if(!isset($report_data['recently_reduced'])) {
            $report_data['recently_reduced'] = [];
        }
        if(!isset($report_data['salesbyvalue'])) {
            $report_data['salesbyvalue'] = [];
        }
        if(!isset($report_data['rentalsbytype'])) {
            $report_data['rentalsbytype'] = [];
        }
        if(!isset($report_data['rentalsbyvalue'])) {
            $report_data['rentalsbyvalue'] = [];
        }
        if(!isset($report_data['by_agent'])) {
            $report_data['by_agent'] = [];
        }
        if(!isset($report_data['most_viewed'])) {
            $report_data['most_demanded'] = [];
        }
        if(!isset($report_data['most_demanded'])) {
            $report_data['most_demanded'] = [];
        }
        if(!isset($report_data['planning_validated'])) {
            $report_data['planning_validated'] = [];
        }
        if(!isset($report_data['planning_decided'])) {
            $report_data['planning_decided'] = [];
        }
        if(!isset($report_data['summary'])) {
            $report_data['summary'] = [
                "Postcode" => '-',
                "Date" => '-',
                "Rightmove" => 0,
                "Zoopla" => 0,
                "On The Market" => 0,
                "Sales Area" => '-',
                "Sales Agency" => '-',
                "Lettings Area" => '-',
                "Lettings Agency" => '-',
                "Ranking Sales" => '-',
                "Ranking Lettings" => '-',
            ];
        }
//var_dump($report_data['recently_listed']);

    	return $report_data;
    }
}
