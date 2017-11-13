<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products', 'ProductController');

Route::resource('quotes', 'QuoteController');

Route::resource('customers', 'CustomerController');

Route::post('/quotes/{id}/product', 'QuoteController@add_products_to_quote')->name('quotes.add_products');

Route::delete('/quotes/{id}/product', 'QuoteController@remove_product_from_quote')->name('quotes.remove_product_from_quote');

Route::post('/quotes/{id}/client_confirm', 'QuoteController@client_confirm')->name('quotes.client_confirm');

Route::post('/quotes/{id}/client_confirm_withdraw', 'QuoteController@client_confirm_withdraw')->name('quotes.client_confirm_withdraw');

Route::post('/quotes/{id}/production_confirm', 'QuoteController@production_confirm')->name('quotes.production_confirm');

Route::post('/quotes/{id}/print_quotation', 'QuoteController@print_quotation')->name('quotes.print_quotation');

Route::post('/quotes/{id}/print_production', 'QuoteController@print_production')->name('quotes.print_production');

Route::post('/quotes/{id}/print_invoice', 'QuoteController@print_invoice')->name('quotes.print_invoice');

Route::post('/quotes/{id}/change_profile_size', 'QuoteController@change_profile_size')->name('quotes.change_profile_size');

Route::post('/quotes/{id}/update_product_profile_size', 'QuoteController@update_product_profile_size')->name('quotes.update_product_profile_size');

Route::post('/quotes/{id}/change_company', 'QuoteController@change_company')->name('quotes.change_company');

Route::post('/quotes/{id}/change_style', 'QuoteController@change_style')->name('quotes.change_style');

Route::post('/quotes/{id}/price/{product_id}/{style_id}', 'QuoteController@update_price')->name('quotes.update_price');

Route::post('/customers/{id}/users', 'CustomerController@create_user')->name('customers.add_user');


Route::get('/styles', 'QuoteController@test')->name('styles.store');

