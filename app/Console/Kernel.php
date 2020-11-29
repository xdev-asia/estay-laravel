<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Models\Admin\Activity;
use App\Models\Admin\Booking;
use App\Models\Admin\Owner;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Torann\Currency\Console\Update::class,
        \Torann\Currency\Console\Cleanup::class,
        \Torann\Currency\Console\Manage::class
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
            $today = Carbon::today()->format('Y-m-d');
            $activities = Activity::whereDate('end_date', '<=', $today)->get();
            foreach($activities as $activity){
                if($activity->property){
                    $activity->property->featured = 0;
                    $activity->property->save();
                }
            }
        })->daily();

        $schedule->call(function () {
            $days = get_setting('days_after_check_in', 'payment');
            $today = Carbon::today()->subdays($days);
            $bookings = Booking::whereDate('start_date', '<=', $today)->get();
            foreach($bookings as $booking){
                if(!$booking->status){
                    $owner = Owner::where('user_id', $booking->owner_id)->first();
                    if($owner){
                        $owner->pending_balance -= $booking->total;
                        $owner->active_balance += $booking->total;
                        $owner->save();
                        $booking->status = 1;
                        $booking->save();
                    }
                 }

            }
        })->daily();

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
