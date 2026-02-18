<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// ? clear logs files
Artisan::command('logs:clear', function () {
    exec('rm -f ' . storage_path('logs/*.log'));
    exec('rm -f ' . storage_path('logs/callstream/*.log'));
    $this->comment('Logs have been cleared!');
})->describe('Clear log files');

Schedule::command('logs:clear')->monthly();

// Schedule::command('logs:clear')->everyMinute();

// Schedule::command('callstream:cron')->hourly();
// Schedule::command('callstream:cron')->everyMinute();
// Schedule::command('callstream:cron')->everyTwoMinutes();

// ?sitemap
// Schedule::command('sitemap:generate')->daily();