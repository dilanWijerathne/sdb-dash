<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;
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



Route::get('/', [DashController::class, 'loginScreen']);

Route::get('/user-login', [DashController::class, 'login_to_core']);
Route::get('/dashboard', [DashController::class, 'dashboard']);
Route::get('/onboarding', [DashController::class, 'onboading_list']);


Route::get('/applicants', [DashController::class, 'calldit']);
Route::get('/applicant-details', [DashController::class, 'applicant_details_page']);


Route::get('/myteam', [DashController::class, 'team']);
