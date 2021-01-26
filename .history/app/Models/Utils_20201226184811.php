<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Utils
{

    public static function change_my_pass($email, $pass)
    {

        Log::info('password changing by ' . session('user_email'));

        //   Http::withToken()->post
        $access_token = session('access_token');
        $response = Http::post(env('CORE_URL') . '/sdbl/api/reset_pass', [
            "email" => $email,
            "password" => $pass,
        ]);

        Log::info('password changed ' . session('user_email'));
        Log::info($response);
        return  $response;
    }

    public static function reset_user_pass($email)
    {

        Log::info('reset password  by ' . session('user_email'));

        //   Http::withToken()->post
        $access_token = session('access_token');
        $response = Http::post(env('CORE_URL') . '/sdbl/api/request_reset_password', [
            "email" => $email,
        ]);

        Log::info('password reset by ' . session('user_email'));
        Log::info($response);
        return  $response;
    }


    public static function currentUser()
    {
        $access_token = session('access_token');

        $response = Http::withToken($access_token)->get(env('CORE_URL') . "/sdbl/api/user", null);

        $ar = $response->body();
        $array = json_decode($ar, true);

        Log::info('user taken');
        Log::info($array);
        $state = false;
        session(['apikey' => $access_token]);
        if (isset($array['email'])) {
            session(['user_email' => $array['email']]);
        }
        if (isset($array['name'])) {
            session(['user_name' => $array['name']]);
        }
        if (isset($array['mobile'])) {
            session(['user_mobile' => $array['mobile']]);
        }
        if (isset($array['branch'])) {
            session(['user_branch' => $array['branch']]);
        }
        if (isset($array['role'])) {
            session(['user_role' => $array['role']]);
            if ($array['role'] === "manager") {
                $state =  true;
            }
        } else {
            $state =  false;    // invalid_credentials
        }

        return $state;
    }

    ////////////

    //
    public function grab_branches_byid($bid)
    {
        $response = Http::get(env('CORE_URL') . '/sdbl/api/grab_branches_byid', [
            "id" => $bid,
        ]);
        return $response;
    }

    public static function minitHRClient($empid)
    {
        $response = Http::withHeaders([
            "accessToken" => "m3gsa7ae81654e1c16efb1c49e25c539f630",
            "emp_no" => $empid
        ])->get('https://sdb.minthrm.com/thirdParty/getEmpDetailsSdb', [
            "Dilan" => "Dilan",
        ]);
        Log::info('minitHR response  ' . $empid);
        Log::info($response->body());
        Log::info($response);
        return $response;
    }
}
