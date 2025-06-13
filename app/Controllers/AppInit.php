<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class AppInit extends Controller
{
    public function index()
    {
        // Connexion
        $db = Database::connect();
        $forge = \Config\Database::forge();

        // Création table USERS
        if (! $db->tableExists('users')) {
            $fields = [
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'username' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                ],
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                ],
                'pwd' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255, // pour hacher le mot de passe
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ];

            $forge->addField($fields);
            $forge->addKey('id', true);
            $forge->createTable('users');
            echo "Table 'users' créée avec succès.<br>";
        } else {
            echo "Table 'users' déjà existante.<br>";
        }

        // Création table TASKS
        if (! $db->tableExists('tasks')) {
            $fields = [
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'user_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                ],
                'title' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                ],
                'description' => [
                    'type'       => 'TEXT',
                ],
                'category' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                ],
                'priority' => [
                    'type'       => 'ENUM("low", "medium", "high")',
                    'default'    => 'medium',
                ],
                'status' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'default'    => 'pending',
                ],
                'dueDate' => [
                    'type'       => 'DATE',
                    'null'       => true,
                ],
                'created_at' => [
                    'type'       => 'DATETIME',
                    'null'       => true,
                ],
            ];

            $forge->addField($fields);
            $forge->addKey('id', true);
            // Optionnel : ajouter clé étrangère plus tard avec migration ou manuellement
            $forge->createTable('tasks');
            echo "Table 'tasks' créée avec succès.<br>";
        } else {
            echo "Table 'tasks' déjà existante.<br>";
        }

        // Redirection
        return redirect()->to('/login')->with('info', 'Veuillez vous connecter pour accéder à cette page.');
    }
}
