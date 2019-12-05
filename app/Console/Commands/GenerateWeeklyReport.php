<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Report;
use App\Postcode;
use App\Jobs\CompileData;

class GenerateWeeklyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:weekly-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate weekly report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $weekid = uniqid();
        $weekdate = date( 'Y-m-d', strtotime( 'thursday last week' ) );   //friday last week, friday this week

        Postcode::chunk(100, function($results) use($weekdate, $weekid) {
            foreach($results as $postcode) {
                    $report = Report::where('postcode', $postcode->postcode)->where('weekdate', $weekdate)->first();
                if($report === null) {
                    $report = Report::create([
                        'uid' => uniqid(),
                        'weekid' => $weekid,
                        'weekdate' => $weekdate,
                        'postcode' => $postcode->postcode,
                        'details' => json_encode((new CompileData($postcode->postcode, $weekdate))->handle())
                    ]);
                } else {
                    $rp = $report->update([
                        'postcode' => $postcode->postcode,
                        'details' => json_encode((new CompileData($postcode->postcode, $weekdate))->handle())
                    ]);
                }
                if (!file_exists(public_path().'/pdf/'.$weekdate)) {
                    mkdir(public_path().'/pdf/'.$weekdate, 0777, true);
                }
                $elm = 'google-chrome --headless --disk-cache-size=0 --print-to-pdf="'.public_path().'/pdf/'.$weekdate.'/'.$report->uid.'.pdf" '.url('/r-pdf/'.$postcode->postcode.'/'.$weekdate);
                $this->info($elm);
                shell_exec($elm);
            }

        });
    }
}
