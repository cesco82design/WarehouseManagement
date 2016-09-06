<?php
include 'dbMySQL.php';  

class User extends DB_con {
	
	public $id 		= '';
	public $nome 		= '';
	public $cognome 		= '';
	public $username 			= '';
	public $password  		= '';
	public $livello 		= 'guest';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM utenti WHERE id = '$id'";

			$res=$this->conn->query($query);
			$utente = $res->fetch_object();

			$this->id 				= $utente->id;
			$this->nome 			= $utente->nome;
			$this->cognome 			= $utente->cognome;
			$this->username 		= $utente->username;
			$this->password 		= $utente->password;
			$this->livello 			= $utente->livello;	
				
		}
    }
    
    static function aggiorna_utente($idUtente,$newnomeutente,$newuser,$password,$newlivello){
		$db_con = new DB_con();
		$newpassword = $db_con->checkPWD($idUtente,$password);
		$table 			= 'utenti';
		/*echo $newpassword;
		exit();*/
		if ($newpassword) {
			$password = $newpassword;
		} else {
			header('location:'.$_SERVER['HTTP_REFERER'].'?alert=danger&messaggio=la password non soddisfa i criteri di sicurezza');
			return false;
			exit();
		}

    	$checku = $db_con->checkUserExist($idUtente,$newuser);
	 	$contau = $checku->num_rows;
	 	if ($contau==1){
	 		header('location:?idUtente='.$idUtente.'&alert=danger&messaggio=l\'utente scelto è già in uso');
    	} else {
    		$fields = array('nome'=>$newnomeutente,'cognome'=>$newcognome,'username'=>$newuser,'password'=>$password,'livello'=>$newlivello);
    		$res = $db_con->update($table, $idUtente, $fields);
    	}
    	return true;
    }
    


	static public function insert_user($nomeutente,$cognome,$username,$password,$livello)  {
		$db_con = new DB_con();
		//echo $password;
		$newpassword = $db_con->reg_pwd($password);
		/*echo $newpassword; 
		exit();*/
		if ($newpassword) {
			$password = $newpassword;
		} else {
				header('location:'.$_SERVER['HTTP_REFERER'].'?alert=danger&messaggio=la password non soddisfa i criteri');
				exit();
		}

		$dati_utente = array('id'=>NULL,'nome'=>$nomeutente,'cognome'=>$cognome,'username'=>$username,'password'=>$password,'livello'=>$livello);
		$table 			= 'utenti';
		$checkUser = $db_con->checknewUserExist($username);
		$contau = $checkUser->num_rows;
		/*echo $contau;
		exit();*/
		if ($contau==1) {
			header('location:?alert=danger&messaggio=lo username scelto è già utilizzato,devi sceglierne un altro');
			exit();
		} else {
			$id_nuovo_utente = $db_con->insert($table,$dati_utente);
		}
		return $id_nuovo_utente;
	}

	public function del_utente($id) {
		$deluser="DELETE FROM utenti WHERE id = '$id'";
    	$this->res= $this->conn->query($deluser);
	  return $this->res;
	}
	public function last_id() {
		$last_id="SELECT Max(id) FROM utenti";
    	$this->res= $this->conn->query($last_id);
	  return $this->res;
	}

	 
}

?>