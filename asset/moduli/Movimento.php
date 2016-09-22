<?php
include_once('dbMySQL.php');  
class Movimento extends DB_con {
	
	public $id 				= '';
	public $barcode 		= '';
	public $quantita 			= '';
	public $prezzo 			= '';
	public $causale 			= '';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM movimenti WHERE id = '$id'";

			$res=$this->conn->query($query);
			$movimento = $res->fetch_object();

			$this->id 			= $movimento->id;
			$this->barcode 		= $movimento->barcode;
			$this->quantita 	= $movimento->quantita;	
			$this->prezzo 		= $movimento->prezzo;	
			$this->causale 		= $movimento->causale;	
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


	public function aggiorna_movimento( $id,$barcode,$prezzo,$quantita,$causale,$note ) {
		$aggiorna_mov="UPDATE movimenti SET barcode='$barcode', prezzo='$prezzo', quantita='$quantita', causale='$causale',note=>'$note' WHERE id = '$id'";
    	$this->res= $this->conn->query($aggiorna_mov);
	  return $this->res;
	}
	public function del_movimento( $id ) {
		$del_mov="DELETE FROM movimenti WHERE id = '$id'";
    	$this->res= $this->conn->query($del_mov);
	  return $this->res;
	}
	static public function insert_movimento( $barcode,$prezzo,$quantita,$causale,$note )  {
		$db_con = new DB_con();
		$dati_movimento = array('barcode'=>$barcode,'prezzo'=>$prezzo,'quantita'=>$quantita,'causale'=>$causale,'note'=>$note);
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
    	$this->res= $this->conn->query($sql);
		
		$totEntrate = utf8_encode($row['entrate']);
						  $totUscite = utf8_encode($row['uscite']);
	      $totEnt[] = $totEntrate;
	      $totUsc[] = $totUscite;
	  }
	  $saldoEnt= array_sum($totEnt); 
	  $saldoUsc= array_sum($totUsc);
	  $saldoGen = ($saldoEnt-$saldoUsc);
	}
}

?>