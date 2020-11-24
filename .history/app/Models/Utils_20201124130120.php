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


    public static function smsreg()
    {
    }


    public static function currentUser()
    {
        $access_token = session('access_token');

        $response = Http::withToken($access_token)->get("http://10.101.6.198/sdbl/api/user", null);

        $ar = $response->body();
        $array = json_decode($ar, true);

        Log::info('user taken');
        Log::info($array);
        $state = false;

        if (isset($array['email'])) {
            session(['user_email' => $array['email']]);
            $state =  true;
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
        } else {
            $state =  false;    // invalid_credentials
        }

        return $state;
    }
}
