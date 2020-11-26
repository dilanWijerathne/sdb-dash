<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Utils;
use App\Models\Datta;
use Illuminate\Support\Facades\Log;


class DashController extends Controller
{
    public function loginScreen()
    {
        //echo "Dilan";
        return View('loginview');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return View('loginview');
    }


    public function dashboard()
    {
        $user = Utils::currentUser();
        if ($user !== false) {
            return View('maindash');
        } else {
            return View('loginview');
        }
    }

    public function team()
    {
        $user = Utils::currentUser();
        $branches = Datta::grab_branches();
        if ($user !== false) {
            return View('team', compact('branches'));
        } else {
            return View('loginview');
        }
    }




    public function review(Request $request)
    {
        $rev =  Datta::update_review($request->bdo, $request->type, $request->ref);
        Log::info($request->type . ' Review for  ' . $request->ref);
        Log::info($rev);
    }

    public function new_member(Request $request)
    {

        $member = Datta::new_user($request->name, $request->email, $request->password, $request->password_c, $request->mobile, $request->role, $request->branch);
        return  $member;
    }



    public function onboading_list()
    {
        //echo "Dilan";
        $user = Utils::currentUser();
        if ($user !== false) {
            return View('onboarding_list');
        } else {
            return View('loginview');
        }
    }

    public function applicant_details_page(Request $request)
    {

        $nic  = $request->ReportID;
        // get rest of the details from onboarding core application
        $applicant = Datta::grab_applicant_latest($nic);

        // return $applicant['Applicant']['applicant_status'];

        $user = Utils::currentUser();
        if ($user === true) {
            return View('applicant_details', $applicant);
        } else {
            return View('loginview');
        }
    }


    public function  approve(Request $request)
    {

        // add token validation to this functuion

        $response = Http::get('http://10.100.32.94/sdbl/api/inapp', [
            "nic" => $request->nic,
        ]);

        return  $response;
    }






    public function calldit(Request $request)
    {

        $user = Utils::currentUser();
        Log::info("start");
        Log::info($request["start"]);
        Log::info("end");
        Log::info($request["length"]);
        Log::info("search value ");
        Log::info($request["search"]["value"]);


        $access_token = session('access_token');

        $response = Http::get('http://10.100.32.94/sdbl/public/api/applicants', [
            "start" => $request["start"],
            "end" => $request["length"],
            "search" => $request["search"]["value"],
            "draw" => $request["draw"],
            "access_token" => $access_token,
        ]);

        return  $response->body();
    }


    public function login_to_core(Request $request)
    {

        if ($request->has(['username', 'password'])) {
            $username = $request->input('username');
            $password = $request->input('password');


            $response = Http::post('http://10.100.32.94/sdbl/api/login', [
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
