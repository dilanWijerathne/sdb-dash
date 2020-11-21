<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Utils;
use Illuminate\Support\Facades\Log;


class DashController extends Controller
{
    public function loginScreen()
    {
        //echo "Dilan";
        return View('loginview');
    }


    public function dashboard()
    {
        //echo "Dilan";
        return View('maindash');
    }

    public function onboading_list()
    {
        //echo "Dilan";
        $user = Utils::currentUser();
        return View('onboarding_list');
    }



    public function calldit(Request $request)
    {


        Log::info("start");
        Log::info($request["start"]);
        Log::info("end");
        Log::info($request["length"]);
        Log::info("search value ");
        Log::info($request["search"]["value"]);




        $response = Http::get('http://10.101.6.198/sdbl/public/api/applicants', [
            "start" => $request["start"],
            "end" => $request["length"],
            "search" => $request["search"]["value"],
            "draw" => $request["draw"],
        ]);

        return  $response->body();
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

            $userTokenObject = $response->body();

            $array = json_decode($userTokenObject, true);

            if (isset($array['token'])) {
                session(['access_token' => $array['token']]);
                echo  "success";
            } else {
                echo $array['error'];    // invalid_credentials
            }
        }
    }
}
