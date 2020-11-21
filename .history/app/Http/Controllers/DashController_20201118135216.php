<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function loginScreen()
    {
        return View('loginView.blade');
    }
}
