<?php

use App\Comment;
use App\Discussion;

use App\Http\Resources\CommentResource;
use App\Http\Resources\InfoResource;
use App\Resource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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

Route::post('password/email', "ForgotPasswordController@sendResetLinkResponse");
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/discussion', 'DiscussionController@index');
Route::middleware('auth:api')->post('/discussion/create', 'DiscussionController@store');
Route::middleware('auth:api')->delete('/discussion/{id}', function($id){
    Discussion::findOrFail($id)->delete();
});

Route::middleware('auth:api')->get('/comment', 'CommentController@index');
Route::middleware('auth:api')->post('/comment/create', 'CommentController@store');
Route::middleware('auth:api')->get('/discussion/{id}/comment', function($id){
    $comment = Comment::where(["discussion_id" => $id])->paginate(30);
    return CommentResource::collection($comment);
});
Route::middleware('auth:api')->delete('/comment/id', function($id){
    Comment::findOrFail($id)->delete();
});

Route::middleware('auth:api')->get('/user/{id}', function($id){
    return User::findOrFail($id);
});
Route::middleware('auth:api')->post('/user/{id}', function($id, Request $request){
    $user = User::findOrFail($id);
    $user->update($request->all());
});
Route::middleware('auth:api')->delete('/user/{id}', function($id){
    User::findOrFail($id)->delete();
});
Route::group(['namespace' => 'API'], function () {
    Route::post('/register', 'UserController@store');
});

Route::middleware('auth:api')->get('/resource', 'ResourceController@index');
Route::middleware('auth:api')->post('/resource/create', 'ResourceController@store');
Route::middleware('auth:api')->delete('/resource/{id}', function($id){
    Resource::findOrFail($id)->delete();
});
