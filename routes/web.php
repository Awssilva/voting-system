<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnqueteController;


Route::get('/', function () {
    return redirect('/enquete');
});


Route::get('/enquete/votar/{opcao_id}', [EnqueteController::class, 'votar'])->name('enquete.votar');
Route::resource('enquete', EnqueteController::class);


