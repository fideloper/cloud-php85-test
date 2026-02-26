<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    try {
        Http::attach('image', file_get_contents(public_path('image.png')), 'image.png')
            ->post('https://google.com');
    } catch (\Throwable) {
        // Ignore failures
    }
})->everyMinute();
