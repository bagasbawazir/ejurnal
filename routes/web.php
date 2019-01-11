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

Route::get('/', 'cLanding@index');
Route::get('/show/{id}', 'cLanding@show')->name('landing.show');
Route::get('/jurusan/{jurusan}', 'cLanding@jurusan')->name('landing.jurusan');
Route::get('/cari', 'cLanding@cari')->name('landing.cari');











// ===========ADMIN================

// CRUD DOSEN
Route::group(['prefix' => 'users/dosen'], function() {
	Route::get('/', 'cDosenn@index');
	Route::post('/', 'cDosenn@store');
	//edit
	Route::get('/{idnya}/edit', 'cDosenn@edit');
	Route::patch('/{idnya}', 'cDosenn@update');
	//delete
	//delete ini perlu form, kalau mau yang simple boleh juga pke get
	Route::delete('/{id}', 'cDosenn@destroy');
});


// CRUD ADMIN
Route::group(['prefix' => 'users/admin'], function() {
	// indexing
	Route::get('/', 'cAdmin@index');
	Route::post('/', 'cAdmin@store');

	Route::get('/{idnya}/edit', 'cAdmin@edit');
	Route::patch('/{idnya}', 'cAdmin@update');

	Route::delete('/{id}', 'cAdmin@destroy');

});

// LIHAT REVIEWER
Route::group(['prefix' => 'users/reviewer'], function() {
	// indexing
	Route::get('/', 'cReviewer@index')->name('reviewer.index');

	Route::delete('/{id}', 'cReviewer@destroy')->name('reviewer.destroy');

});

// LIHAT SEMUA JURNAL ADMIN
Route::group(['prefix' => 'jurnal'], function() {

	Route::get('/', 'cJurnalAdmin@index');

});









// ===========DOSEN================

// JURNAL PER DOSEN
Route::group(['prefix' => 'dosen/jurnal'], function() {

	Route::get('/', 'cJurnalDosen@index')->name('jurnalPerDosen.index');

	Route::get('/submisi/1', 'cJurnalDosen@create1')->name('jurnalPerDosen.create1');
	Route::post('/submisi/1', 'cJurnalDosen@store1')->name('jurnalPerDosen.store1');
	Route::get('/submisi/2', 'cJurnalDosen@create2')->name('jurnalPerDosen.create2');
	Route::post('/submisi/2', 'cJurnalDosen@store2')->name('jurnalPerDosen.store2');
	Route::get('/submisi/3', 'cJurnalDosen@create3')->name('jurnalPerDosen.create3');
	Route::put('/submisi/3', 'cJurnalDosen@store3')->name('jurnalPerDosen.store3');
	Route::view('/submisi/sukses', 'JurnalPerDosen.submisi-sukses')->name('jurnalPerDosen.sukses');

	//edit
	Route::get('/{idnya}/edit', 'cJurnalDosen@edit')->name('jurnalPerDosen.edit');
	Route::patch('/{idnya}', 'cJurnalDosen@update')->name('jurnalPerDosen.update');

	// delete
	Route::delete('/{id}', 'cJurnalDosen@destroy')->name('jurnalPerDosen.delete');

});


// REQUEST REVIEW
Route::group(['prefix' => 'review/request'], function() {

	Route::get('/all', 'cRequestReview@index')->name('rrequest.index');

	Route::get('/create', 'cRequestReview@create1')->name('rrequest.create1');
	Route::post('/validation', 'cRequestReview@validasi1')->name('rrequest.validasi1');

	Route::get('/quisioner', 'cRequestReview@quisionerCreate')->name('rrequest.quisionerCreate');//validasi form sebelumnya
	Route::post('/quisioner', 'cRequestReview@quisionerStore')->name('rrequest.quisionerStore');//tampil quisioner form


	Route::get('/send/{id}', 'cRequestReview@sendMail')->name('rrequest.sendMail');//validasi form sebelumnya

	// delete
	Route::delete('/{id}', 'cRequestReview@destroy')->name('rrequest.delete');

});






//ACCESS REVIEWER via Email
Route::group(['prefix' => 'review/access'], function() {


	Route::post('/validatecode', 'cReviewAccess@validatecode')->name('rrequest.validatecode');
	Route::post('/validateyesno', 'cReviewAccess@validateYesNo')->name('rrequest.validateYesNo');

	Route::get('/tampil/form', 'cReviewAccess@tampilForm')->name('rrequest.tampilForm');
	Route::post('/isireview', 'cReviewAccess@isiReview')->name('rrequest.isiReview');

	Route::get('/finish', 'cReviewAccess@finish')->name('rrequest.finish');

	// delete
	// Route::delete('/{id}', 'cReviewAccess@destroy')->name('rrequest.delete');

	//get pertama
	Route::get('/{id}', 'cReviewAccess@otentikasi')->name('rrequest.otentikasi');
});




















// ===========BOTH================


// Login
Route::get('login', 'cLogin@getLogin')->name('login');
Route::get('admin/login', 'cLogin@getLoginAdmin')->name('loginAdmin');
Route::post('post-login', 'cLogin@postLogin');

//logout
Route::get('logout', function(){

	Auth::user()->kategori=='Admin'? $ke='admin/login':$ke='login';

	Auth::logout();
	echo 'sukses logout';
	return redirect($ke);
})->middleware('auth');

// HOME
Route::get('/home', 'cLogin@showProfil');





// TRASHED
Route::group(['prefix' => 'trashed'], function() {

	// indexing
	Route::get('/', 'cTrash@trashIndex');
	// DOSEN
	// restore
	Route::get('/dosen/{id}/restore', 'cTrash@restoreDosen');
	Route::get('/dosen/restore', 'cTrash@restoreAllDosen');
	// forceDelete
	Route::get('/dosen/{id}/delete', 'cTrash@deleteDosen');
	Route::get('/dosen/delete', 'cTrash@deleteAllDosen');

	// ADMIN
	// restore
	Route::get('/admin/{id}/restore', 'cTrash@restoreAdmin');
	Route::get('/admin/restore', 'cTrash@restoreAllAdmin');
	// forceDelete
	Route::get('/admin/{id}/delete', 'cTrash@deleteAdmin');
	Route::get('/admin/delete', 'cTrash@deleteAllAdmin');


	// JURNAL PER DOSEN
	// restore
	Route::get('/jurnal/dosen/{id}/restore', 'cTrash@restoreJurnalPerDosen')->name('restoreJurnalPerDosen');
	Route::get('/jurnal/dosen/restore', 'cTrash@restoreAllJurnalPerDosen')->name('restoreJurnalPerDosenAll');
	// forceDelete
	Route::get('/jurnal/dosen/{id}/delete', 'cTrash@deleteJurnalPerDosen')->name('deleteJurnalPerDosen');
	Route::get('/jurnal/dosen/delete', 'cTrash@deleteAllJurnalPerDosen')->name('deleteJurnalPerDosenAll');
});

