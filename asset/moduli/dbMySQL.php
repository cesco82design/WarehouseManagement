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
	public $testo_esempio;

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
	 public function insert_magazzino($barcode,$nome,$prezzo,$quantita,$costo)  {
	  $this->res= $this->conn->query("INSERT INTO Magazzino (Barcode,nome,prezzo,quantita,costo) VALUES('$barcode','$nome','$prezzo','$quantita','$costo')");
	  return $this->res;
	 }
	 public function checkUserExist($user) {
	 	$this->check= $this->conn->query("SELECT * FROM utenti WHERE user = '$user'");
	 	return $this->check;
	 }
	 public function insert_user($idUtente,$nome,$user,$password,$livello)  {
	 	$this->check= checkUserExist($user);
	 	$conta = $this->check->num_rows;
	 	if ($conta!=1){
	  		$this->res= $this->conn->query("INSERT INTO utenti (idUtente,nome,user,password,livello) VALUES('$idUtente','$nome','$user','$password','$livello')");
		  return $this->res;
		} else {
			header('location:?messaggio=l\'utente scelto è già in uso');
		}
	 }
	 
}
?>