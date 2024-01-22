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

    public function viewAlbum($id_album)
    {
        $postModel = new PostModel();

        $data = [
            'id_album' => $id_album,
            'photos' => $postModel->getPostsByAlbum($id_album),
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
                'posts' => $postModel->getPostsByAlbum($album['id_album']),
            ];

            $albums[] = $albumData;
        }

        return $albums;
    }
   
}