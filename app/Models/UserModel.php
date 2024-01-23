<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['foto','name', 'username', 'password']; // Sesuaikan dengan struktur tabel user
}
