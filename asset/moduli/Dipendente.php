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
			$this->idutente 		= $dipendente->idutente;
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
    
    static function aggiorna_dipendente($idUtente,$nome,$cognome,$indirizzo,$citta,$provincia,$cap,$data_nascita,$telefono,$cellulare,$mail,$partitaiva,$codicefiscale,$operatrice){
		$db_con = new DB_con();
		$table = 'dipendenti';
    		$fields = array('nome'=>$nome,'cognome'=>$cognome,'indirizzo'=>$indirizzo,'citta'=>$citta,'provincia'=>$provincia,'cap'=>$cap,'data_nascita'=>$data_nascita,'telefono'=>$telefono,'cellulare'=>$cellulare,'mail'=>$mail,'partitaiva'=>$partitaiva,'codicefiscale'=>$codicefiscale,'operatrice'=>$operatrice);
    		$res = $db_con->update($table, $idUtente, $fields);
    	
    	return $res;
    }
    

	static public function insert_dipendente($nome,$cognome,$indirizzo,$citta,$provincia,$cap,$data_nascita,$telefono,$cellulare,$mail,$partitaiva,$codicefiscale,$operatrice,$registrare)  {
		$db_con = new DB_con();
		//echo $password;
		//echo $nome.' - '.$cognome.' - '.$indirizzo.' - '.$citta.' - '.$provincia.' - '.$cap.' - '.$data_nascita.' - '.$telefono.' - '.$cellulare.' - '.$mail.' - '.$partitaiva.' - '.$codicefiscale.' - '.$operatrice.' - '.$registrare;
		//exit();
		if ($registrare=='on') {
			$id_utente=$db_con->last_user_id();
			$new_utente_id = $id_utente->fetch_object();
			$new_id_utente = $new_utente_id->maxid;
			//return $new_id_utente;
		}
		//echo $new_utente->maxid;
		
		
		$dati_dip = array('id'=>NULL,'idutente'=>$new_id_utente,'nome'=>$nome,'cognome'=>$cognome,'indirizzo'=>$indirizzo,'citta'=>$citta,'provincia'=>$provincia,'cap'=>$cap,'data_nascita'=>$data_nascita,'telefono'=>$telefono,'cellulare'=>$cellulare,'mail'=>$mail,'partitaiva'=>$partitaiva,'codicefiscale'=>$codicefiscale,'operatrice'=>$operatrice);
		/*print_r($dati_dip);
		exit();*/
		$table 			= 'dipendenti';
		$id_nuovo_dip = $db_con->insert($table,$dati_dip);
		
		return $id_nuovo_dip;
	}

	public function del_dipendente($id) {
		$deluser="DELETE FROM dipendenti WHERE id = '$id'";
    	$this->res= $this->conn->query($deluser);
	  return $this->res;
	}

	public function select_operatrici() {
		$sql = "SELECT * FROM dipendenti WHERE operatrice !=''";
		$this->res= $this->conn->query($sql);
	  return $this->res;
	}

	 
}

?>