<?php
include_once('dbMySQL.php');  

class Trattamento extends DB_con {
	
	public $id 					= '';
	public $nome				= '';
	public $descrizione  		= '';
	public $durata_trattamento	= '';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM trattamenti WHERE id = '$id'";

			$res=$this->conn->query($query);
			$trattamento = $res->fetch_object();

			$this->id 					= $trattamento->id;
			$this->nome 				= $trattamento->nome;
			$this->descrizione 			= $trattamento->descrizione;
			$this->durata_trattamento 	= $trattamento->durata_trattamento;	
				
		}
    }
    

    static public function insert_trattamento($nome,$descrizione,$durata) {
    	$db_con = new DB_con();
		$dati_trattamento = array('nome'=>$nome,'descrizione'=>$descrizione,'durata_trattamento'=>$durata);
		/*print_r($dati_prodotto);*/
		$table 			= 'trattamenti';
		$res = $db_con->insert($table,$dati_trattamento);
		return $res;
    }

	public function del_trattamento($id) {
		$deluser="DELETE FROM trattamenti WHERE id = '$id'";
    	$this->res= $this->conn->query($deluser);
	  return $this->res;
	}

	static public function aggiorna_trattamento($id,$nome,$descrizione,$durata) {
	  $db_con = new DB_con();
	  $table = 'trattamenti';
	  $fields = array('nome'=>$nome,'descrizione'=>$descrizione,'durata_trattamento'=>$durata);
    	$res = $db_con->update($table, $id, $fields);
    	return $res;
	}


	 
}

?>