<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class AppInit extends Controller
{
    public function index()
    {
        // Connexion avec CodeIgniter (config/database.php)
        $db = Database::connect();

        // Crée la table si elle n'existe pas
        if (! $db->tableExists('users')) {
            $forge = \Config\Database::forge();

            $fields = [
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'username' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'pwd' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
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

        if (! $db->tableExists('tasks')) {
            $forge = \Config\Database::forge();

            $fields = [
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'title' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                ],
                'description' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'category' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'priority' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'status' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'dueDate' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'createdAt' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ];

            $forge->addField($fields);
            $forge->addKey('id', true);
            $forge->createTable('tasks');

            echo "Table 'tasks' créée avec succès.<br>";
        } else {
            echo "Table 'tasks' déjà existante.<br>";
        }


    }
}
