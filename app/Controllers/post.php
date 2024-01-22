<?php

namespace App\Controllers;
use App\Models\M_model;



class post extends BaseController
{
  
    public function index()
    {
        $model=new M_model();
        $data['c']=$model->tampil('album');
      echo view('header');
      echo view('post',$data);
      echo view('footer');
    }
    public function aksi_tambah()
    { 
       
        $a= $this->request->getPost('deskripsi');
        $b= $this->request->getPost('album');
        $c = session()->get('id');
        $foto = $this->request->getFile('foto');
        if ($foto->isValid() && !$foto->hasMoved()) {
            $imageName = $foto->getRandomName();
            $foto->move('images/', $imageName);
        } else {
            $imageName = 'default.jpg';
        }
    
        $data1=array(
            'deskripsi'=>$a,
            'fotop'=>$imageName,
            'album'=>$b,
            'user_maker'=>$c,
            'created_at'=>date('Y-m-d H:i:s')
    
        );
        
    
            $model=new M_model();
            $model->simpan('post', $data1);
            return redirect()->to('dashboard');
      
    }
}