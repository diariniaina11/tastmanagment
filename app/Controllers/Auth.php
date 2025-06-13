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

        
        $userModel = new \App\Models\UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('pwd');

        // Vérification des identifiants
        $user = $userModel->where('email', $email)->first();
        
        if ($user && $password == $user['pwd']){
            session()->set('logged_in', true);
            session()->set('user_id', $user['id']);
            
            return redirect()->to('accueil')->withInput()->with('succes', 'Connexion réussie !');
            
        }
    }


    public function doSignUp()
    {
        return view('welcome_message');
    }
    
}
