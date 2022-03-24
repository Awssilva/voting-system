<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnqueteController;


Route::get('/', function () {
    return view('welcome');
});



Route::resource('enquetes', EnqueteController::class);


