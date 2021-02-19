<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
  return view("welcome");
});

//language changer controller
Route::get('/change-langauge/{lang}', "LanguageController@changeLanguage")->name("change-langauge");

Route::resource('invoice', 'InvoiceController');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
