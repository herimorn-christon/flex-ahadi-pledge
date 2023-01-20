<?php

namespace App\Console;

use App\Models\User;
use App\Models\Reminder;
use App\Http\Controllers\PledgeReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        $schedule->call(function () {
            $reminders = Reminder::all();
            foreach ($reminders as $reminder) {
                $name = $reminder->pledge->name;

                FCMService::send(
                    $reminder->pledge->user->fcm_token,
                    [
                        'title' => $name,
                        'body' => 'reminder to complete pledge goal',
                    ]
                );
                $reminder->delete();
            }
        })->dailyAt('13:00');
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
