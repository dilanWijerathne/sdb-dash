<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;

class Utils
{
    public static function currentUser()
    {
        $access_token = session('access_token');

        $response = Http::withToken($access_token)->post(null, null);



        /*

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://10.101.6.198/sdbl/api/user",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $access_token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;


        */
    }
}
