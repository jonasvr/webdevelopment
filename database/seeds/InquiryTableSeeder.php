<?php

use Illuminate\Database\Seeder;
use App\Inquiry;
use Carbon\Carbon;



class InquiryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$start = Carbon::today();
        $stop   =  Carbon::today()->addWeek();

        $inquiry                    = new Inquiry;

       	$inquiry->question          = "Who was the 3rd Doctor?";
        $inquiry->awnser            = "Jon Pertwee";
        $inquiry->option1           = "Matt Smitt";
        $inquiry->option2           = "That one British Guy!";
        $inquiry->option3           = "David Tannent";
        $inquiry->start             = $start;
        $inquiry->stop              = $stop; 
        
        $inquiry->save();
    }
}
