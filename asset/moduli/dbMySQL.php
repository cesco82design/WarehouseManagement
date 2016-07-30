<?php
//include_once '../conn/db.php';

define('DB_SERVER','');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','');

class DB_con {
	protected $conn;

	//Attributi accessibili anche fuori dalla classe
	public $salt = '1234';

	function __construct()  {
	  $this->conn = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	  if (mysqli_connect_errno()) {
	   printf("Connect failed: %s\n", mysqli_connect_error());
	   exit();
	  }
	  return $this;
	}

	public function CheckLogin($user,$pwd) {
		$this->res= $this->conn->query("SELECT * FROM utenti WHERE user = '$user' AND password = '$pwd'");
		return $this->res;
	}
	public function select($table) {
		$this->res= $this->conn->query("SELECT * FROM $table");
		return $this->res;
	}  
	public function pulisci_stringa($stringa){
		return $this->conn->real_escape_string(trim($stringa));
	}

	public function salta_pwd($pwd){
		return sha1($this->pulisci_stringa($pwd).$this->salt);
	}
	 
	public function insert( $table,$dati ) {
		$colonne = array();
		$valori = array();
		if ( is_array($dati) && !empty($dati) ) {
			foreach($dati as $key => $value) {
				$colonne[] = $key;
				$valori[] = $value;
			}
			//print_r($colonne);
			//print_r($valori);
			$sql = ('INSERT INTO Magazzino (' . implode(',', $colonne) . ') VALUES (' . implode(',', $valori) . ')');
			echo $sql;
			var_dump($this->conn);
			$result = $this->conn->query($sql);
			var_dump($result);
			/*
			if ( $result ) {
				return $this->conn->query('SELECT LAST_INSERT_ID()');
			}*/
		}
		return false;
	}
}
?>