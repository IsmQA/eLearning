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

Route::get('/login', 'LoginController@index');
Route::get('/admin', 'LoginController@loginAdmin');

Route::post('/cekLogin', 'LoginController@cekLogin');
Route::post('/cekLoginAdmin', 'LoginController@cekLoginAdmin');

Route::group(['middleware' => 'Logincek'], function () {
    
    Route::get('/logout', 'LoginController@logout');

    Route::get('/', 'DashboardController@index');
    Route::get('/kelas', 'KelasController@index');
    Route::get('/kelas/{id}', 'KelasController@show')->name('insertLibrary');

    Route::get('/addLibrary/{id}', 'LibraryController@create');
    Route::post('/addLibrary/{id}', 'LibraryController@store');
    Route::get('/deleteLibrary/{id}', 'LibraryController@destroy');
    Route::get('/editLibrary/{id}', 'LibraryController@show');
    Route::post('/editLibrary/{id}', 'LibraryController@showP');
    Route::get('/editVideo/{id}', 'LibraryController@video');
    Route::post('/editVideo/{id}', 'LibraryController@videoP');

    Route::get('/addTugas/{id}', 'TugasController@index');
    Route::post('/addTugas/{id}', 'TugasController@store');
    Route::get('/deleteTugas/{id}', 'TugasController@destroy');
    Route::post('/jawabTugas', 'TugasController@turnIn');
    Route::get('/detailJawab/{id}/{id_tugas}', 'TugasController@jawaban');
    Route::post('/nilai/{id_tugas}/{id_matkul}', 'TugasController@nilai');
    Route::get('/editTugas/{id}', 'TugasController@editTugas');
    Route::post('/editTugas/{id}', 'TugasController@editTugasP');

    Route::get('/dosen', 'DosenController@index');
    Route::get('/mhs', 'DosenController@mhs');

    Route::get('/addKuis/{id}', 'KuisController@create');
    Route::post('/addKuis/{id}', 'KuisController@store');
    Route::get('/detailKuis/{id}', 'KuisController@index');
    Route::get('/deleteKuis/{id}', 'KuisController@destroy');
    Route::get('/editKuis/{id}/{id_kuis}', 'KuisController@show');
    Route::post('/editKuis/{id}/{id_kuis}', 'KuisController@update');

    Route::get('/addSoal/{id}', 'KuisController@addSoal');
    Route::post('/addSoal/{id}', 'KuisController@storeSoal');
    Route::get('/deleteSoal/{id}', 'KuisController@destroySoal');
    Route::get('/editSoal/{id}/{id_soal}', 'KuisController@editSoal');
    Route::post('/editSoal/{id}/{id_soal}', 'KuisController@updateSoal');

    Route::get('/mulaiKuis/{id}', 'KuisController@kuis');
    Route::post('/jawabanKuis/{id}', 'KuisController@storeJawaban');
    Route::get('/nilaiKuis/{id_matkul}/{id}', 'KuisController@kuisMhs');
    Route::get('/jawabanKuis/{id}/{nim}', 'KuisController@jawabanMhs');
    Route::post('/nilaiKuis/{id}', 'KuisController@nilai');


    Route::get('/profil', 'UserController@profil');
    Route::get('/raport/{id}', 'UserController@raport');
    Route::get('/cetak/{id}', 'UserController@cetakPDF');
    Route::get('/ubahProfil', 'UserController@editProfil');
    Route::post('/ubahProfil', 'UserController@editProfilP');

    Route::get('/absen/{id}', 'AbsenController@absen');
    Route::get('/dftrHadir/{id}', 'AbsenController@index');
    Route::get('/dtlAbsensi/{id}', 'AbsenController@detail');

});