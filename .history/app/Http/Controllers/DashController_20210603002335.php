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
        if ($user === true) {

            return View('maindash');
        } else {
            return View('loginview');
        }
    }

    public function team()
    {
        $user = Utils::currentUser();
        $branches = Datta::grab_branches();
        if ($user === true) {
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


    /*
    reject

    */
    public function reject(Request $request)
    {
        $rev =  Datta::update_review($request->bdo, 'reject', $request->ref);
        Log::info($request->type . ' Review for  ' . $request->ref);
        Log::info($rev);
    }

    public function new_member(Request $request)
    {

        $member = Datta::new_user($request->name, $request->email, $request->password, $request->password_c, $request->mobile, $request->role, $request->branch, $request->emp);
        return  $member;
    }



    public function onboading_list()
    {
        //echo "Dilan";
        $user = Utils::currentUser();
        $branches = Datta::grab_branches();
        if ($user === true) {
            return View('onboarding_list', compact('branches'));
        } else {
            return View('loginview');
        }
    }

    // check internal black list by nic
    public function blacklist_check(Request $request)
    {
        return Utils::blacklist_check($request->nic);
    }




    public function applicant_details_page_by_ref(Request $request)
    {

        $ref  = $request->ReportID;
        // get rest of the details from onboarding core application
        $applicant = Datta::grab_applicant_by_ref($ref);

        // return $applicant['Applicant']['applicant_status'];

        Log::info("long tet on object ");
        Log::info($applicant);
        $user = Utils::currentUser();
        if ($user === true) {
            return View('applicant_details', $applicant);
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


    /*
    public function  approve(Request $request)
    {

        // add token validation to this functuion

        $response = Http::get(env('CORE_URL') . '/sdbl/api/inapp', [
            "nic" => $request->nic,
        ]);

        return  $response;
    }

    */
    public function  approve(Request $request)
    {

        // add token validation to this functuion

        $response = Http::get(env('CORE_URL') . '/sdbl/api/inapp', [
            "ref" => $request->ref,
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
        Log::info('message to send');
        Log::info($request);

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



    public function current_search_branch(Request $request)
    {
        session(['current_branch_search' => $request["br_code"]]);
        //  $request->session()->forget('current_branch_search');
        //return$request->session()->push('key.subArray', 'value');

        return session('current_branch_search');
    }



    /// fixed deposits

    public function calldit_fds(Request $request)
    {

        Log::info("Data tables request");
        Log::info($request);
        $user = Utils::currentUser();
        Log::info("start");
        Log::info($request["start"]);
        Log::info("end");
        Log::info($request["length"]);
        Log::info("search value ");
        Log::info($request["search"]["value"]);
        Log::info("selected branch");
        Log::info($request["f_branch"]);





        $response = Http::get(env('CORE_URL') . '/sdbl/public/api/applicants_fds', [
            "start" => $request["start"],
            "end" => $request["length"],
            "search" => $request["search"]["value"],
            "draw" => $request["draw"],
            "user_email" => session('user_email'),
            "current_branch_search" => $request["f_branch"],
            "app_status" => $request["app_status"],
        ]);

        return  $response->body();
    }



    public function calldit(Request $request)
    {

        Log::info("Data tables request");
        Log::info($request);
        $user = Utils::currentUser();
        Log::info("start");
        Log::info($request["start"]);
        Log::info("end");
        Log::info($request["length"]);
        Log::info("search value ");
        Log::info($request["search"]["value"]);
        Log::info("selected branch");
        Log::info($request["f_branch"]);





        $response = Http::get(env('CORE_URL') . '/sdbl/public/api/applicants', [
            "start" => $request["start"],
            "end" => $request["length"],
            "search" => $request["search"]["value"],
            "draw" => $request["draw"],
            "user_email" => session('user_email'),
            "current_branch_search" => $request["f_branch"],
            "app_status" => $request["app_status"],
            "product" => $request["product"],
        ]);

        return  $response->body();
    }

    public function call_myteam(Request $request)
    {

        $user = Utils::currentUser();
        Log::info("start");
        Log::info($request["start"]);
        Log::info("end");
        Log::info($request["length"]);
        Log::info("search value ");
        Log::info($request["search"]["value"]);

        $response = Http::get(env('CORE_URL') . '/sdbl/public/api/get_myteam', [
            "start" => $request["start"],
            "end" => $request["length"],
            "search" => $request["search"]["value"],
            "draw" => $request["draw"],
            "user_email" => session('user_email'),
        ]);

        return  $response->body();
    }


    public function my_team_member(Request $request)
    {
        Log::info('get team memebr details ');
        Log::info($request);

        $response = Http::get(env('CORE_URL') . '/sdbl/api/get_my_team_member', [
            "user_email" => $request->input('email'),
        ]);

        Log::info('get team memebr details outcome');
        Log::info($response);
        return $response;
    }


    public function update_my_team_member(Request $request)
    {
        Log::info('update team memebr details ');
        Log::info($request);

        $response = Http::get(env('CORE_URL') . '/sdbl/api/update_my_team_member', [
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "cemail" => $request->input('cemail'),
            "mobile" => $request->input('mobile'),
            "role" => $request->input('role'),
            "branch" => $request->input('branch'),
        ]);

        Log::info('update team memebr details outcome ');
        Log::info($response);
        return $response;
    }

    // delete_my_team_member

    public function delete_my_team_member(Request $request)
    {
        Log::info('delete team memebr details by' . session('user_email'));
        Log::info($request);

        $response = Http::post(env('CORE_URL') . '/sdbl/api/delete_my_team_member', [
            "email" => $request->input('email'),
        ]);

        Log::info('delete team memebr details outcome , deleted by ' . session('user_email'));
        Log::info($response);
        return $response;
    }


    /////////////////

    public function reset_my_password(Request $request)
    {
        Log::info('password changed ' . session('user_email'));
        Log::info($request);
        //   Http::withToken()->post
        /*    $access_token = session('apikey');
        $response = Http::withToken($access_token)->post(env('CORE_URL') . '/sdbl/api/reset_pass', [
            "email" => $request->input('email'),
            "password" => $request->input('password'),
        ]);

        Log::info('password changed ' . session('user_email'));
        Log::info($response);
        return $access_token; //$response;  */
        return  Utils::change_my_pass($request->input('email'), $request->input('password'));
    }


    public function req_new_pass(Request $request)
    {
        Log::info('password reset ' . session('user_email'));
        Log::info($request);

        return  Utils::reset_user_pass($request->input('email'));
    }


    public function minitHR(Request $request)
    {
        Log::info('minitHR check ' . session('user_email'));
        Log::info($request);

        return  Utils::minitHRClient($request->input('empid'));
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
                //   session(['current_branch_search' => 0]);
                $user = Utils::currentUser();
                if ($user === true) {
                    echo  "success";
                } else {
                    echo  "Login error, Check credentials or access levels.";
                }
            } else {
                echo $array['error'];    // invalid_credentials
            }
        }
    }
}
