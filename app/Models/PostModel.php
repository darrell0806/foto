<?php namespace App\Models;

use CodeIgniter\Model;



class PostModel extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id_post';
    protected $allowedFields = ['fotop', 'deskripsi', 'album','user_maker'];

    // Tambahkan fungsi untuk mendapatkan post berdasarkan album
    public function getPostsByAlbumm($id_album, $userId)
{
    $builder = $this->db->table('post');
    $builder->select('post.*, likes.status AS like_status, user.id_user, post.user_maker');
    $builder->join('likes', 'likes.post_id = post.id_post AND likes.user_id = ' . $userId, 'left');
    $builder->join('user', 'user.id_user = post.user_maker');
    $builder->where('post.album', $id_album);
    return $builder->get()->getResult();
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
    public function getPostById($postId)
    {
        return $this->find($postId);
    }
    public function getAlbumIdByPostId($postId)
    {
        $post = $this->find($postId);

        if ($post) {
            return $post['album']; // Assuming 'album_id' is the foreign key in your posts table
        }

        return null; // Post not found
    }
}
