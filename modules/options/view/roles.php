option_name: _roles
option_value: sử dụng json_encode() để chuyển mảng php thành chuỗi json.
Lưu bảng options

[
	'role_name' => 'admin',
	'role_title' => 'Quản trị viên',
	'capabilities' => [
		'posts' => ['add', 'edit', 'delete'],
		'users' => ['add', 'edit', 'delete'],
		'comments' => ['add', 'edit', 'delete'],
		'options' => ['add', 'edit', 'delete'],
	]
]

[
	'role_name' => 'member',
	'role_title' => 'Thành viên',
	'capabilities' => [
		'posts' => ['add', 'edit'],
		'comments' => ['add'],
	]
]