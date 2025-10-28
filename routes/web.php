<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

Route::get('/', function () {
    return redirect('/admin');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(Authenticate::class);