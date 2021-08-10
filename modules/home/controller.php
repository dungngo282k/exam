<?php
namespace controller;
class home extends \inc\controller{
	public function __construct(){
		parent::__construct();
	}
	public function run(){
		$this->show('home','home');
	}
}
?>