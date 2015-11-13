<?php

use Illuminate\Database\Seeder;

class questionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$inquiry                    = new Inquiry;

       	$inquiry->question          = "Who was the 3rd Doctor?";
        $inquiry->awnser            = "Jon Pertwee";
        $inquiry->option1           = "Matt Smitt";
        $inquiry->option2           = "That one British Guy!";
        $inquiry->option3           = "David Tannent";
        $inquiry->start             = "2015-11-13 00:00:00";
        $inquiry->stop              = "2015-11-18 00:00:00"; 
        
        $inquiry->save();
    }
}
