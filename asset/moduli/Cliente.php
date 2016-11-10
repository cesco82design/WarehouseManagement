<?php
include_once('dbMySQL.php');  

class Cliente extends DB_con {
	
	public $id 					= '';
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
	public $card 			= '';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM clienti WHERE id = '$id'";

			$res=$this->conn->query($query);
			$dipendente = $res->fetch_object();

			$this->id 				= $dipendente->id;
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
			$this->card 			= $dipendente->card;
				
		}
    }
    
    static function aggiorna_cliente($id,$nome,$cognome,$indirizzo,$citta,$provincia,$cap,$data_nascita,$telefono,$cellulare,$mail,$partitaiva,$codicefiscale,$card){
		$db_con = new DB_con();
		$table = 'clienti';
    		$fields = array('nome'=>$nome,'cognome'=>$cognome,'indirizzo'=>$indirizzo,'citta'=>$citta,'provincia'=>$provincia,'cap'=>$cap,'data_nascita'=>$data_nascita,'telefono'=>$telefono,'cellulare'=>$cellulare,'mail'=>$mail,'partitaiva'=>$partitaiva,'codicefiscale'=>$codicefiscale,'card'=>$card);
    		$res = $db_con->update($table, $id, $fields);
    	
    	return $res;
    }
    

	static public function insert_cliente($nome,$cognome,$indirizzo,$citta,$provincia,$cap,$data_nascita,$telefono,$cellulare,$mail,$partitaiva,$codicefiscale,$card)  {
		$db_con = new DB_con();
		//echo $password;
		//echo $nome.' - '.$cognome.' - '.$indirizzo.' - '.$citta.' - '.$provincia.' - '.$cap.' - '.$data_nascita.' - '.$telefono.' - '.$cellulare.' - '.$mail.' - '.$partitaiva.' - '.$codicefiscale.' - '.$operatrice.' - '.$registrare;
		//exit();
		$dati_cliente = array('id'=>NULL,'nome'=>$nome,'cognome'=>$cognome,'indirizzo'=>$indirizzo,'citta'=>$citta,'provincia'=>$provincia,'cap'=>$cap,'data_nascita'=>$data_nascita,'telefono'=>$telefono,'cellulare'=>$cellulare,'mail'=>$mail,'partitaiva'=>$partitaiva,'codicefiscale'=>$codicefiscale,'card'=>$card);
		/*print_r($dati_dip);
		exit();*/
		$table 			= 'clienti';
		$id_nuovo_dip = $db_con->insert($table,$dati_cliente);
		
		return $id_nuovo_dip;
	}

	public function del_cliente($id) {
		$deluser="DELETE FROM clienti WHERE id = '$id'";
    	$this->res= $this->conn->query($deluser);
	  return $this->res;
	}

	public function search($cerca,$key) {
		$search="SELECT * FROM clienti WHERE $cerca = '$key'";
		//echo $search;exit();
    	$this->res= $this->conn->query($search);
	  	return $this->res;
	}

	 
}

?>