<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('connectivity', function () {
    $checks = [
        'database' => ['ok' => false, 'error' => null],
        'redis' => ['ok' => false, 'error' => null],
    ];

    try {
        DB::select('SELECT 1');
        $checks['database']['ok'] = true;
    } catch (Throwable $e) {
        $checks['database']['error'] = $e->getMessage();
    }

    try {
        Redis::ping();
        $checks['redis']['ok'] = true;
    } catch (Throwable $e) {
        $checks['redis']['error'] = $e->getMessage();
    }

    $ok = $checks['database']['ok'] && $checks['redis']['ok'];

    return response()->json($checks, $ok ? 200 : 503);
})->name('connectivity');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
