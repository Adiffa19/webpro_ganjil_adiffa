<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenBermasalahController;
use App\Models\AbsenBermasalah;

Route::resource('absen-bermasalah', AbsenBermasalahController::class);
Route::get('/', function () {
    return redirect()->route('absen.index');
});
Route::resource('absen', AbsenBermasalahController::class)->only(['index', 'show']);