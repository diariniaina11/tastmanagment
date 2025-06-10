<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ApiController extends ResourceController
{
    use ResponseTrait;

    // Méthode GET : Récupérer tous les utilisateurs
    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM users');
        $users = $query->getResult();

        return $this->respond($users);
    }

    // Méthode GET : Récupérer un utilisateur par ID
    public function show($id = null)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM users WHERE id = $id");
        $user = $query->getRow();

        if ($user) {
            return $this->respond($user);
        } else {
            return $this->failNotFound('Utilisateur non trouvé');
        }
    }

    // Méthode POST : Créer un nouvel utilisateur
    public function create()
    {
        $db = \Config\Database::connect();
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email')
        ];

        $db->table('users')->insert($data);
        return $this->respondCreated($data);
    }

    // Méthode PUT : Mettre à jour un utilisateur
    public function update($id = null)
    {
        $db = \Config\Database::connect();
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email')
        ];

        $db->table('users')->where('id', $id)->update($data);
        return $this->respond($data);
    }

    // Méthode DELETE : Supprimer un utilisateur
    public function delete($id = null)
    {
        $db = \Config\Database::connect();
        $db->table('users')->where('id', $id)->delete();

        return $this->respondDeleted(['id' => $id]);
    }
}