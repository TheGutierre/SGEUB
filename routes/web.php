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

Route::get('/inscricoes', function () {
    return view('inscricoes');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('editAluno', 'Alunos@editProf')->name('editAluno')->middleware('auth');

Route::post('editAluno', 'Alunos@updateProf')->name('editAluno')->middleware('auth');


                    //Rotas administrador - Gerenciamento de Alunos
Route::get('lista/alunos', 'Alunos@index')->name('adm.alunos')->middleware('auth');

Route::get('alunos/delete/{id}', 'Alunos@destroy')->name('adm.alunos')->middleware('auth');

Route::post('lista/alunos', 'Alunos@search')->name('adm.alunosUp')->middleware('auth');

Route::get('alunos/edit/{id}', 'Alunos@edit')->name('adm.updateAluno')->middleware('auth');

Route::post('alunos/edit/', 'Alunos@update')->name('adm.updateAluno')->middleware('auth');



                    //Rotas administrador - Gerenciamento de Palestrantes
Route::get('cadastro/palestrante', function(){
    return view('adm.cadPalestrante');
})->middleware('auth');

Route::get('lista/palestrante', 'PalestranteController@read')->name('adm.listPalestrantes')->middleware('auth');

Route::get('palestrante/delete/{id}', 'PalestranteController@destroy')->name('adm.listPalestrantes')->middleware('auth');

Route::post('lista/palestrante', 'PalestranteController@search')->name('adm.listPalestrantes')->middleware('auth');

Route::post('cadastro/palestrante', 'PalestranteController@create')->name('adm.cadPalestrante')->middleware('auth');

Route::get('palestrante/edit/{id}', 'PalestranteController@edit')->name('adm.updatePalestrante')->middleware('auth');

Route::post('palestrante/edit/', 'PalestranteController@update')->name('adm.updatePalestrante')->middleware('auth');


                    //Rotas administrador - Gerenciamento de Usuários
Route::get('lista/adm', 'AdminController@read')->name('adm.listAdm')->middleware('auth');

Route::get('adm/delete/{id}', 'AdminController@destroy')->name('adm.listAdm')->middleware('auth');

Route::post('lista/adm', 'AdminController@search')->name('adm.listAdm')->middleware('auth');

Route::get('cadastro/adm', function(){
    return view('adm.cadAdm');
})->middleware('auth');

Route::post('cadastro/adm', 'AdminController@create')->name('adm.cadAdm')->middleware('auth');

Route::get('adm/edit/{id}', 'AdminController@edit')->name('adm.updateAdm')->middleware('auth');

Route::post('adm/edit/', 'AdminController@update')->name('adm.updateAdm')->middleware('auth');

Route::get('editAdm', 'AdminController@editProf')->name('editAdm')->middleware('auth');

Route::post('editAdm', 'AdminController@updateProf')->name('editAdm')->middleware('auth');
