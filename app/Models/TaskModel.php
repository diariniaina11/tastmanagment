<?php
namespace App\Models;

use CodeIgniter\Model;

class TastModel extends Model
{
    protected $table = 'event_data';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id' ,'title', 'description', 'category', 'priority', 'status', 'dueDate'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}

 