<?php namespace App\Models;

use CodeIgniter\Model;



class PostModel extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id_post';
    protected $allowedFields = ['fotop', 'deskripsi', 'album'];

    // Tambahkan fungsi untuk mendapatkan post berdasarkan album
    public function getPostsByAlbum($id_album)
    {
        return $this->where('album', $id_album)->findAll();
    }
    
}
