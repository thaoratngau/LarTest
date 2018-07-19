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
Route::get('/home', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'TicketsController@create');
Route::post('/contact', 'TicketsController@store');
Route::get('/tickets', 'TicketsController@index');
Route::get('/ticket/{slug?}', 'TicketsController@show');
Route::get('/ticket/{slug?}/edit','TicketsController@edit');
Route::post('/ticket/{slug?}/edit','TicketsController@update');
Route::post('/ticket/{slug?}/delete','TicketsController@destroy');
Route::post('/comment', 'CommentsController@newComment');
Route::get('sendemail', function () {
	$data = array(
		'name' => "Learning Laravel",
	);
	Mail::send('emails.welcome', $data, function ($message) {
		$message->from('yourEmail@domain.com', 'Learning Laravel');
		$message->to('yourEmail@domain.com')->subject('Learning Laravel test email');
	});
	return "Your email has been sent successfully";
});
Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('users/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('users/register', 'Auth\RegisterController@register');
Route::get('users/logout', 'Auth\LoginController@logout');

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager') , function (){
		Route::get('users', 'UsersController@index');
	});

