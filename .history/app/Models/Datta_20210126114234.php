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
    public static function update_review($bdo, $type, $ref)
    {
        $response = Http::post(env('CORE_URL') . '/sdbl/api/reviewed', [
            "type" => $type,    // ops/  mng
            "ref" => $ref,
            "bdo" => $bdo,

        ]);

        return  $response;
    }

    public static function new_user($name, $email, $password, $password_c, $mobile, $role, $branch, $emp)
    {

        $response = Http::post(env('CORE_URL') . '/sdbl/api/register', [
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "password_confirmation" => $password_c,
            "mobile" => $mobile,
            "role" => $role,
            "branch" => $branch,
            "emp" => $emp,
        ]);


        return  $response;
    }


    public static function grab_branches()
    {



        $response = Http::get(env('CORE_URL') . '/sdbl/api/grab_branches', [
            "nic" => "",
        ]);


        return  json_decode($response->body(), true);
    }

    public static function grab_applicant_latest($nic)
    {

        Log::info('grab applicant latest ' . $nic);

        $response = Http::get(env('CORE_URL') . '/sdbl/api/applicant_details_by_nic?nic=' . $nic, [
            "nic" => $nic,
        ]);


        return  json_decode($response->body(), true);
    }


    public static function grab_applicant_by_ref($ref)
    {

        Log::info('grab applicant latest ' . $ref);

        $response = Http::get(env('CORE_URL') . '/sdbl/api/applicant_details_by_ref?ref=' . $ref, [
            "ref" => $ref,
        ]);


        return  json_decode($response->body(), true);
    }
}
