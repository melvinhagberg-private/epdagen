<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Admin extends Model {
    
	public static function routes() {
		Route::group(['middleware' => ['web']], function() {
		// Login
		    Route::get('admin/inloggning', 'Auth\LoginController@showLoginForm')->name('login');
		    Route::post('admin/inloggning', 'Auth\LoginController@login')->name('login.post');
		    Route::get('admin/logga-ut', 'Auth\LoginController@logout')->name('logout');

		// Register
		    Route::get('admin/registrera/{token}', 'Auth\RegisterController@showRegistrationForm')->name('register');
		    Route::post('admin/registrera', 'Auth\RegisterController@register')->name('register.post');

		// Update
		    Route::post('/admin/uppdatera', 'AdminController@update');

		// Password Reset
		    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
		    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
		    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
		    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset.post');
		});
	}

}
