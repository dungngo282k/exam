<table class="table table-hover text-nowrap">
  <thead>
	<tr>
	  <th>ID</th>
	  <th>Tên hiển thị</th>
	  <th>Ngày đăng ký</th>
	  <th>Trạng thái</th>
	  <th>Thao tác</th>
	</tr>
  </thead>
  <tbody>
  <?php
  if( !empty($this->data['rows']) ){
	  foreach($this->data['rows'] as $user){
		  $status = ['Khóa', 'Mở'];
	  ?>
	  <tr>
		  <td><?php echo $user['ID']; ?></td>
		  <td><?php echo $user['display_name']; ?><br><small><?php echo $user['user_login']; ?></small></td>
		  <td><?php echo date('d/m/Y', strtotime($user['user_registered'])); ?></td>
		  <td><span class="tag tag-success"><?php echo $status[$user['user_status']]; ?></span></td>
		  <td>
			<a href="/?module=users&action=edit&ID=<?php echo $user['ID']; ?>" class="btn btn-sm btn-primary">Sửa</a>
			<a href="#" data-result_to="data-list" data-confirm="Bạn có chắc muốn xóa <?php echo $user['user_login']; ?>?" data-module="users" data-id="<?php echo $user['ID']; ?>" class="btn btn-delete btn-sm btn-danger">Xóa</a>
		  </td>
	  </tr>
	  <?php					  
	  }
  }
  ?>
  </tbody>
</table>