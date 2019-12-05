<?php

use Illuminate\Database\Seeder;
use App\Postcode;

class PostcodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$postlist = array(
    		'BH14',
    		'BL9',
    		'BN17',
    		'CM21',
    		'CV5',
    		'DA12',
    		'DE1',
    		'DE14',
    		'DE21',
    		'HP1',
    		'KT5',
    		'KT12',
    		'L1',
    		'LE8',
    		'M34',
    		'OX2',
    		'OX4',
    		'SM5',
    		'TS9',
    		'W2'
    	);

    	foreach ($postlist as $pid) {
	       Postcode::create([
	       	'postcode' => $pid,
	       	'nice_name' => $pid
	       ]);
    	}
    }
}
