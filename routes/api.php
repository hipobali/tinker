<?php

use Illuminate\Http\Request;

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
Route::get('/posts',[
    'uses'=>'ApiController@getPosts'
]);
Route::get('/post/{id}',[
    'uses'=>'ApiController@getPostOne'
]);
Route::Delete('/post/{id}',[
    'uses'=>'ApiController@getDeletePost'
]);
Route::get('/post/search/{q}',[
    'uses'=>'ApiController@getSearchPost'
]);
Route::post('/post/update',[
    'uses'=>'ApiController@postUpdatePosts'
    ]);
Route::post('/post/new',[
    'uses'=>'ApiController@postNew'
]);

