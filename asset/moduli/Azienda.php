<?php
include 'dbMySQL.php';
class Azienda extends DB_con {
	
	public $id 					= '';
	public $denominazione 		= '';
	public $tipo	 			= '';
	public $proprietario		= '';
	public $indirizzo	 		= '';
	public $citta		 		= '';
	public $provincia	 		= '';
	public $cap			 		= '';
	public $telefono	 		= '';
	public $telefono2	 		= '';
	public $cellulare	 		= '';
	public $mail	 			= '';
	public $partitaiva	 		= '';
	public $codicefiscale 		= '';
	public $banca		 		= '';
	public $filiale		 		= '';
	public $contocorrente 		= '';
	public $abi			 		= '';
	public $cab 		 		= '';
	public $cin			 		= '';
	public $cciaa		 		= '';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM azienda WHERE id = '$id'";

			$res=$this->conn->query($query);
			$info_azienda = $res->fetch_object();

			$this->id 				= $info_azienda->id;
			$this->denominazione 	= $info_azienda->denominazione;
			$this->tipo 			= $info_azienda->tipo;	
			$this->proprietario 	= $info_azienda->proprietario;	
			$this->indirizzo 		= $info_azienda->indirizzo;
			$this->citta 			= $info_azienda->citta;	
			$this->provincia 		= $info_azienda->provincia;
			$this->cap 				= $info_azienda->cap;
			$this->telefono 		= $info_azienda->telefono;
			$this->telefono2 		= $info_azienda->telefono2;
			$this->cellulare 		= $info_azienda->cellulare;
			$this->mail 			= $info_azienda->mail;
			$this->partitaiva 		= $info_azienda->partitaiva;
			$this->codicefiscale 	= $info_azienda->codicefiscale;
			$this->banca 			= $info_azienda->banca;
			$this->filiale 			= $info_azienda->filiale;
			$this->contocorrente 	= $info_azienda->contocorrente;
			$this->abi 				= $info_azienda->abi;
			$this->cab 				= $info_azienda->cab;
			$this->cin 				= $info_azienda->cin;
			$this->cciaa 			= $info_azienda->cciaa;
		}
    }
	
	public function aggiorna_azienda($id, $denominazione, $tipo, $proprietario, $indirizzo, $citta, $provincia, $cap, $telefono, $telefono2, $cellulare, $mail, $partitaiva, $codicefiscale, $banca, $filiale, $contocorrente, $abi, $cab, $cin, $cciaa) {
		$aggiorna_azienda="UPDATE azienda SET denominazione='$denominazione', tipo='$tipo', proprietario='$proprietario', indirizzo='$indirizzo', citta='$citta', provincia='$provincia', cap='$cap', telefono='$telefono', telefono2='$telefono2', cellulare='$cellulare', mail='$mail', partitaiva='$partitaiva', codicefiscale='$codicefiscale', banca='$banca', filiale='$filiale', contocorrente='$contocorrente', abi='$abi', cab='$cab', cin='$cin', cciaa='$cciaa' WHERE id = '$id'";
		
    	$this->res= $this->conn->query($aggiorna_azienda);
	  return $this->res;
	}
	static public function insert_azienda($id, $denominazione, $tipo, $proprietario, $indirizzo, $citta, $provincia, $cap, $telefono, $telefono2, $cellulare, $mail, $partitaiva, $codicefiscale, $banca, $filiale, $contocorrente, $abi, $cab, $cin, $cciaa)  {
		$db_con = new DB_con();
		$info_azienda = array('id'=>$id,'denominazione'=>$denominazione,'tipo'=>$tipo,'proprietario'=>$proprietario,'indirizzo'=>$indirizzo,'citta'=>$citta,'provincia'=>$provincia,'cap'=>$cap,'telefono'=>$telefono,'telefono2'=>$telefono2,'cellulare'=>$cellulare,'mail'=>$mail,'partitaiva'=>$partitaiva,'codicefiscale'=>$codicefiscale,'banca'=>$banca,'filiale'=>$filiale,'contocorrente'=>$contocorrente,'abi'=>$abi,'cab'=>$cab,'cin'=>$cin,'cciaa'=>$cciaa);
		/*print_r($info_azienda);
		exit();*/
		$table 			= 'azienda';
		$id_nuovo_oggetto = $db_con->insert($table,$info_azienda);
		/*var_dump($id_nuovo_oggetto);
		exit();*/
		return $id_nuovo_oggetto;
	}
}

?>