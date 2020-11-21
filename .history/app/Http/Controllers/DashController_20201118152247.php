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
        //  $username = $request->input('username');
        //$password = $request->input('password');

        die("sdsf");
        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'password' => 'required',
        ]);


        return  $validatedData;
    }
}
