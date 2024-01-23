<?php namespace App\Models;

use CodeIgniter\Model;



class PostModel extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id_post';
    protected $allowedFields = ['fotop', 'deskripsi', 'album'];

    // Tambahkan fungsi untuk mendapatkan post berdasarkan album
    public function getPostsByAlbumm($id_album, $userId)
{
    $builder = $this->db->table('post');
    $builder->select('post.*, likes.status AS like_status');
    $builder->join('likes', 'likes.post_id = post.id_post AND likes.user_id = ' . $userId, 'left');
    $builder->where('post.album', $id_album);
    return $builder->get()->getResultArray();
}
public function getPostsByAlbum($id_album)
{
    return $this->where('album', $id_album)->findAll();
}
    public function getLikesByPostAndUser($postId, $userId)
    {
        return $this->db->table('likes')
            ->where(['post_id' => $postId, 'user_id' => $userId])
            ->get()
            ->getRowArray();
    }

    public function addLike($data)
    {
        return $this->db->table('likes')->insert($data);
    }

    public function updateLike($data, $condition)
    {
        return $this->db->table('likes')->update($data, $condition);
    }
}
