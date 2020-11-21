<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DashController extends Controller
{
    public function loginScreen()
    {
        //echo "Dilan";
        return View('loginview');
    }


    public function login_to_core(Request $request)
    {



        if ($request->has(['username', 'password'])) {
            $username = $request->input('username');
            $password = $request->input('password');
        }
    }
}
