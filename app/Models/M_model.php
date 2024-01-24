<?php namespace App\Models;

use CodeIgniter\Model;

class M_model extends Model
{
public function tampil($table) {
        return $this->db->table($table)
        ->orderBy('created_at', 'desc')
        ->get()
        ->getResult();
    }
    
    
    public function geta()
    {
        return $this->findAll();
    }
    public function hapus($table, $where){
        return $this->db->table($table)->delete($where);
    }
    public function simpan($table, $data){
        return $this->db->table($table)->insert($data);
    }
    public function getWhere($table, $where){
        return $this->db->table($table)->getWhere($where)->getRow();
    }
    public function qedit($table, $data, $where){
        return $this->db->table($table)->update($data, $where);
    }
    
}