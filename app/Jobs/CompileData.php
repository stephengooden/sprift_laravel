<?php

namespace App\Jobs;
use App\ScrappedData;
use App\EstateData;
use App\BaseData;
use App\DemandData;
use App\PlannedData;

class CompileData
{

    protected $postcode;
    protected $weekdate;

    public function __construct($postcode, $weekdate)
    {
        $this->postcode = $postcode;
        $this->weekdate = $weekdate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // get the data from scrapped data, parse it here based on weekdate (when it was added?) and postcode, and make reports based on it @Amar ?

        $parsed = new \stdClass();

        if(file_exists(public_path().'/img/'.($this->postcode).'/'.($this->postcode).'aa.jpg')) {
            $parsed->img1 = asset('img/'.($this->postcode).'/'.($this->postcode).'aa.jpg');
            $parsed->img2 = asset('img/'.($this->postcode).'/'.($this->postcode).'bb.jpg');
            $parsed->img3 = asset('img/'.($this->postcode).'/'.($this->postcode).'cc.jpg');
            $parsed->img4 = asset('img/'.($this->postcode).'/'.($this->postcode).'dd.jpg');
            $parsed->img5 = asset('img/'.($this->postcode).'/'.($this->postcode).'ee.jpg');
            $parsed->img6 = asset('img/'.($this->postcode).'/'.($this->postcode).'ff.jpg');
            $parsed->img7 = asset('img/'.($this->postcode).'/'.($this->postcode).'gg.jpg');
        }

        // HERE IS AN EXAMPLE OF WHAT IT SHOULD DO BELOW
        // It should basically return $details for a report that will be used in the views
        $basedat = BaseData::where('Postcode', $this->postcode)->first();
        if($basedat) {
            $parsed->summary = [
                'for_sale' => $basedat->Total_For_Sale,
                'for_sale_change' => $basedat->Weekly_Change,
                'new_listing' => $basedat->New_listings,
                'new_listing_change' => $basedat->Weekly_Change2,
                'reduced' => $basedat->Reduced,
                'reduced_change' => $basedat->Weekly_Change3,
                'sold_sstc' => '-',
                'sold_sstc_change' => 0,
                'withdraw' => '-',
                'withdraw_change' => 0,
                'fall_through' => '-',
                'fall_through_change' => 0,
                'app_subm' => '-',
                'app_subm_change' => 0,
                'app_decided' => '-',
                'app_decided_change' => 0

            ];
            $parsed->total_estate = $basedat['Total'];
            //BH14aa.jpg
            $parsed->most_viewed = [];
            $parsed->most_viewed['1 Bedroom Flat'] = $basedat['1_Bedroom_Flat'];
            $parsed->most_viewed['2 Bedroom Flat'] = $basedat['2_Bedroom_Flat'];
            $parsed->most_viewed['3 Bedroom Flat'] = $basedat['3_Bedroom_Flat'];
            $parsed->most_viewed['3 Bedroom Flat+'] = $basedat['3p_Bedroom_Flat'];
            $parsed->most_viewed['1 Bedroom House'] = $basedat['1_Bedroom_House'];
            $parsed->most_viewed['2 Bedroom House'] = $basedat['2_Bedroom_House'];
            $parsed->most_viewed['3 Bedroom House'] = $basedat['3_Bedroom_House'];
            $parsed->most_viewed['4 Bedroom House'] = $basedat['4_Bedroom_House'];
            $parsed->most_viewed['5 Bedroom House'] = $basedat['5_Bedroom_House'];
            $parsed->most_viewed['5 Bedroom House+'] = $basedat['5p_Bedroom_House'];
            $parsed->most_viewed['Land'] = $basedat['Land'];
            $parsed->most_viewed['Plot'] = $basedat['Plot'];
            $parsed->most_viewed['Block of Flats'] = $basedat['Block_of_Flats'];
            $parsed->most_viewed['Studio Flat'] = $basedat['Studio_Flat'];

            $parsed->Estate_Agents_In_Area = $basedat['No_Estate_Agents_In_Area'];

            $parsed->listing = $parsed->most_viewed;
            arsort($parsed->listing);

            arsort($parsed->most_viewed);

        }

        $basedat = DemandData::where('Postcode', $this->postcode)->first();
        if($basedat) {
            //BH14aa.jpg
            $parsed->most_demanded = [];
            $parsed->most_demanded['1 Bedroom Flat'] = $basedat['1_Bedroom_Flat'];
            $parsed->most_demanded['2 Bedroom Flat'] = $basedat['2_Bedroom_Flat'];
            $parsed->most_demanded['3 Bedroom Flat'] = $basedat['3_Bedroom_Flat'];
            $parsed->most_demanded['3 Bedroom Flat+'] = $basedat['3p_Bedroom_Flat'];
            $parsed->most_demanded['1 Bedroom House'] = $basedat['1_Bedroom_House'];
            $parsed->most_demanded['2 Bedroom House'] = $basedat['2_Bedroom_House'];
            $parsed->most_demanded['3 Bedroom House'] = $basedat['3_Bedroom_House'];
            $parsed->most_demanded['4 Bedroom House'] = $basedat['4_Bedroom_House'];
            $parsed->most_demanded['5 Bedroom House'] = $basedat['5_Bedroom_House'];
            $parsed->most_demanded['5 Bedroom House+'] = $basedat['5p_Bedroom_House'];
            $parsed->most_demanded['Land'] = $basedat['Land'];
            $parsed->most_demanded['Studio Flat'] = $basedat['Studio_Flat'];
            $parsed->most_demanded['Block of Flats'] = $basedat['Block_of_Flats'];

            arsort($parsed->most_demanded);

        }


            $parsed->by_value = [];
            $parsed->by_value['£0 - £100k'] = ScrappedData::where('Postcode', 'like', $this->postcode.'%')->where('Int_Price','>','0')->where('Int_Price','<','100000')->count();
            $parsed->by_value['£100k - £200k'] = ScrappedData::where('Postcode', 'like', $this->postcode.'%')->where('Int_Price','>','100000')->where('Int_Price','<','200000')->count();
            $parsed->by_value['£200k - £300k'] = ScrappedData::where('Postcode', 'like', $this->postcode.'%')->where('Int_Price','>','200000')->where('Int_Price','<','300000')->count();
            $parsed->by_value['£300k - £400k'] = ScrappedData::where('Postcode', 'like', $this->postcode.'%')->where('Int_Price','>','300000')->where('Int_Price','<','400000')->count();
            $parsed->by_value['£400k - £500k'] = ScrappedData::where('Postcode', 'like', $this->postcode.'%')->where('Int_Price','>','400000')->where('Int_Price','<','500000')->count();
            $parsed->by_value['£500k - £700k'] = ScrappedData::where('Postcode', 'like', $this->postcode.'%')->where('Int_Price','>','500000')->where('Int_Price','<','700000')->count();
            $parsed->by_value['£700k - £1m'] = ScrappedData::where('Postcode', 'like', $this->postcode.'%')->where('Int_Price','>','700000')->where('Int_Price','<','1000000')->count();
            $parsed->by_value['£1m+'] = ScrappedData::where('Postcode', 'like', $this->postcode.'%')->where('Int_Price','>','1000000')->count();

            $topTen  = EstateData::where('Postcode', $this->postcode)
                ->orderBy('Total','DESC')->take(10)->get();
            $parsed->by_agent = [];
            foreach($topTen as $est) {
                $parsed->by_agent[str_replace($this->postcode.' ', '', $est->Estate_Agent)] = $est->Total;
            }
            arsort($parsed->by_agent);
            $parsed->recently_listed = [];
            if(ScrappedData::where('Postcode', 'like', $this->postcode.'%')->where('Property_Tag','Added')->count()) {
                $listdat = ScrappedData::where('postcode', 'like', $this->postcode.'%')->where('Property_Tag','Added')->get();
                $parsed->recently_listed = $listdat->toArray();
            }

            $parsed->recently_reduced = [];
            if(ScrappedData::where('Postcode', 'like', $this->postcode.'%')->where('Property_Tag','Reduced')->count()) {
                $listdat = ScrappedData::where('postcode', 'like', $this->postcode.'%')->where('Property_Tag','Reduced')->get();
                $parsed->recently_reduced = $listdat->toArray();
            }

            $parsed->planning_decided = [];
            if(PlannedData::where('Postcode_Area', 'like', $this->postcode.'%')->where('Status', 'Decided')->count()) {
                $listdat = PlannedData::where('Postcode_Area', 'like', $this->postcode.'%')->where('Status', 'Decided')->get();
                $parsed->planning_decided = $listdat->toArray();
            }
            $parsed->planning_validated = [];
            if(PlannedData::where('Postcode_Area', 'like', $this->postcode.'%')->where('Status', 'Validated')->count()) {
                $listdat = PlannedData::where('Postcode_Area', 'like', $this->postcode.'%')->where('Status', 'Validated')->get();
                $parsed->planning_validated = $listdat->toArray();
            }

            return $parsed;
    }
}
