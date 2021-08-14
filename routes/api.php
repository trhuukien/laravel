<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComicController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('comics', 'ComicController@index');
Route::get('comics/{id}', 'ComicController@get');
Route::get('comics/cate/{id}', 'ComicController@whereCateId');
Route::get('comics/author/{id}', 'ComicController@whereAuthorId');
Route::post('comics', 'ComicController@add');
Route::put('comics/{id}', 'ComicController@update');
Route::delete('comics/{id}', 'ComicController@delete');

Route::get('authors', 'AuthorController@index');
Route::get('authors/{id}', 'AuthorController@get');
Route::post('authors', 'AuthorController@add');
Route::put('authors/{id}', 'AuthorController@update');
Route::delete('authors/{id}', 'AuthorController@delete');

Route::get('categories', 'CategoryController@index');
Route::get('categories/{id}', 'CategoryController@get');
Route::post('categories', 'CategoryController@add');
Route::put('categories/{id}', 'CategoryController@update');
Route::delete('categories/{id}', 'CategoryController@delete');

Route::get('mail', 'CategoryController@sendMail');

Route::get('comics/where/{id_cate}/{id_author}', 'ComicController@where');
