<?php
class DBController {
	private $host = "feenix-mariadb.swin.edu.au";
	private $user = "s104175342";
	private $password = "nxr3q423ks";
	private $database = "s104175342_db";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn, $query);
		$resultset = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if (!empty($resultset)) {
			return $resultset;
		}
		return null;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>
