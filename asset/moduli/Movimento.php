<?php
include_once('dbMySQL.php');  
class Movimento extends DB_con {
	
	public $id 				= '';
	public $barcode 		= '';
	public $quantitae	 	= '';
	public $prezzo 			= '';
	public $quantitau 		= '';
	public $note 			= '';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM movimenti WHERE id = '$id'";

			$res=$this->conn->query($query);
			$movimento = $res->fetch_object();

			$this->id 			= $movimento->id;
			$this->barcode 		= $movimento->barcode;
			$this->quantitae 	= $movimento->quantitae;	
			$this->quantitau 	= $movimento->quantitau;	
			$this->prezzo 		= $movimento->prezzo;	
			$this->note 		= $movimento->note;	
		}
    }
    public function cambia_prezzo( $nuovo_prezzo ) {
		$pattern = '/^\d+(?:\.\d{2})?$/';
		if (preg_match($pattern, $nuovo_prezzo) == '0') {
		   return false;
		} else {
			if ( $nuovo_prezzo > 0 ) {
				$this->prezzo = $nuovo_prezzo;
				return true;
			}
			return false;
		}
	}


	static public function aggiorna_movimento( $id,$barcode,$prezzo,$quantitae,$quantitau,$note ) {
		/*$aggiorna_mov="UPDATE movimenti SET barcode='$barcode', prezzo='$prezzo', quantitae='$quantitae', quantitau='$quantitau',note='$note' WHERE id = '$id'";
		//echo $aggiorna_mov; //exit();
    	$this->res= $this->conn->query($aggiorna_mov);
	  return $this->res;*/
	  $db_con = new DB_con();
	  $table = 'movimenti';
	  $fields = array('barcode'=>$barcode,'prezzo'=>$prezzo,'quantitae'=>$quantitae,'quantitau'=>$quantitau,'note'=>$note);
    	$res = $db_con->update($table, $id, $fields);
    	return $res;
	}
	public function del_movimento( $id ) {
		$del_mov="DELETE FROM movimenti WHERE id = '$id'";
    	$this->res= $this->conn->query($del_mov);
	  return $this->res;
	}
	static public function insert_movimento( $barcode,$prezzo,$quantitae,$quantitau,$note )  {
		$db_con = new DB_con();
		$dati_movimento = array('barcode'=>$barcode,'prezzo'=>$prezzo,'quantitae'=>$quantitae,'quantitau'=>$quantitau,'note'=>$note);
		/*print_r($dati_prodotto);*/
		$table 			= 'movimenti';
		$id_nuovo_movimento = $db_con->insert( $table,$dati_movimento );
		/*var_dump($id_nuovo_oggetto);
		exit();*/
		/*if ( $id_nuovo_oggetto ) {
			$prodotto = new Prodotto($id_nuovo_oggetto);
			if ( $prodotto ) {
				return $prodotto;
			}
		}*/
		return $id_nuovo_movimento;
	}
	public function quantita_prodotto( $barcode ) {
		$sql = "SELECT * FROM movimenti WHERE barcode = '$barcode'";
    	$res = $this->conn->query($sql);
    	while($quantita = $res->fetch_object()) {
	    	//print_r($res);
	    	//exit();
			$totEntrate = $quantita->quantitae;
			$totUscite = $quantita->quantitau;
			$totEnt[] = $totEntrate;
			$totUsc[] = $totUscite;
		}
		$saldoEnt= array_sum($totEnt); 
		$saldoUsc= array_sum($totUsc);
		$saldoGen = ($saldoEnt-$saldoUsc);
		return $saldoGen;
	}
	public function prezzo_medio_prodotto( $barcode ) {
		$sql = "SELECT * FROM movimenti WHERE quantitau = '0' AND barcode = '$barcode'";
		$result = $this->conn->query($sql);
		$row_cnt = $result->num_rows;
		//print_r($row_cnt);
		//exit();
		while($prezzo = $result->fetch_object()) {
			$totPrezzo = $prezzo->prezzo;
			$totale_prezzo[] = $totPrezzo;
		}
		$prezzo_totale = array_sum( $totale_prezzo );
		$prezzo_medio = ( $prezzo_totale / $row_cnt );
		return $prezzo_medio;
	}
}

?>