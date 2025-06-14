<?php
namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id' ,'title', 'description', 'category', 'priority', 'status', 'dueDate'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}