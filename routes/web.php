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

Route::get('user/block/{user}', 'UserController@block')->name('user.block');
Route::resource('user', 'UserController');

Route::resource('fornecedor', 'FornecedorController');


Route::post('/produto/buscafornecedor', 'ProdutoController@buscafornecedor')->name('produto.buscafornecedor');

Route::get('/produto/comestoque', 'ProdutoController@comestoque')->name('produto.comestoque');

Route::get('/produto/semestoque', 'ProdutoController@semestoque')->name('produto.semestoque');

Route::resource('produto', 'ProdutoController');
