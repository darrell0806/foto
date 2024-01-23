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
        // Dapatkan ID pengguna dari sesi saat login
        $userModel = new UserModel();

        // Dapatkan id_user dari session
        $userId = session()->get('id');

        // Dapatkan data user berdasarkan id_user
        $userData = $userModel->getUserById($userId);

      

        // Ambil data dari form
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $newFoto = $this->request->getFile('foto');

        // Tentukan nama file foto baru (jika diupload)
        $fotoName = $newFoto->getRandomName();

        // Jika foto baru diupload, pindahkan ke folder images dan update nama file foto di database
        if ($newFoto->isValid() && !$newFoto->hasMoved()) {
            $newFoto->move(ROOTPATH . 'public/images', $fotoName);

            // Hapus foto lama jika ada
            if (!empty($userData['foto'])) {
                unlink(ROOTPATH . 'public/images/' . $userData['foto']);
            }
        } else {
            // Jika tidak ada foto baru diupload, gunakan foto lama
            $fotoName = $userData['foto'];
        }

        // Update data user
        $userModel->updateUser($userId, [
            'nama'     => $nama,
            'username' => $username,
            'foto'     => $fotoName,
        ]);

        // Redirect kembali ke halaman edit dengan pesan sukses
        return redirect()->to(base_url('/acc'))->with('success', 'Profile updated successfully.');
    
    }
}
