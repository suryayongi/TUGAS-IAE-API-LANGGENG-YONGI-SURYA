<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [GameController::class, 'index']);