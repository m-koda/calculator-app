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
    return view('home');
});

Route::get('/question', 'QuestionController@index')->name('question');

Auth::routes();


// Googleログイン
Route::get('/login/google', 'Auth\LoginController@redirectToGoogle')->name('google.login');
Route::get('/login/google/callback', 'Auth\LoginController@handleGoogleCallback');
