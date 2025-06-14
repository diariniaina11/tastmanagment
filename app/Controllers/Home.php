<?php
namespace App\Controllers;
use App\Models\TaskModel;



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
        $tasks = new TaskModel();
        // Vérification de la session
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }


        $data['tasks'] = $tasks->where('user_id', session()->get('user_id'))->findAll();
        return view('accueil', $data);
    }
    public function retrieving_new_task()
    {
            $taskModel = new TaskModel();

            // Récupération des données POST
            $data = [
                'user_id'     => session('user_id'), // supposé que tu utilises les sessions
                'title'       => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'category'    => $this->request->getPost('category'),
                'priority'    => $this->request->getPost('priority'),
                'status'      => 'en cours', // ou autre valeur par défaut
                'dueDate'    => $this->request->getPost('due_date'),
                
                'created_at'  => date('Y-m-d H:i:s'),
            ];

            // Insertion dans la base de données
            if ($taskModel->insert($data)) {
                return redirect()->to('/accueil')->with('success', 'Tâche ajoutée avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de l\'ajout de la tâche.');
            }
    }

    public function delete_task()
    {
        $taskModel = new TaskModel();
        $taskId = $this->request->getPost('task_id');

        // Vérification de l'existence de la tâche
        if ($taskModel->find($taskId)) {
            // Suppression de la tâche
            if ($taskModel->delete($taskId)) {
                return redirect()->to('/accueil')->with('success', 'Tâche supprimée avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la suppression de la tâche.');
            }
        } else {
            return redirect()->back()->with('error', 'Tâche non trouvée.');
        }
    }

    public function change_task_status()
    {
        
        $taskModel = new TaskModel();
        $taskId = $this->request->getPost('task_id');
        $newStatus = $this->request->getPost('status');

        // Vérification de l'existence de la tâche
        if ($taskModel->find($taskId)) {
            // Mise à jour du statut de la tâche
            if ($taskModel->update($taskId, ['status' => $newStatus])) {
                return redirect()->to('/accueil')->with('success', 'Statut de la tâche mis à jour avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la mise à jour du statut de la tâche.');
            }
        } else {
            return redirect()->back()->with('error', 'Tâche non trouvée.');
        }
    }
}
