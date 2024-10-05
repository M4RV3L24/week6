<?php

use App\Http\Controllers\WalksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('walks', WalksController::class);
