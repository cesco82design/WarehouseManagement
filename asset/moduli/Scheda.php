<?php
include_once('dbMySQL.php');  

class Scheda extends DB_con {
	
	public $id 				= '';
	public $id_cliente		= '';
	public $card		  	= '';
	public $trattamento  	= '';
	public $barcode		= '';
	public $prezzo_tratt		= '';
	public $data			= '';
	public $pagato			= '';
	public $operatrice		= '';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM schede_clienti WHERE id = '$id'";

			$res=$this->conn->query($query);
			$scheda = $res->fetch_object();

			$this->id 				= $scheda->id;
			$this->id_cliente		= $scheda->id_cliente;
			$this->card 			= $scheda->card;
			$this->trattamento 		= $scheda->trattamento;	
			$this->barcode 			= $scheda->barcode;	
			$this->prezzo_tratt 	= $scheda->prezzo_tratt;	
			$this->data 			= $scheda->data;	
			$this->pagato 			= $scheda->pagato;	
			$this->operatrice 		= $scheda->operatrice;	
			$this->note 		= $scheda->note;	
				
		}
    }
    

    static public function insert_scheda($id_cliente,$card,$trattamento,$barcode,$prezzo_tratt,$data,$pagato,$operatrice,$note) {
    	$db_con = new DB_con();
		$dati_scheda = array('id_cliente'=>$id_cliente,'card'=>$card,'trattamento'=>$trattamento,'barcode'=>$barcode,'prezzo_tratt'=>$prezzo_tratt,'data'=>$data,'pagato'=>$pagato,'operatrice'=>$operatrice,'note'=>$note);
		/*print_r($dati_prodotto);*/
		$table 			= 'schede_clienti';
		$res = $db_con->insert($table,$dati_scheda);
		return $res;
    }

	public function del_scheda($id) {
		$del_scheda="DELETE FROM schede_clienti WHERE id = '$id'";
    	$this->res= $this->conn->query($del_scheda);
	  return $this->res;
	}

	static public function aggiorna_scheda($id,$id_cliente,$card,$trattamento,$barcode,$prezzo_tratt,$data,$pagato,$operatrice,$note) {
	  $db_con = new DB_con();
	  $table = 'schede_clienti';
	  $fields = array('id_cliente'=>$id_cliente,'card'=>$card,'trattamento'=>$trattamento,'barcode'=>$barcode,'prezzo_tratt'=>$prezzo_tratt,'data'=>$data,'pagato'=>$pagato,'operatrice'=>$operatrice,'note'=>$note);
    	$res = $db_con->update($table, $id, $fields);
    	return $res;
	}

	public function scheda_saldata($id) {
		$sql = "UPDATE schede_clienti SET pagato='si' WHERE id='$id'";
		//echo $sql;
		$this->res= $this->conn->query($sql);
	  return $this->res;
	}

	public function tratt_by_client($id_cliente) {
		$sql = "SELECT * FROM  schede_clienti WHERE id_cliente = '$id_cliente'";
		$this->res= $this->conn->query($sql);
	  return $this->res;
	}
	 
}

?>