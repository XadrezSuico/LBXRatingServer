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

Route::group(["prefix"=>"importacao"],function(){
    Route::get('/', 'ImportacaoController@index')->name('importacao.index');
    Route::get('/new', 'ImportacaoController@new')->name('importacao.new');
    Route::post('/new', 'ImportacaoController@new_post')->name('importacao.new.post');
});
