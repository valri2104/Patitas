<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
