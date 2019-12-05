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
        if(!isset($report_data['most_viewed'])) {
            $report_data['most_viewed'] = ['Nothing listed' => '0'];
        }
        if(!isset($report_data['most_demanded'])) {
            $report_data['most_demanded'] = ['Nothing listed' => '0'];
        }
        if(!isset($report_data['recently_listed'])) {
            $report_data['recently_listed'] = [];
        }
        if(!isset($report_data['listing'])) {
            $report_data['listing'] = [];
        }
        if(!isset($report_data['by_agent'])) {
            $report_data['by_agent'] = [];
        }
        if(!isset($report_data['by_value'])) {
            $report_data['by_value'] = [];
        }
        if(!isset($report_data['by_agent'])) {
            $report_data['by_agent'] = [];
        }
        if(!isset($report_data['planning_validated'])) {
            $report_data['planning_validated'] = [];
        }
        if(!isset($report_data['planning_decided'])) {
            $report_data['planning_decided'] = [];
        }

        if(!isset($report_data['summary'])) {
            $report_data['summary'] = [
                'for_sale' => 0,
                'for_sale_change' => 0,
                'new_listing' => 0,
                'new_listing_change' => 0,
                'reduced' => 0,
                'reduced_change' => 0,
                'sold_sstc' => '-',
                'sold_sstc_change' => 0,
                'withdraw' => '-',
                'withdraw_change' => 0,
                'fall_through' => '-',
                'fall_through_change' => 0,
                'app_subm' => '-',
                'app_subm_change' => 0,
                'app_subm' => '-',
                'app_decided_change' => 0
            ];
        }
//var_dump($report_data['recently_listed']);

    	return $report_data;
    }
}
