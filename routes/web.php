<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

Route::get('/', function () {
    return view('welcome');

 Route::get('tag', TagController::class);
