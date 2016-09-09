<?php
include_once('dbMySQL.php');  

class Dipendente extends DB_con {
	
	public $id 					= '';
	public $id_utente 			= '';
	public $nome 				= '';
	public $cognome 			= '';
	public $indirizzo  			= '';
	public $citta		 		= '';
	public $provincia	 		= '';
	public $cap			 		= '';
	public $data_nascita		= '';
	public $telefono	 		= '';
	public $cellulare	 		= '';
	public $mail	 			= '';
	public $partitaiva	 		= '';
	public $codicefiscale 		= '';
	public $operatrice 			= '';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM dipendenti WHERE id = '$id'";

			$res=$this->conn->query($query);
			$dipendente = $res->fetch_object();

			$this->id 				= $dipendente->id;
			$this->id_utente 		= $dipendente->id_utente;
			$this->nome 			= $dipendente->nome;
			$this->cognome 			= $dipendente->cognome;
			$this->data_nascita 	= $dipendente->data_nascita;	
			$this->indirizzo 		= $dipendente->indirizzo;
			$this->citta 			= $dipendente->citta;	
			$this->provincia 		= $dipendente->provincia;
			$this->cap 				= $dipendente->cap;
			$this->telefono 		= $dipendente->telefono;
			$this->cellulare 		= $dipendente->cellulare;
			$this->mail 			= $dipendente->mail;
			$this->partitaiva 		= $dipendente->partitaiva;
			$this->codicefiscale 	= $dipendente->codicefiscale;
			$this->operatrice 		= $dipendente->operatrice;
				
		}
    }
    
    static function aggiorna_dipendente($idUtente,$newnomeutente,$newuser,$password,$newlivello){
		$db_con = new DB_con();
		$newpassword = $db_con->checkPWD($idUtente,$password);
		$table 			= 'dipendenti';
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
    

	static public function insert_dipendente($nome,$cognome,$indirizzo,$citta,$provincia,$cap,$data_nascita,$telefono,$cellulare,$mail,$partitaiva,$codicefiscale,$operatrice,$registrare)  {
		$db_con = new DB_con();
		//echo $password;
		if ($registrare) {
			$id_utente=$db_con->last_user_id();
			echo $id_utente;
			exit();
		}
		
		$dati_dip = array('id'=>NULL,'idutente'=>$id_utente,'nome'=>$nome,'cognome'=>$cognome,'data_nascita'=>$data_nascita,'indirizzo'=>$indirizzo,'citta'=>$citta,'provincia'=>$provincia,'cap'=>$cap,'telefono'=>$telefono,'cellulare'=>$cellulare,'mail'=>$mail,'partitaiva'=>$partitaiva,'codicefiscale'=>$codicefiscale,'operatrice'=>$operatrice);
		$table 			= 'dipendenti';
		$id_nuovo_dip = $db_con->insert($table,$dati_dip);
		
		return $id_nuovo_dip;
	}

	public function del_dipendente($id) {
		$deluser="DELETE FROM dipendenti WHERE id = '$id'";
    	$this->res= $this->conn->query($deluser);
	  return $this->res;
	}

	 
}

?>