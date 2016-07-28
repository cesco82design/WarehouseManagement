<?php

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
		if ( !is_null($id) ) {

			$res=$this->conn->query("SELECT * FROM Magazzino WHERE barcode = '$id'");
         	$dati_prodotto = $res->fetch_object()
			// Nelle righe sottostanti inizializzo l'oggendo caricando nelle variabili i valori prelevati dal db
			$this->$id 			= $id;
			$this->$barcode 	= $dati_prodotto->barcode;
			$this->$prezzo 		= $dati_prodotto->prezzo;
			$this->$colore 		= $dati_prodotto->colore;
			$this->$nome 		= $dati_prodotto->nome;
			$this->$quantita 	= $dati_prodotto->quantita;			
		}
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