<?php
//include_once '../conn/db.php';

define('DB_SERVER','');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','');

class DB_con {
	protected $conn;
	protected $table = '';
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

	public function reg_pwd($pwd){
		if (!is_null($pwd)){
			if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pwd)) {
				if (strlen($pwd)>12){
					return false;
					header('location:'.$_SERVER['HTTP_REFERER'].'&alert=danger&messaggio=la password è troppo lunga');
				
				}
			   return false;
			   header('location:'.$_SERVER['HTTP_REFERER'].'&alert=danger&messaggio=la password non soddisfa i criteri di sicurezza');
			   
			} else {
				return sha1($this->pulisci_stringa($pwd).$this->salt);		
			}
		} 
	}
	 
	public function checknewUserExist($user) {
		$check= $this->conn->query("SELECT * FROM utenti WHERE user = '$user'");
	 	return $check;
	}
	public function insert( $dati ) {
		$colonne = array();
		$valori = array();
		if ( is_array($dati) && !empty($dati) ) {
			foreach($dati as $key => $value) {
				$colonne[] = $key;
				$valori[] = $value;
			}
			$sql = ('INSERT INTO '.$this->table.' (' . implode(',', $colonne) . ') VALUES (\'' . implode('\',\'', $valori) . '\')');
			$result = $this->conn->query($sql);
			
			if ( $result ) {
				return $this->conn->query('SELECT LAST_INSERT_ID()');
			}
		}
		return true;
	}
}
?>