<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['foto','nama', 'username', 'password']; // Sesuaikan dengan struktur tabel user
    
    
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
    public function getUserById($userId)
    {
        return $this->where('id_user', $userId)->first();
    }

    // Metode untuk memperbarui data pengguna
    public function updateUser($userId, $data)
    {
        $this->update($userId, $data);
    }
}
