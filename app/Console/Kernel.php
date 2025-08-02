<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Video;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
        protected function schedule(Schedule $schedule): void
        {
            $schedule->call(function () {
                Video::whereNotNull('started_at')
                    ->where('started_at', '<=', now())
                    ->where('is_finished', false)
                    ->update(['is_finished' => true]);

                Log::info('Scheduler executed: updated finished videos');
            })->everyMinute();
        }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
