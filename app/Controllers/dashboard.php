<?php

namespace App\Controllers;
use App\Models\PostModel;
use App\Models\AlbumModel;


class dashboard extends BaseController
{
  
    public function index()
    {
        $postModel = new PostModel();
        $albumModel = new AlbumModel();

        $data = [
            'albums' => $this->getAlbumsWithPosts($postModel, $albumModel),
        ];
        echo view('header');
        echo view('dashboard', $data);
        echo view('footer');
    }

    public function likePost()
    {
        $postModel = new PostModel();
    
        $postId = $this->request->getPost('post_id');
        $userId = session()->get('id'); // Ganti dengan logika sesuai user yang sedang login
    
        // Check apakah user sudah like atau belum
        $userLiked = $postModel->getLikesByPostAndUser($postId, $userId);
    
        // Jika user belum like, tambahkan like
        if (empty($userLiked)) {
            $postModel->addLike(['user_id' => $userId, 'post_id' => $postId, 'status' => 'Like']);
        } else {
            // Jika user sudah like, update status like menjadi null
            if ($userLiked['status'] == 'Like') {
                $postModel->updateLike(['status' => null], ['user_id' => $userId, 'post_id' => $postId]);
            } else {
                $postModel->updateLike(['status' => 'Like'], ['user_id' => $userId, 'post_id' => $postId]);
            }
        }
    
        // Ambil kembali jumlah likes setelah perubahan
        $likesCount = $postModel->getLikesCount($postId);
    
        $response = [
            'status' => 'success',
            'likes'  => $likesCount,
        ];
    
        return $this->response->setJSON($response);
    }
    
    public function viewAlbum($id_album)
    {
        $postModel = new PostModel();
        $userId = session()->get('id');
        $data = [
            'id_album' => $id_album,
            'photos' => $postModel->getPostsByAlbumm($id_album, $userId),
        ];
        echo view('header');
        echo view('view_album', $data);
        echo view('footer');
    }
    
   

    private function getAlbumsWithPosts(PostModel $postModel, AlbumModel $albumModel)
    {
        $albums = [];
    
        $allAlbums = $albumModel->findAll();
    
        foreach ($allAlbums as $album) {
            $albumData = [
                'id_album' => $album['id_album'],
                'nama_album' => $album['nama_album'],
                'cover' => $album['cover'],  // Tambahkan ini untuk kolom cover
                'posts' => $postModel->getPostsByAlbum($album['id_album']),
            ];
    
            $albums[] = $albumData;
        }
    
        return $albums;
    }
    
   
}