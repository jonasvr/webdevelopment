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
       //LAST CONTESTENTS-------------------------------------------------------------------------------------------- 
        $schedule->call(function () {
            

            $awnsers= DB::table('users')
                    ->join('awnsers', 'users.id', '=', 'awnsers.FK_user')
                    ->where('awnsers.created_at','>=',Carbon::today())
                    ->select('users.name','users.surname')
                    ->get();

            $file = fopen('file.csv', 'w');
            $csv = array();

            foreach ($awnsers as $row) {
                 $csv[]=array("name" => $row->name,"surname" => $row->surname);
                 fputcsv($file, $csv);
            }
            fclose($file);

        })->dailyAt('23:59');


//FIND WINNERS------------------------------------------------------------------------------------------------------------

        $schedule->call(function () {
            
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
                    $newWinners->FK_inquiry         = $inputData[$inquiry->id];
                    $newWinners->FK_user            = $inputData[$row->FK_user];  
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
            }

        })->dailyAt('23:59');

    }
}
