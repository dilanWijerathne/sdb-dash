<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;
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


Route::post('/applicant-approval', [DashController::class, 'approve']);


Route::post('/new_member', [DashController::class, 'new_member']);

Route::post('/review', [DashController::class, 'review']);

Route::post('/comment', [DashController::class, 'comment']);

Route::get('/comment_by_bdo_app', [DashController::class, 'comment_by_bdo_app']);
