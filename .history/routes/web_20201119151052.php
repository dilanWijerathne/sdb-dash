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
Route::get('/onboading', [DashController::class, 'onboading_list']);
