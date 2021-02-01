<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view("welcome");
});


Route::resource('invoice', 'InvoiceController');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
