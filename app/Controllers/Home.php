<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function inscription()
    {
        return view('inscription/inscription_view');
    }
    public function inscriptionPost()
    {
        $userModel = new \App\Models\UserModel();
        
        $data = [
            'username'    => $this->request->getPost('username'),
            'email'           => $this->request->getPost('email'),
            'pwd'          => $this->request->getPost('pwd'),
        ];
        try {
            $userModel->insert($data);
            return redirect()->to('/inscription')->with('success', 'Inscription réussie LOGO');
        } catch (DatabaseException $e) {
            if (strpos($e->getMessage(), 'users_email_key') !== false) {
                return redirect()->back()->withInput()->with('error', 'Email déjà utilisé.');
            } elseif (strpos($e->getMessage(), 'users_tel_key') !== false) {
                return redirect()->back()->withInput()->with('error', 'Numéro de téléphone déjà utilisé.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Erreur inconnue. Veuillez réessayer.');
            }
        }
    }

    public function accueil()
    {
        // Vérification de la session
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }
        $tasks=new \App\Models\TaskModel();
        $data['tasks'] = $tasks->where('user_id', session()->get('user_id'))->findAll();
        return view('accueil', $data);
    }

}
