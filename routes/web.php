<?php

use App\Http\Controllers\BusController;
use Illuminate\Support\Facades\Route;

Route::any('/', [BusController::class, 'index'])->name('index');
Route::resource('bus', BusController::class)->names(['store' => 'create','create' => 'admin']);