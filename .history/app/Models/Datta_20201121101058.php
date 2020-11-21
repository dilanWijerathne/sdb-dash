<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class Datta
{

    public static function grab_applicant_latest($nic)
    {

        Log::info('grab applicant latest ' . $nic);

        $response = Http::get('http://10.101.6.198/sdbl/public/api/applicants', [
            "nic" => $nic,
        ]);
    }
}
