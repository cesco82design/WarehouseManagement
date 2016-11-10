<?php
//include_once '../conn/db.php';

define('DB_SERVER','');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','');

class DB_con {
	protected $conn;
	protected $table = '';

	public $salt = '1234';

	function __construct()  {
	  $this->conn = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	  if (mysqli_connect_errno()) {
	   printf("Connect failed: %s\n", mysqli_connect_error());
	   exit();
	  }
	  return $this;
	}

	public function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	public function CheckLogin($user,$pwd) {
		$this->res= $this->conn->query("SELECT * FROM utenti WHERE username = '$user' AND password = '$pwd'");
		return $this->res;
	}

	public function select($table) {
		$this->res= $this->conn->query("SELECT * FROM $table");
		return $this->res;
	}  

	public function pulisci_stringa($stringa){
		$res = $this->conn->real_escape_string(trim(addslashes($stringa)));
		return str_replace('\'', '&squo;', $res);
	}

	public function validate_email($stringa){
		$email = $this->test_input($stringa);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  header('location:'.$_SERVER['HTTP_REFERER'].'?alert=danger&messaggio=la mail inserita non è valida');
		} else {
			return $stringa;
		}
	}
	public function validate_url($stringa){
		$website = $this->test_input($stringa);
	    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
	    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
	       header('location:'.$_SERVER['HTTP_REFERER'].'?alert=danger&messaggio=L\'URL inserito non è valido'); 
	    } else {
			return $stringa;
		}
	}

	public function salta_pwd($pwd){
			return sha1($this->pulisci_stringa($pwd).$this->salt);		
	}

	public function reg_pwd($pwd){
		if (!is_null($pwd)){
			   $checkpassword =  preg_match( '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,16}/',$pwd);
		    if ($checkpassword!=1){
        		header('location:'.$_SERVER['HTTP_REFERER'].'?alert=danger&messaggio=la password non soddisfa i criteri di sicurezza');
        	} else {
    		//return TRUE;
	    		return sha1($this->pulisci_stringa($pwd).$this->salt);	
	    	}
				//return sha1($this->pulisci_stringa($pwd).$this->salt);		
    		
		} 
		return false;
	}
	 
    public function checkPWD($id,$pwd) {
    	if (!is_null($pwd)) {
    		$res= $this->conn->query("SELECT * FROM utenti WHERE id = '$id'");
  
    		$utente = $res->fetch_object();
	    		if ($pwd==$utente->password){
	    			return $pwd;
	    		} else {
	    			$password = $this->reg_pwd($pwd);
	    			if (!$password) exit();
	    			return $password;
	    		}
    	} else {
			return false;
    	}
    }

	public function checkUserExist($id,$user) {
		$check= $this->conn->query("SELECT * FROM utenti WHERE username = '$user' AND id != '$id'");
	 	return $check;
	}
	public function checknewUserExist($user) {
		$check= $this->conn->query("SELECT * FROM utenti WHERE username = '$user'");
	 	return $check;
	}
	public function insert( $table,$dati ) {
		$colonne = array();
		$valori = array();

		if ( is_array($dati) && !empty($dati) ) {
			foreach($dati as $key => $value) {
				$colonne[] = $key;
				$valori[] = $value;
			}
			/*
			print_r($colonne);
			print_r($valori);*/
			$sql = ('INSERT INTO '.$table.' (' . implode(',', $colonne) . ') VALUES (\'' . implode('\',\'', $valori) . '\')');
			
			$result = $this->conn->query($sql);
			/*echo $sql;
			var_dump($result);
			exit();*/
			if ( $result ) {
				return $this->conn->query('SELECT LAST_INSERT_ID()');
			}
		}
		return true;
	}
	public function update($table, $id, $fields){
		$set = '';
		$x = 1;
		
		foreach($fields as $name => $value){
			$set .= "{$name} = '$value'";
			if($x < count($fields)){
				$set .= ', ';
			}
			$x++;
		}
		
		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id} ";

		if($this->conn->query($sql)){
			return true;
		}
		return false;
	}	

	public function last_user_id() {
		$last_id="SELECT Max(id) AS maxid FROM utenti";
    	$this->res=$this->conn->query($last_id);
	  return $this->res;
	}	

	public function last_card_id() {
		$last_id="SELECT Max(id) AS maxid FROM card";
    	$this->res=$this->conn->query($last_id);
	  return $this->res;
	}	

	public function last_client_id() {
		$last_id="SELECT Max(id) AS maxid FROM clienti";
    	$this->res=$this->conn->query($last_id);
	  return $this->res;
	}	

	public function sel_ID_prod($barcode) {
		$sql = "SELECT id FROM prodotti WHERE barcode = '$barcode'";
		$this->res = $this->conn->query($sql);
		$prod_id = $this->res->fetch_object();
		$id_prod = $prod_id->id;
	  	return $id_prod;
	}
}
?>