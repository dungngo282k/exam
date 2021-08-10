<?php
namespace inc;
class MyDB{
	private $mysqli;
	public function __construct(){
		$this->_connect();
	}
	private function _connect(){
		$this->mysqli = new \mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if (mysqli_connect_errno()) {
			die("Failed to connect to MySQL: " . mysqli_connect_error());
		}
		$this->mysqli->set_charset("utf8");
	}
	public function _close(){
		$this->mysqli->close();
	}
	private function query($sql){
		return $this->mysqli->query($sql);
	}
	public function setConditions($where){
		$columns = [];
		foreach( $where as $key => $value ){
			$columns[] = $key . "='" . $value . "'";
		}
		return implode(' AND ', $columns);
	}
	public function get_rows($table, $where = ''){
		$sql = "SELECT * FROM $table";
		if(!empty($where) ){
			$sql .= " WHERE " . $where;
		}
		$result = $this->query($sql);
		$rows = [];
		while( $row = $result->fetch_assoc() ){
			$rows[] = $row;
		}
		$result->free_result();
		return $rows;
	}
	public function get_row($table, $where = ''){
		$sql = "SELECT * FROM $table";
		if(!empty($where) ){
			if( is_array($where) ){
				$where = $this->setConditions($where);
			}
			$sql .= " WHERE " . $where;
		}
		$result = $this->query($sql);
		$row = $result->fetch_assoc();
		$result->free_result();
		return $row;
	}
	public function _insert($table, $data){
		$keys = implode(',', array_keys($data));
		$values = implode("','", array_values($data));
		$sql = "INSERT INTO $table (" . $keys . ") VALUES ('" . $values . "')";
		$result = $this->query($sql);
		$insert_id = $this->mysqli->insert_id;
		if( $insert_id ){
			return $insert_id;
		}
		return 0;
	}
	public function _update($table, $data, $where){
		$columns = [];
		foreach( $data as $key => $value ){
			$columns[] = $key . "='" . $value . "'";
		}
		$where = $this->setConditions($where);
		$sql = "UPDATE $table SET " . implode(',', $columns) . " WHERE " . $where;
		return $this->query($sql);
	}
	public function _delete($table, $where){
		$where = $this->setConditions($where);
		$sql = "DELETE FROM $table WHERE " . $where;
		return $this->query($sql);
	}
	public function __destruct(){
		$this->_close();
	}
}