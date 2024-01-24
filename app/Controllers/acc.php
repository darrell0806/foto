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
    public function edit_profile()
    {
        // Dapatkan ID pengguna dari sesi saat login
        $userId = session()->get('id');

        // Inisialisasi model pengguna
        $userModel = new UserModel();

        // Dapatkan data pengguna berdasarkan ID
        $userData = $userModel->getUserById($userId);

        echo view('header');
        echo view('edit_profile', ['userData' => $userData]);
        echo view('footer');
    }

    public function updateProfile()
    {
        $userModel = new UserModel();

        // Dapatkan id_user dari session
        $userId = session()->get('id');

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $nama = $this->request->getPost('nama');
        $foto = $this->request->getFile('foto');

        // Tentukan nama file foto baru (jika diupload)
        $imageName = null;

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $imageName = $foto->getName();
            $foto->move('images/', $imageName);
        }

        // Update data user
        $userData = [
            'username' => $username,
            'nama' => $nama,
            'foto'     => $imageName
        ];

        $userModel->updateUser($userId, $userData);

        // Redirect kembali ke halaman edit dengan pesan sukses
        return redirect()->to(base_url('/acc/edit_profile'))->with('success', 'Profile updated successfully.');
    }
}
