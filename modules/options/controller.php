<?php
namespace controller;
class options extends \inc\controller{
	public function __construct(){
		parent::__construct();
		$this->model = new \model\options();
	}
	public function roles(){
		$this->show('options','role');
	}
}
?>