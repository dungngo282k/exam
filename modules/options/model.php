<?php
namespace model;
class options extends \inc\model{
	public function addOption($data){
		$data_insert = [
			'option_name' => $data['option_name'],
			'option_value' => $data['option_value'],
		];
		return $this->db()->_insert(DB_PREFIX . 'options', $data_insert);
	}
	public function updateOption($data){
		$data_update = [
			'option_name' => $data['option_name'],
			'option_value' => $data['option_value'],
		];
		return $this->db()->_update(DB_PREFIX . 'options', $data_update, ['option_id' => $_POST['option_id']]);
	}
	public function getOptions($args = []){
		return $this->db()->get_rows(DB_PREFIX . 'options');
	}
	public function getOption($where){
		return $this->db()->get_row(DB_PREFIX . 'options', $where);
	}
	public function deleteOption($where){
		return $this->db()->_delete(DB_PREFIX . 'options', $where);
	}
}