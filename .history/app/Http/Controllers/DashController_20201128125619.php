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

        $response = Http::get(env('CORE_URL') . '/sdbl/api/inapp', [
            "nic" => $request->nic,
        ]);

        return  $response;
    }


    public function comment(Request $request)
    {

        Log::info('dash comment');
        Log::info($request);

        $response = Http::get(env('CORE_URL') . '/sdbl/api/comment', [
            "bdo" =>  $request->input('bdo'),
            "from" =>  $request->input('from'),
            "ref" => $request->input('ref'),
            "msg" => $request->input('msg'),

        ]);
        return  $response;
    }

    public function comment_by_bdo_app(Request $request)
    {
        $user = Utils::currentUser();

        $response = Http::get(env('CORE_URL') . '/sdbl/api/comments_application', [
            "ref" => $request->input('ref'),

        ]);

        return $response;
    }


    public function nessage_by_ref(Request $request)
    {
        // $user = Utils::currentUser();

        $response = Http::get(env('CORE_URL') . '/sdbl/api/message_get_ref', [
            "ref" => $request->input('ref'),

        ]);

        return $response;
    }


    public function nessage_send(Request $request)
    {
        // $user = Utils::currentUser();
        /*

        $msg->from_user = $request->input('from_user');
        $msg->to_user = $request->input('to_user');
        $msg->msg = $request->input('msg');
        $msg->nic = $request->input('nic');
        $msg->ref = $request->input('ref');

*/


        $response = Http::get(env('CORE_URL') . '/sdbl/api/message', [
            "from_user" => $request->input('from_user'),
            "to_user" => $request->input('to_user'),
            "msg" => $request->input('msg'),
            "nic" => $request->input('nic'),
            "ref" => $request->input('ref'),
        ]);

        Log::info('message send outcome');
        Log::info($response);
        return $response;
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





        $response = Http::get(env('CORE_URL') . '/sdbl/public/api/applicants', [
            "start" => $request["start"],
            "end" => $request["length"],
            "search" => $request["search"]["value"],
            "draw" => $request["draw"],
            "user_email" => session('user_email'),
        ]);

        return  $response->body();
    }


    public function login_to_core(Request $request)
    {

        if ($request->has(['username', 'password'])) {
            $username = $request->input('username');
            $password = $request->input('password');


            $response = Http::post(env('CORE_URL') . '/sdbl/api/login', [
                'email' => $username,
                'password' => $password,
            ]);

            $userTokenObject = $response->body();

            $array = json_decode($userTokenObject, true);

            if (isset($array['token'])) {
                session(['access_token' => $array['token']]);
                $user = Utils::currentUser();
                echo  "success";
            } else {
                echo $array['error'];    // invalid_credentials
            }
        }
    }
}
