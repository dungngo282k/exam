<?php $this->show('layout', 'header'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Thêm người dùng mới</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Bảng điều kiển</a></li>
              <li class="breadcrumb-item"><a href="/?module=users">Người dùng</a></li>
              <li class="breadcrumb-item active">Thêm mới</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
			<div class="message"></div>
			<form method="post">
				<input name="module" value="users" type="hidden">
				<input name="action" value="add" type="hidden">
				<div class="card">
				  <!-- /.card-header -->
				  <div class="card-body">
					  <div class="form-group">
						<label for="user_login ">Tên đăng nhập</label>
						<input required type="text" name="user_login" class="form-control" id="user_login " placeholder="Nhập tên">
					  </div>
					  <div class="form-group">
						<label for="display_name">Tên hiển thị</label>
						<input required type="text" name="display_name" class="form-control" id="display_name" placeholder="Nhập tên hiển thị">
					  </div>
					  <div class="form-group">
						<label for="user_email">Địa chỉ Email</label>
						<input required type="email" name="user_email" class="form-control" id="user_email" placeholder="Nhập email">
					  </div>
					  <div class="form-group">
						<label for="user_pass">Mật khẩu</label>
						<input required name="user_pass" type="password" class="form-control" id="user_pass" placeholder="Nhập mật khẩu">
					  </div>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<button class="btn btn-primary">Lưu</button>
					</div>
				</div>
				<!-- /.card -->
			</form>
          </div>
        </div>
		<!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 
  <?php $this->show('layout', 'footer'); ?>