<?php

namespace App\Controllers;
use App\Models\M_login;
use App\Models\M_model;


class Home extends BaseController
{
    protected function isLoggedIn()
    {
         return session()->has('id');
     }
    public function index()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to('dashboard');
        }
  
        echo view('login/view');

    }

    public function aksi_login()
    {
        $u=$this->request->getPost('username');
        $p=$this->request->getPost('password');

        // Tambahkan validasi jika field kosong
        if (empty($u) && empty($p)) {
            session()->setFlashdata('error', 'Username dan password tidak boleh kosong');
            return redirect()->to('/Home');
        }

        if (empty($u)) {
            session()->setFlashdata('error', 'Username tidak boleh kosong');
            return redirect()->to('/Home');
        }

        if (empty($p)) {
            session()->setFlashdata('error', 'Password tidak boleh kosong');
            return redirect()->to('/Home');
        }

        $model= new M_login();
        $data=array(
            'username'=>$u,
            'password'=>$p

        );
        $cek=$model->getLoginWithPassword('user', $u, $p);
        if ($cek !== null) {
            session()->set('id', $cek['id_user']);
            session()->set('username', $cek['username']);
            return redirect()->to('dashboard');
        }else {
            // Tambahkan peringatan username atau password salah
            session()->setFlashdata('error', ' Username atau password Anda salah');
            return redirect()->to('/Home');
        }
    }

    public function log_out()
    {
        session()->destroy();
        return redirect()->to('/Home');
    }
    public function register()
    {
        
		echo view('login/register');
       
	
    }
    public function aksi_register()
{
    $a = $this->request->getPost('username');
    $b = $this->request->getPost('password');
    $c = $this->request->getPost('nama');
    
  
    $imageName = 'default.jpg';

    $simpan = array(
        'username' => $a,
        'password' =>md5($b),
        'nama' => $c,
        'foto' => $imageName
    );

    $model = new M_model();
    $model->simpan('user', $simpan);

    return redirect()->to('/Home');
}
}
