<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
  return view("welcome");
});

//language changer controller
Route::get('/change-langauge/{lang}', "LanguageController@changeLanguage")->name("change-langauge");

Route::get("invoice/print/{invoice}", "InvoiceController@print")->name("invoice.print");
Route::get("invoice/pdf/{invoice}", "InvoiceController@pdf")->name("invoice.pdf");
// Route::get("invoice/send_to_email/{invoice}", "InvoiceController@send_to_email")->name("invoice.send_to_email");
Route::resource('invoice', 'InvoiceController');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
