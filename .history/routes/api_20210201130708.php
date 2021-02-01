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
Route::post('/reject', [DashController::class, 'reject']);

Route::post('/comment', [DashController::class, 'comment']);

Route::get('/comment_by_bdo_app', [DashController::class, 'comment_by_bdo_app']);

Route::get('/nessage_by_ref', [DashController::class, 'nessage_by_ref']);

Route::get('/nessage_send', [DashController::class, 'nessage_send']);

Route::get('/my_team_member', [DashController::class, 'my_team_member']);

Route::post('/update_my_team_member', [DashController::class, 'update_my_team_member']);

Route::post('/delete_my_team_member', [DashController::class, 'delete_my_team_member']);

Route::post('/reset_my_password', [DashController::class, 'reset_my_password']);

Route::post('/req_new_pass', [DashController::class, 'req_new_pass']);

Route::post('/current_search_branch', [DashController::class, 'current_search_branch']);

Route::post('/minitHR', [DashController::class, 'minitHR']);

Route::post('/blacklist_check', [DashController::class, 'blacklist_check']);
