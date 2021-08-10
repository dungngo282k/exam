<?php
namespace controller;
class users extends \inc\controller{
	public function __construct(){
		parent::__construct();
		$this->model = new \model\users();
	}
	public function run(){
		$this->data['rows'] = $this->model->getUsers();
		$this->show('users','list');
	}
	public function _login(){
		$this->show('users', 'login');
	}
	public function action_login(){
		$response = [
			'message' => 'Đăng nhập thất bại',
			'status' => 'error'
		];
		if( !empty($_POST['login']) && !empty($_POST['pass'])  ){
			$row = $this->model->getUser(['user_login' => $_POST['login'], 'user_pass' => md5($_POST['pass'])]);
			if( empty($row) ){
				$row = $this->model->getUser(['user_email' => $_POST['login'], 'user_pass' => md5($_POST['pass'])]);
			}
			if( !empty($row) ){
				$token = md5($row['ID'].time());
				setcookie('is_user_logged_in', $token, time() + 2592000);
				$this->model->addUserMeta($row['ID'], '_session', $token);
				$response['redirect_to'] = '/';
				$response['status'] = 'success';
				$response['message'] = 'Đăng nhập thành công';
			}else{
				$response['message'] = 'Tên người dùng hoặc mật khẩu không đúng';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	public function _logout(){
		setcookie('is_user_logged_in', '', time()-2592000);
		header('location: /');
	}
	public function _add(){
		$this->show('users','add');
	}
	public function action_add(){
		$response = [
			'message' => 'Thêm người dùng thất bại',
			'status' => 'error'
		];
		if( !empty($_POST['user_login']) && !empty($_POST['user_pass']) && !empty($_POST['user_email']) ){
			$result = $this->model->insertUser($_POST);
		}else{
			$response['message'] = 'Bạn cần nhập đầy đủ thông tin';
		}
		if( $result > 0 ){
			//$response['redirect_to'] = '/?module=users';
			$response['message'] = 'Thêm thành công';
			$response['status'] = 'success';
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	public function _edit(){
		$this->data['row'] = $this->model->getUser(['ID' => $_GET['ID']]);
		$this->show('users','edit');
	}
	public function action_edit(){
		$response = [
			'message' => 'Sửa người dùng thất bại',
			'status' => 'error'
		];
		if( !empty($_POST['user_login']) && !empty($_POST['user_email']) ){
			$result = $this->model->updateUser($_POST);
		}else{
			$response['message'] = 'Bạn cần nhập đầy đủ thông tin';
		}
		if( $result > 0 ){
			$response['redirect_to'] = '/?module=users';
			$response['message'] = 'Sửa thành công';
			$response['status'] = 'success';
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	public function action_delete(){
		$result = $this->model->deleteUser($_POST['ID']);
		$this->data['rows'] = $this->model->getUsers();
		$this->show('users','data-list');
	}
}