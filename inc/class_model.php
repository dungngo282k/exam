<?php
namespace inc;
class model{
	function db(){
		$db = new \inc\MyDB();
		return $db;
	}
}