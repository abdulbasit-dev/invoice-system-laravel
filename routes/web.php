<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'InvoiceController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
