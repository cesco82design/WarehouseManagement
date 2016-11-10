<?php
include_once('dbMySQL.php');  

class Tessera extends DB_con {
	
	public $id 						= '';
	public $id_cliente 				= '';
	public $data_attivazione 		= '';
	public $data_disattivazione 	= '';
	public $attiva		 			= '';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM card WHERE id = '$id'";

			$res=$this->conn->query($query);
			$tessera = $res->fetch_object();

			$this->id 					= $tessera->id;
			$this->id_cliente 			= $tessera->id_cliente;
			$this->data_attivazione 	= $tessera->data_attivazione;
			$this->data_disattivazione 	= $tessera->data_disattivazione;	
			$this->attiva 				= $tessera->attiva;
				
		}
    }
    
    static function aggiorna_tessera($id,$id_cliente,$data_attivazione,$data_disattivazione,$attiva){
		$db_con = new DB_con();
		$table = 'card';
    		$fields = array('id_cliente'=>$id_cliente,'data_attivazione'=>$data_attivazione,'data_disattivazione'=>$data_disattivazione,'attiva'=>$attiva);
    		$res = $db_con->update($table, $id, $fields);
    	
    	return $res;
    }
    
    public function aggiorna_associazione($id,$id_cliente) {
    	$sql = "UPDATE clienti SET 'card'=$id WHERE id = '$id_cliente'";
    	//echo $sql; exit();
    	$this->res= $this->conn->query($sql);
	  	return $this->res;
    }
    public function aggiorna_card_cliente($id) {
    	$db_con = new DB_con();
    		$id_utente=$db_con->last_client_id();
			$new_utente_id = $id_utente->fetch_object();
			$id_cliente = $new_utente_id->maxid;
    	$sql = "UPDATE card SET `id_cliente`=$id_cliente WHERE `id` = '$id'";
    	//echo $sql;// exit();
    	$this->res= $this->conn->query($sql);
	  	return $this->res;
    }
    public function mod_card_cliente($id_cliente,$id) {
        	$sql = "UPDATE card SET `id_cliente`=$id_cliente WHERE `id` = '$id'";
    	//echo $sql;// exit();
    	$this->res= $this->conn->query($sql);
	  	return $this->res;
    }

	static public function insert_tessera($id,$id_cliente,$data_attivazione,$attiva)  {
		$db_con = new DB_con();
		//echo $password;
		//echo $nome.' - '.$cognome.' - '.$indirizzo.' - '.$citta.' - '.$provincia.' - '.$cap.' - '.$data_nascita.' - '.$telefono.' - '.$cellulare.' - '.$mail.' - '.$partitaiva.' - '.$codicefiscale.' - '.$operatrice.' - '.$registrare;
		//exit();
		$dati_tessera = array('id'=>$id,'id_cliente'=>$id_cliente,'data_attivazione'=>$data_attivazione,'attiva'=>$attiva);
		/*print_r($dati_dip);
		exit();*/
		$table 			= 'card';
		$id_nuovo_dip = $db_con->insert($table,$dati_tessera);
		
		return $id_nuovo_dip;
	}

	public function del_tessera($id) {
		$deluser="DELETE FROM card WHERE id = '$id'";
    	$this->res= $this->conn->query($deluser);
	  return $this->res;
	}

	public function check_tessera($id) {
		$check_tessera = "SELECT * FROM card WHERE id = '$id' AND id_cliente = ''";
	}

	public function select_clienti() {
		$all_clienti="SELECT * FROM clienti WHERE card=''";
    	$this->res= $this->conn->query($all_clienti);
	  	return $this->res;
	}

	public function select_free() {
		$all_clienti="SELECT * FROM card WHERE id_cliente='' AND attiva='si'";
    	$this->res= $this->conn->query($all_clienti);
	  	return $this->res;
	}
	
}

?>