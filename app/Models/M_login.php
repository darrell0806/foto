<?php

namespace App\Models;
use CodeIgniter\Model;

class M_login extends Model
{		
	public function getLogin($table, $where)
	{
		return $this->db->table($table)->getWhere($where)->getRowArray();
	}

	public function getLoginWithPassword($table, $username, $password)
	{
		$query = $this->db->table($table)
		->where('username', $username)
		->where('password', md5($password))
		->get();
		return $query->getRowArray();
	}
}