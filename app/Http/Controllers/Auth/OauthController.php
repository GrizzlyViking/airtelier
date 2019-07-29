<?php


namespace App\Http\Controllers\Auth;


use Illuminate\Http\Response;

class OauthController
{
    public function setUpClient(): Response
    {
        return response(view('auth.oauth2'));
    }
}
