<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
//added
use DB;
use Carbon\Carbon;
use App\Winners;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            

            $awnsers= DB::table('users')
                    ->join('awnsers', 'users.id', '=', 'awnsers.FK_user')
                    ->where('awnsers.created_at','>=',Carbon::today())
                    ->select('users.name','users.surname')
                    ->get();

            $file = fopen('deelnemersVndg.csv', 'w');
            $csv = array();

            foreach ($awnsers as $row) {
                 $csv[]=array("name" => $row->name,"surname" => $row->surname);
                 fputcsv($file, $csv);
            }
            fclose($file);

            //send mail-----------------
                

        $users = DB::table('users')
                ->whereNotNull('admin')
                ->get();

        foreach($users as $user)
        {
            $data = ['user' => $user];

           
            Mail::send('mail', $data, function ($message) {
                $message->from('contest@stuff.com', 'contest.stuff');
                $message->attach("deelnemersVndg.csv");
                $message->to('jonasvanreeth@gmail.com')->cc('bar@example.com');
            });
        }

        })->dailyAt('23:59');


//FIND WINNERS------------------------------------------------------------------------------------------------------------

        $schedule->call(function () {
            $endOfContest = false;
             //get the question of the last period not checked for winners
            
        //get the question of the last period not checked for winners
        $inquiry =  DB::table('inquiries')
                        ->whereNull('deleted_at')
                        ->orderBy('stop', 'asc')
                        ->first();

        //check if the question has ended
        if($inquiry->stop == Carbon::today())
        {
            //count all the ones who got it correct
            $countCorrect = DB::table('awnsers')
                    ->where('FK_inquiry',$inquiry->id)
                    ->where('awnser',$inquiry->awnser)
                    ->count();

            //check the shifting question
            $first = DB::table('awnsers')
                        ->select('FK_user','shifting')
                        ->where('shifting','<',$countCorrect)
                        ->orderBy('shifting','DESC')
                        ->take(3);

            $winners = DB::table('awnsers')
                        ->select('FK_user','shifting')
                        ->where('shifting','>=',$countCorrect)
                        ->orderBy('shifting','DESC')
                        ->take(3)
                        ->union($first)
                        ->orderBy('shifting','DESC')
                        ->take(3)
                        ->get();

            //write away
            $file   = fopen('winners.csv', 'w');
            $ids    = array();
            foreach ($winners as $row) {

                $ids[]=$row->FK_user;
                
                $newWinners                     = new Winners;
                $newWinners->FK_inquiry         = 1;
                $newWinners->FK_user            = 1;  
                $newWinners->save();

            }

           //get names
            $names = DB::table('users')
                    ->select('name','surname')
                    ->whereIn('id', $ids)
                    ->get();
            
            foreach ($names as $row) {

                 $csv=array("name" => $row->name,"surname" => $row->surname);
                 fputcsv($file,$csv);
            }

            fclose($file);

            //close period
            $inquiry->delete();
            //send mail-----------------
                

        $users = DB::table('users')
                ->whereNotNull('admin')
                ->get();

            foreach($users as $user)
            {
                $data = ['user' => $user];

                $pathToFile = "public/winners.csv";

                Mail::send('mail', $data, function ($message) {
                    $message->from('contest@stuff.com', 'contest.stuff');
                    $message->attach("winners.csv");
                    $message->to('jonasvanreeth@gmail.com')->cc('bar@example.com');
                });
            }
        }

        })->dailyAt('23:59');

    }
}
