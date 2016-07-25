<?php
//include_once '../conn/db.php';

define('DB_SERVER','');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','');

class DB_con {
	 function __construct()  {
	  $conn = mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die('localhost connection problem'.mysql_error());
	  mysql_select_db(DB_NAME, $conn);
	 }
	 
	 public function select($table)  {
	  $res=mysql_query("SELECT * FROM $table");
	  return $res;
	 }
	 
	 public function insert_magazzino($table,$barcode,$nome,$prezzo,$quantita,$costo)  {
	  $res = mysql_query("INSERT INTO $table (Barcode,nome,prezzo,quantita,costo) VALUES('$barcode','$nome','$prezzo','$quantita','$costo')");
	  return $res;
	 }
	 public function insert_user($table,$idUtente,$nome,$user,$password,$livello)  {
	  $res = mysql_query("INSERT INTO $table (idUtente,nome,user,password,livello) VALUES('$idUtente','$nome','$user','$password','$livello')");
	  return $res;
	 }
	 
}
?>