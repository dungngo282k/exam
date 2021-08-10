<?php
include 'inc/config.php';
include 'inc/db.php';
include 'inc/class_model.php';
include 'inc/class_controller.php';
$module = DEFAULT_MODULE;
$method = DEFAULT_METHOD;
date_default_timezone_set('Asia/Ho_Chi_Minh');
if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
	if( isset($_GET['module']) ){
		$module = $_GET['module'];
	}
	if( isset($_GET['action']) ){
		$method = '_' . $_GET['action']; 
	}
}else if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if( isset($_POST['data']) ){
		parse_str($_POST['data'], $_POST);
	}
	if( isset($_POST['module']) ){
		$module = $_POST['module'];
	}
	if( isset($_POST['action']) ){
		$method = 'action_' . $_POST['action'];
	}
}
if( empty($_COOKIE['is_user_logged_in']) ){
	if( $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['module'] == 'users' && $_POST['action'] == 'login' ){
		//
	}else{
		$module = 'users';
		$method = '_login';
	}
}
$file_module = 'modules/' . $module . '/controller.php';
$file_model = 'modules/' . $module . '/model.php';
foreach( glob('modules/*') as $folder ){
	$ext = explode('.php', $folder);
	if( count($ext) == 1 ){
		if( file_exists($folder . '/controller.php') ){
			require_once $folder . '/controller.php';
		}
		if( file_exists($folder . '/model.php') ){
			require_once $folder . '/model.php';
		}
	}
}
$module = '\controller\\' . $module;
$module = new $module();
if( method_exists($module, $method) ){
	$module->$method();
}