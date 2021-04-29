<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function() {
//  Route::get('/users', 'UserController@index')->name('user.index');
 Route::group(['middleware' => ['role:superadmin']], function() {
   Route::get('/komda-users', 'UserController@userKomda')->name('user-komda');
   Route::get('/komda-user-create', 'UserController@createUserKomda')->name('user-komda.create');
   Route::post('/komda-user-store', 'UserController@storeUserKomda')->name('user-komda.store');
   Route::get('/komda-user-edit/{id}', 'UserController@editUserKomda')->name('user-komda.edit');
   Route::post('/komda-user-update/{id}', 'UserController@updateUserKomda')->name('user-komda.update');
   Route::get('/komda-user-destroy/{id}', 'UserController@destroyUserKomda')->name('user-komda.destroy');

   Route::get('/komda', 'UserController@komda')->name('komda.index');
   Route::get('/komda-create', 'UserController@createKomda')->name('komda.create');
   Route::post('/komda-store', 'UserController@storeKomda')->name('komda.store');
   // Route::post('/komda-show', 'UserController@showKomda')->name('komda.show');
   Route::get('/komda-edit/{id}', 'UserController@editKomda')->name('komda.edit');
   Route::post('/komda-update/{id}', 'UserController@updateKomda')->name('komda.update');
   Route::get('/komda-destroy/{id}', 'UserController@destroyKomda')->name('komda.destroy');
 });

 Route::group(['middleware' => ['role:komda']], function() {
   Route::get('/komda-pengurus', 'UserController@pengurusKomda')->name('pengurus-komda');
   Route::get('/komda-pengurus-create', 'UserController@createPengurusKomda')->name('pengurus-komda.create');
   Route::post('/komda-pengurus-store', 'UserController@storePengurusKomda')->name('pengurus-komda.store');
   Route::get('/komda-pengurus-edit/{id}', 'UserController@editPengurusKomda')->name('pengurus-komda.edit');
   Route::post('/komda-pengurus-update/{id}', 'UserController@updatePengurusKomda')->name('pengurus-komda.update');
   Route::get('/komda-pengurus-destroy/{id}', 'UserController@destroyPengurusKomda')->name('pengurus-komda.destroy');
 });

 Route::group(['middleware' => ['role:pengurus']], function() {
    Route::get('/komda-anggota', 'UserController@anggotaKomda')->name('anggota-komda');
    Route::get('/komda-anggota-create', 'UserController@createAnggotaKomda')->name('anggota-komda.create');
    Route::post('/komda-anggota-store', 'UserController@storeAnggotaKomda')->name('anggota-komda.store');
    Route::get('/komda-anggota-edit/{id}', 'UserController@editAnggotaKomda')->name('anggota-komda.edit');
    Route::post('/komda-anggota-update/{id}', 'UserController@updateAnggotaKomda')->name('anggota-komda.update');
    Route::get('/komda-anggota-destroy/{id}', 'UserController@destroyAnggotaKomda')->name('anggota-komda.destroy');
 });

});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
