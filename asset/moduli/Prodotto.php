<?php
include 'dbMySQL.php';
class Prodotto extends DB_con {
	
	public $barcode 		= '';
	public $nome 			= '';
	public $prezzo  		= 0;
	public $quantita 		= 0;
	public $costo 			= 0;
	private $sottoscorta 	= 2;

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

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM Magazzino WHERE barcode = '$id'";
			$res=$this->conn->query($query);

			$dati_prodotto = $res->fetch_object();

			$this->barcode 		= $id;
			$this->nome 		= $dati_prodotto->nome;	
			$this->prezzo 		= $dati_prodotto->prezzo;
			$this->quantita 	= $dati_prodotto->quantita;	
			$this->costo 		= $dati_prodotto->costo;
		}
    }
    public function selectProd($barcode) {
    	$res=$this->conn->query("SELECT * FROM Magazzino WHERE barcode = '$barcode'");
			return $res;
    }

	public function insert_magazzino($barcode,$nome,$prezzo,$quantita,$costo)  {
	  $this->res= $this->conn->query("INSERT INTO Magazzino (Barcode,nome,prezzo,quantita,costo) VALUES('$barcode','$nome','$prezzo','$quantita','$costo')");
	  return $this->res;
	}
	public function aggiorna_prodotto($barcode,$newnome,$newquantita,$newprezzo,$newcosto) {
		$aggiornaprod="UPDATE Magazzino SET nome='$newnome', quantita='$newquantita', prezzo='$newprezzo', costo='$newcosto' WHERE Barcode = '$barcode'";
    	$this->res= $this->conn->query($aggiornaprod);
	  return $this->res;
	}
	public function del_prodotto($barcode) {
		$delprod="DELETE FROM Magazzino WHERE Barcode = '$barcode'";
    	$this->res= $this->conn->query($delprod);
	  return $this->res;
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
	echo 'Nessuna variazione';
}
*/
?>