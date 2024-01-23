<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AlbumModel;

class acc extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $albumModel = new AlbumModel();

        // Ambil data pengguna berdasarkan ID pengguna yang terautentikasi
        $userId = session()->get('id'); // Sesuaikan dengan implementasi autentikasi Anda
        $userData = $userModel->find($userId);

        // Ambil daftar album berdasarkan ID pengguna
        $albums = $albumModel->getAlbumsByUser($userId);

        // Kirim data ke tampilan
        $data = [
            'userData' => $userData,
            'albums'   => $albums,
        ];
        echo view('header');
        echo view('account', $data);
        echo view('footer');
    }
}
