<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utils
{
    public static function currentUser()
    {
        $value = session('access_token');
        // echo $value;



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
                "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMC4xMDEuNi4xOThcL3NkYmxcL2FwaVwvbG9naW4iLCJpYXQiOjE2MDU3NjkzNzgsImV4cCI6MTYwNTc3Mjk3OCwibmJmIjoxNjA1NzY5Mzc4LCJqdGkiOiI2WWRzN0RCTnBZalVvdU85Iiwic3ViIjo1LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.fir_cZyPbL2cAbQ-ORXJmLtETdYQlavzB3L1HgiMnqo"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
