<?php
include 'dbMySQL.php';  

class User extends DB_con {
	
	public $idUtente 		= '';
	public $nomeutente 		= '';
	public $user 			= '';
	public $password  		= '';
	public $livello 		= 'guest';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM utenti WHERE idUtente = '$id'";
			echo $query.'  /  '; // aggiungo un po' di spazio tra una stampa e l'altra di debug
			$res=$this->conn->query($query);
//			var_dump($$res);
			print_r($res);
			echo '  /  ';  // aggiungo un po' di spazio tra una stampa e l'altra di debug
			$utente = $res->fetch_object();
			print_r($utente);
//			return $utente;
			//echo $id;

			$this->$idUtente 		= $utente->idUtente;
			$this->$nomeutente 		= $utente->nomeutente;
			$this->$user 			= $utente->user;
			$this->$password 		= $utente->password;
			$this->$livello 		= $utente->livello;	
				
		}
    }
    
    public function aggiorna_utente($idUtente,$newnomeutente,$newuser,$newpwd,$newlivello){
    	$update="UPDATE utenti SET nomeutente='$newnomeutente',user='$newuser', password='$newpwd', livello='$newlivello' WHERE idUtente = '$id'";
    	$updateNoPwd="UPDATE utenti SET nomeutente='$newnomeutente',user='$newuser', livello='$newlivello' WHERE idUtente = '$id'";
    	$this->check= $this->conn->checkUserExist($newuser);
	 	$contau = $this->check->num_rows;
	 	if ($contau!=1){
	 		if ($this->checkpass= $this->conn->checkPWD($newpwd)) {
	 			$this->res= $this->conn->query($update);
	 		} else {
	    		$this->res= $this->conn->query($updateNoPwd);
	    	}
    	} else {
    		header('location:?messaggio=l\'utente scelto è già in uso');
    	}
    }
    public function checkPWD($pwd) {
    	if (!is_null($pwd)) {
    		return true;
    	} else {
    		return false;
    	}
    }
    
	public function checkUserExist($user) {
	 	$check= $this->conn->query("SELECT * FROM utenti WHERE user = '$user'");
	 	return $check;
	}
	/*
	public function insert_user($nome,$user,$password,$livello)  {
	 	$this->check= checkUserExist($user);
	 	$conta = $this->check->num_rows;
	 	if ($conta!=1){
	  		$this->res= $this->conn->query("INSERT INTO utenti (nome,user,password,livello) VALUES('$nome','$user','$password','$livello')");
		  return $this->res;
		} else {
			header('location:?messaggio=l\'utente scelto è già in uso');
		}
	}*/

	static public function insert_user($nomeutente,$user,$password,$livello)  {
		$db_con = new DB_con();
		$dati_utente = array('nomeutente'=>$nomeutente,'user'=>$user,'password'=>$password,'livello'=>$livello);
		$table 			= 'utenti';
		$id_nuovo_utente = $db_con->insert($table,$dati_utente);
		/*
		if ( $id_nuovo_utente ) {
			$prodotto = new User($id_nuovo_utente);
			if ( $utente ) {
				return $utente;
			}
		}*/
		return true;
	}

	public function del_utente($idUtente) {
		$deluser="DELETE FROM utenti WHERE idUtente = '$idUtente'";
    	$this->res= $this->conn->query($deluser);
	  return $this->res;
	}

	 
}

?>