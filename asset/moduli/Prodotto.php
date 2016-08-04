<?php
include 'dbMySQL.php';
class Prodotto extends DB_con {
	
	public $id 		= '';
	public $barcode 		= '';
	public $nome 			= '';
	public $prezzo  		= 0;
	public $quantita 		= 0;
	public $costo 			= 0;
	private $sottoscorta 	= 2;

	
	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM prodotti WHERE id = '$id'";
			$res=$this->conn->query($query);

			$dati_prodotto = $res->fetch_object();

			$this->id 		= $id;
			$this->barcode 		= $dati_prodotto->barcode;
			$this->nome 		= $dati_prodotto->nome;	
			$this->prezzo 		= $dati_prodotto->prezzo;
			$this->quantita 	= $dati_prodotto->quantita;	
			$this->costo 		= $dati_prodotto->costo;
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

	public function decrementa( $quantita ){
		$this->quantita -= $quantita;
		if ( $this->quantita < $this->sottoscorta  ) {
			$this->metti_in_ordine();
		}
	}

	public function metti_in_ordine() {
		/* 
		*/
	}

    public function selectProd($id) {
    	$res=$this->conn->query("SELECT * FROM prodotti WHERE id = '$id'");
			return $res;
    }

	public function aggiorna_prodotto($id,$barcode,$newnome,$marca,$categoria,$datainserimento) {
		$aggiornaprod="UPDATE prodotti SET barcode='$barcode', nome='$newnome', marca='$marca', categoria='$categoria', datainserimento='$datainserimento' WHERE id = '$id'";
    	$this->res= $this->conn->query($aggiornaprod);
	  return $this->res;
	}
	public function del_prodotto($id) {
		$delprod="DELETE FROM prodotti WHERE id = '$id'";
    	$this->res= $this->conn->query($delprod);
	  return $this->res;
	}
	static public function insert_magazzino($id,$barcode,$nome,$marca,$categoria,$datainserimento)  {
		$db_con = new DB_con();
		$dati_prodotto = array('id'=>NULL,'barcode'=>$barcode,'nome'=>$nome,'marca'=>$marca,'categoria'=>$categoria,'datainserimento'=>$datainserimento);
		$table 			= 'prodotti';
		$id_nuovo_oggetto = $db_con->insert($table,$dati_prodotto);
		
		if ( $id_nuovo_oggetto ) {
			$prodotto = new Prodotto($id_nuovo_oggetto);
			if ( $prodotto ) {
				return $prodotto;
			}
		}
		return true;
	}
}

/*******
PER CREARE UN OGGETTO NUOVO VUOTO
******* /
$nuovo_oggetto = new Prodotto();
// L'id non viene passato quindi la funzione dentro il costruttore non viene eseguita perché l'id passato alla funzione è NULL e il primo if blocca l'esecuzione di altre istruzioni

/*******
PER CREARE UN OGGETTO NUOVO CON DATI
******* /
$nuovo_oggetto = new Prodotto(14);


if ( $prodotto->cambia_prezzo(5) ) {
	echo 'Prezzo cambiato';
} else {
} else {
} else {
	echo 'Nessuna variazione';
}
*/
?>