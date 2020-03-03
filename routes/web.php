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
    return redirect("/login");
});

Route::get("/register", function(){
    return redirect("/login");
});
Route::post("/register", function(){
    return redirect("/login");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(["prefix"=>"importacao"],function(){
    Route::get('/', 'ImportacaoController@index')->name('importacao.index');
    Route::get('/new', 'ImportacaoController@new')->name('importacao.new');
    Route::post('/new', 'ImportacaoController@new_post')->name('importacao.new.post');
});

Route::group(["prefix"=>"rating"],function(){
    Route::get('/search/id/{id}', 'RatingController@searchByID')->name('rating.search.id');
    Route::get('/search/byName', 'RatingController@searchFindByName')->name('rating.search.byName');
});
Route::group(["prefix"=>"cron"],function(){
    Route::get('/download/{id}', 'CronController@downloadRating')->name('cron.download');
});