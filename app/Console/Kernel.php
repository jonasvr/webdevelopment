<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Carbon\Carbon;

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
        $schedule->command('inspire')
                 ->hourly();

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
            }

            foreach ($csv as $row) {
                fputcsv($file, $row);
            }
            fclose($file);

        })->everyMinute();
    }
}
