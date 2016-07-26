<?php
//include_once '../conn/db.php';

define('DB_SERVER','');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','');

class CheckLogin {
	public function collega_db() {
		$conn = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		if($conn->connect_errno){die('errore: Impossibile connettersi al database. '.$conn->connect_error);}
	}
	public function scollega_db() {
		global $conn;
		$conn->close();
	}
}

class MySQL {
	 public function connect()  {
		$mysqli = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		if($mysqli->connect_errno){die('errore: Impossibile connettersi al database. '.$mysqli->connect_error);}
		
	 }
	 
	 public function select($table)  {
	  	$sql = "SELECT * FROM $table;";
	  	$res =mysqli_query($mysqli,$sql);
	  return $res;
	 }
	 
	 public function insert_magazzino($barcode,$nome,$prezzo,$quantita,$costo)  {
	  $res = mysqli_query("INSERT INTO Magazzino (Barcode,nome,prezzo,quantita,costo) VALUES('$barcode','$nome','$prezzo','$quantita','$costo')");
	  return $res;
	 }
	 public function insert_user($idUtente,$nome,$user,$password,$livello)  {
	  $res = mysqli_query("INSERT INTO utenti (idUtente,nome,user,password,livello) VALUES('$idUtente','$nome','$user','$password','$livello')");
	  return $res;
	 }
	 
}
?>