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
			//echo $query.'  /  '; // aggiungo un po' di spazio tra una stampa e l'altra di debug
			$res=$this->conn->query($query);
//			var_dump($$res);
			//print_r($res);
			//echo '  /  ';  // aggiungo un po' di spazio tra una stampa e l'altra di debug
			$utente = $res->fetch_object();
			//print_r($utente);
//			return $utente;
			//echo  $utente->nomeutente;

			$this->idUtente 		= $utente->idUtente;
			$this->nomeutente 		= $utente->nomeutente;
			$this->user 			= $utente->user;
			$this->password 		= $utente->password;
			$this->livello 			= $utente->livello;	
				
		}
    }
    
    public function aggiorna_utente($idUtente,$newnomeutente,$newuser,$newpwd,$newlivello){
    	$update="UPDATE utenti SET nomeutente='$newnomeutente',user='$newuser', password='$newpwd', livello='$newlivello' WHERE idUtente = '$idUtente'";
    	$updateNoPwd="UPDATE utenti SET nomeutente='$newnomeutente',user='$newuser', livello='$newlivello' WHERE idUtente = '$idUtente'";
    	
    	$checku = $this->checkUserExist($idUtente,$newuser);

	 	$contau = $checku->num_rows;
	 	
	 	if ($contau==1){
	 		header('location:?idUtente='.$idUtente.'&messaggio=l\'utente scelto è già in uso');
	 		
    	} else {
	    	$checkpass = $this->checkPWD($newpwd);
	    	if ($checkpass) {
	 			$res= $this->conn->query($update);
	 			header('location:../../lista_utenti.php?messaggio=l\'utente è stato aggiornato');
	 		} else {
	    		$res= $this->conn->query($updateNoPwd);
	    		header('location:../../lista_utenti.php?messaggio=l\'utente è stato aggiornato MA la password NON è stata modificata');
	    	}
    	}
    }
    public function checkPWD($pwd) {
    	if (!is_null($pwd)) {
    		return true;
    	} else {
    		return false;
    	}
    }
    
	public function checkUserExist($idUtente,$user) {
		$check= $this->conn->query("SELECT * FROM utenti WHERE user = '$user' AND idUtente != '$idUtente'");
	 	return $check;
	}


	static public function insert_user($nomeutente,$user,$password,$livello)  {
		$db_con = new DB_con();
		$dati_utente = array('nomeutente'=>$nomeutente,'user'=>$user,'password'=>$password,'livello'=>$livello);
		$table 			= 'utenti';
		$checkUser = $db_con->checknewUserExist($user);
		var_dump($checkUser);
		return false;/*
		if ($checkUser->num_rows==1){
			header('location:?messaggio=lo username scelto è già utilizzato');
			return false;
		} else {
			$id_nuovo_utente = $db_con->insert($table,$dati_utente);
		}
		/*
		if ( $id_nuovo_utente ) {
			$prodotto = new User($id_nuovo_utente);
			if ( $utente ) {
				return $utente;
			}
		}* /
		return true;*/
	}

	public function del_utente($idUtente) {
		$deluser="DELETE FROM utenti WHERE idUtente = '$idUtente'";
    	$this->res= $this->conn->query($deluser);
	  return $this->res;
	}

	 
}

?>