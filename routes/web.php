<?php

use App\Admin;

use App\Jobs\TicketMailJob;

/* ----- Main: Tickets ----- */
	/* ----- Step 1: Info ----- */
	Route::get('/biljett/uppgifter', 'TicketController@viewInfo');
	Route::post('/biljett/uppgifter', 'TicketController@store');

	/* ----- Step 2: Payment ----- */
	Route::get('/biljett/betala', 'TicketController@viewPayment');

	/* ----- Step 3: Confirmation ----- */
	Route::get('/biljett/tack-for-ditt-kop', 'TicketController@confirmation');

	/* ----- Validate: Single ticket ----- */
	Route::get('/validera/{ticket_id}', 'TicketController@ticketValid');
	Route::get('/validera/regret/{ticket_id}', 'TicketController@ticketRegret');

/* ----- Main: Admin ----- */
	Admin::routes();

	/* ----- Settings: Posts ----- */
	Route::post('/admin/do', 'SettingsController@do');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/senaste', 'AdminController@latest');
Route::get('/admin/klasslista', 'AdminController@classList');
Route::get('/admin/bjud-in', 'AdminController@showCreateUser');

Route::get('/', 'TicketController@index');
Route::get('/{student}', 'TicketController@viewInfo');

// Tillfälliga
Route::get('/logout', function() {
	Auth::logout();
});
