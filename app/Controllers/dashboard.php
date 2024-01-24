<?php

namespace App\Controllers;
use App\Models\PostModel;
use App\Models\AlbumModel;
use App\Models\CommentModel;
use App\Models\UserModel;

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

// Controller
public function likePost()
{
    $postModel = new PostModel();
    
    $postId = $this->request->getPost('post_id');
    $userId = session()->get('id');
    $albumId = $this->request->getPost('album_id');

    // Check if the user has already liked the post
    $userLiked = $postModel->getLikesByPostAndUser($postId, $userId);

    // Handle like logic
    if (empty($userLiked)) {
        // If the user hasn't liked the post, add a new like
        $postModel->addLike(['user_id' => $userId, 'post_id' => $postId, 'status' => 'Like']);
    } else {
        // If the user has liked the post, update the like status
        if ($userLiked['status'] == 'Like') {
            $postModel->updateLike(['status' => null], ['user_id' => $userId, 'post_id' => $postId]);
        } else {
            $postModel->updateLike(['status' => 'Like'], ['user_id' => $userId, 'post_id' => $postId]);
        }
    }

    // Redirect back to the viewAlbum page with the album_id parameter
    return redirect()->to(base_url("dashboard/viewAlbum/$albumId"));
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
    public function commentForm($postId)
    {
        $postModel = new PostModel();
        $commentModel = new CommentModel();
        
        $post = $postModel->getPostById($postId); // Menggunakan $postId
        $comments = $commentModel->getCommentsByPost($postId); // Menggunakan $postId
        
        $data = [
            'post_id' => $postId,
            'post' => $post,
            'comments' => $comments,
        ];
        
        echo view('header');
        echo view('comment_form', $data);
        echo view('footer');
    }
    public function submitComment()
    {
        $commentModel = new CommentModel();
        $userId = session()->get('id');
        $postId = $this->request->getPost('post_id');
        $commentText = $this->request->getPost('comment');
    
        // Simpan komentar ke database menggunakan CommentModel
        $commentModel->addComment(['user_id' => $userId, 'post_id' => $postId, 'comment' => $commentText]);
    
        // Redirect kembali ke halaman viewAlbum dengan menyertakan id_album
        $postModel = new PostModel();
        $post = $postModel->getPostById($postId);
        $albumId = $post['album'];
    
        return redirect()->to(base_url('dashboard/viewAlbum/' . $albumId));
    }
    public function cari()
    {
        echo view('header');
        echo view('search');
        echo view('footer');
    }
    public function searchUser()
    {
        $username = $this->request->getPost('search_username');

        $userModel = new UserModel();
        $albumModel = new AlbumModel();

        $userData = $userModel->getUserByUsername($username);

        if (!empty($userData)) {
            $albums = $albumModel->getAlbumsByUser($userData['id_user']);

            $data = [
                'userData' => $userData,
                'albums'   => $albums,
            ];

            echo view('header');
            echo view('search_result', $data);
            echo view('footer');
        } else {
            // Handle jika pengguna tidak ditemukan
            echo view('header');
            echo view('not_found');
            echo view('footer');
        }
    }
}