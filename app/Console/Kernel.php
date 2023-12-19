<?php

namespace App\Console;

use App\Mail\WaringMail;
use App\Models\Todo;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

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
            $todos = \App\Models\Todo::whereBetween('due_date', [now(), now()->addMinutes(10)])
                ->where('is_sent', false)
                ->get();

            foreach ($todos as $todo) {
                // Отправка уведомления для каждой задачи
                Mail::to($todo->user->email)->send(new \App\Mail\WaringMail($todo));

                // Установка флага is_sent в true после отправки уведомления
                $todo->update(['is_sent' => 1]);
            }


        })->everyMinute();
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
