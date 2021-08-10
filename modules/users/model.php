<?php
namespace model;
class users extends \inc\model{
	public function insertUser($data){
		$data_insert = [
			'user_login' => $data['user_login'],
			'display_name' => $data['display_name'],
			'user_email' => $data['user_email'],
			'user_pass' => md5($data['user_pass']),
			'user_registered' => date('Y-m-d H:i:s'),
			'user_status' => 1
		];
		return $this->db()->_insert(DB_PREFIX . 'users', $data_insert);
	}
	public function updateUser($data){
		$data_update = [
			'user_login' => $data['user_login'],
			'display_name' => $data['display_name'],
			'user_email' => $data['user_email'],
		];
		if( !empty($_POST['user_pass']) ){
			$data_update['user_pass'] = $_POST['user_pass'];
		}
		return $this->db()->_update(DB_PREFIX . 'users', $data_update, ['ID' => $_POST['ID']]);
	}
	public function getUsers($args = []){
		return $this->db()->get_rows(DB_PREFIX . 'users');
	}
	public function getUser($where){
		return $this->db()->get_row(DB_PREFIX . 'users', $where);
	}
	public function addUserMeta($id, $meta_key, $meta_value){
		$data_insert = [
			'user_id' => $id,
			'meta_key' => $meta_key,
			'meta_value' => $meta_value,
		];
		return $this->db()->_insert(DB_PREFIX . 'usermeta', $data_insert);
	}
	public function getUserMeta($where){
		return $this->db()->get_row(DB_PREFIX . 'usermeta', $where);
	}
	public function deleteUser($ID){
		return $this->db()->_delete(DB_PREFIX . 'users', ' ID=' . $ID);
	}
}