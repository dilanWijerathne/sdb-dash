<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;



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


            $response = Http::post('http://10.101.6.198/sdbl/api/login', [
                'email' => $username,
                'password' => $password,
            ]);

            echo json_encode($response);
        }
    }
}
