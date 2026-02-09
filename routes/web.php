<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SusController;

Route::get('/', [SusController::class, 'indeks']);
Route::post('/hitung', [SusController::class, 'hitung'])->name('sus.hitung');