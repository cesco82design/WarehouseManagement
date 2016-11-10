<?php
include_once('dbMySQL.php');  

class Fornitore extends DB_con {
	
	public $id 					= '';
	public $denominazione		= '';
	public $indirizzo  			= '';
	public $citta		 		= '';
	public $provincia	 		= '';
	public $cap			 		= '';
	public $telefono	 		= '';
	public $telefono2	 		= '';
	public $cellulare	 		= '';
	public $mail	 			= '';
	public $partitaiva	 		= '';
	public $codicefiscale 		= '';
	public $iban 				= '';
	public $sito 				= '';
	public $note	 			= '';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM fornitori WHERE id = '$id'";

			$res=$this->conn->query($query);
			$dipendente = $res->fetch_object();

			$this->id 				= $dipendente->id;
			$this->denominazione 	= $dipendente->denominazione;
			$this->indirizzo 		= $dipendente->indirizzo;
			$this->citta 			= $dipendente->citta;	
			$this->provincia 		= $dipendente->provincia;
			$this->cap 				= $dipendente->cap;
			$this->telefono 		= $dipendente->telefono;
			$this->telefono2 		= $dipendente->telefono2;
			$this->cellulare 		= $dipendente->cellulare;
			$this->mail 			= $dipendente->mail;
			$this->partitaiva 		= $dipendente->partitaiva;
			$this->codicefiscale 	= $dipendente->codicefiscale;
			$this->iban 			= $dipendente->iban;
			$this->sito 			= $dipendente->sito;
			$this->note 			= $dipendente->note;
				
		}
    }
    
    static function aggiorna_fornitore($id,$denominazione,$indirizzo,$citta,$provincia,$cap,$telefono,$telefono2,$cellulare,$mail,$partitaiva,$codicefiscale,$iban,$sito,$note){
		$db_con = new DB_con();
		$table = 'fornitori';
    		$fields = array('denominazione'=>$denominazione,'indirizzo'=>$indirizzo,'citta'=>$citta,'provincia'=>$provincia,'cap'=>$cap,'telefono'=>$telefono,'telefono2'=>$telefono2,'cellulare'=>$cellulare,'mail'=>$mail,'partitaiva'=>$partitaiva,'codicefiscale'=>$codicefiscale,'iban'=>$iban,'sito'=>$sito,'note'=>$note);
    		$res = $db_con->update($table, $id, $fields);
    	
    	return $res;
    }
    

	static public function insert_fornitore($denominazione,$indirizzo,$citta,$provincia,$cap,$telefono,$telefono2,$cellulare,$mail,$partitaiva,$codicefiscale,$iban,$sito,$note)  {
		$db_con = new DB_con();
		//echo $password;
		//echo $nome.' - '.$cognome.' - '.$indirizzo.' - '.$citta.' - '.$provincia.' - '.$cap.' - '.$data_nascita.' - '.$telefono.' - '.$cellulare.' - '.$mail.' - '.$partitaiva.' - '.$codicefiscale.' - '.$operatrice.' - '.$registrare;
		//exit();
		$dati_fornitore = array('id'=>NULL,'denominazione'=>$denominazione,'indirizzo'=>$indirizzo,'citta'=>$citta,'provincia'=>$provincia,'cap'=>$cap,'telefono'=>$telefono,'telefono2'=>$telefono2,'cellulare'=>$cellulare,'mail'=>$mail,'partitaiva'=>$partitaiva,'codicefiscale'=>$codicefiscale,'iban'=>$iban,'sito'=>$sito,'note'=>$note);
		/*print_r($dati_dip);
		exit();*/
		$table 			= 'fornitori';
		$id_nuovo_dip = $db_con->insert($table,$dati_fornitore);
		
		return $id_nuovo_dip;
	}

	public function del_fornitore($id) {
		$deluser="DELETE FROM fornitori WHERE id = '$id'";
    	$this->res= $this->conn->query($deluser);
	  return $this->res;
	}
	public function search($cerca,$key) {
		$search="SELECT * FROM fornitore WHERE $cerca = '$key'";
		//echo $search;exit();
    	$this->res= $this->conn->query($search);
	  	return $this->res;
	}

	 
}

?>