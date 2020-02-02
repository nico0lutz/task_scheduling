<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Quote;
use Faker\Generator as Faker;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->everyMinute();

        // generates a new random quote every minute
        $schedule->call(function(Faker $faker) {
        
            $quote = new Quote;
        
            $quote->author = $faker->name; 
            $quote->text = $faker->text;

            $quote->save();
        })->everyMinute()->between('6:00', '23:00');

        
        // deletes all entries except the latest 10 from the DB once a day at 23:02
        $schedule->call(function() {
            $count = DB::table('quotes')->count();

            $deleteUs = DB::table('quotes')->latest()->take($count)->skip(10)->get();

            foreach($deleteUs as $deleteMe){
                DB::table('quotes')->where('id',$deleteMe->id)->delete();
            }

        })->dailyAt('23:02');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
