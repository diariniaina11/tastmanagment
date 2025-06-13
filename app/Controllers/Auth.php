<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        return view('login/login_view');
    }


    public function signUp()
    {
        return view('welcome_message');
    }


    public function doLogin()
    {
        return view('welcome_message');
    }


    public function doSignUp()
    {
        return view('welcome_message');
    }
    
}
