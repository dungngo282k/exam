<?php
namespace inc;
class controller{
	public $model;
	public $data;
	function __construct(){
		$model = new \model\users();
		$token = $_COOKIE['is_user_logged_in'];
		$row = $model->getUserMeta(['meta_key' => '_session', 'meta_value' => $token]);
		if( !empty($row) ){
			$this->data['current_user'] = $model->getUser(['ID' => $row['user_id']]);
		}
	}
	public function show($module, $tpl){
		include 'modules/' . $module . '/view/' . $tpl . '.php';
	}
}