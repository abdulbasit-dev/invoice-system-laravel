<?php

use Illuminate\Support\Facades\Route;



Route::resource('invoice', 'InvoiceController');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
