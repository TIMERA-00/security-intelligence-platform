<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    try {
        DB::connection()->getPdo();

        return response()->json([
            'status' => 'ok',
            'database' => 'connected',
        ]);
    } catch (\Throwable $exception) {
        return response()->json([
            'status' => 'error',
            'database' => 'unavailable',
        ], 503);
    }
});
