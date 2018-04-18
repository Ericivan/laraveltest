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


Route::get('oauth2/callback', 'Api\UserController@user');


Route::get('redirect', 'GithubController@redirect');
Route::get('github/user', 'GithubController@getUser');

Route::get('oauth2/callback','GithubController@callback');

Route::group([
    'prefix'=>'/v1',
//    'middleware' => ['api']
], function () {
    Route::post('/user/login','Api\LoginController@login');

    Route::get('/user', 'ElasticSearchController@getAllUser');
    Route::get('/index', 'ElasticSearchController@createIndex');
    Route::get('/getindex', 'ElasticSearchController@getIndex');
    Route::get('/updateindex', 'ElasticSearchController@updateIndex');
    Route::get('/search', 'ElasticSearchController@search');

    Route::namespace('Api')->prefix('users')->group(function () {
        Route::get('/info', 'UserController@test');
        Route::get('/queue', 'UserController@queueTest');
        Route::get('/pipe', 'UserController@create');
        Route::get('github', 'UserController@github');

    });

    Route::namespace('Api')->prefix('extract')->group(function () {
        Route::get('weibo', 'ExtractController@weiboHotKeys');
        Route::get('test', 'ExtractController@test');
        Route::get('elem', 'ExtractController@element');
        Route::get('screen', 'ExtractController@screenCapture');
        Route::get('response', 'ExtractController@responseData');
        Route::get('script', 'ExtractController@customScript');
        Route::get('dom', 'ExtractController@domElemt');

        Route::get('login', 'ExtractController@githubLogin');


    });

    Route::prefix('sign')->namespace('Api')->group(function () {
        Route::post('/', 'SignController@sign');
        Route::get('/list', 'SignController@signList');
        Route::post('re', 'SignController@reSigned');
    });
});