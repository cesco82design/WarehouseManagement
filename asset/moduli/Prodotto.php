<?php
include 'dbMySQL.php';
class Prodotto extends DB_con {
	
	public $id 				= '';
	public $barcode 		= '';
	public $nome 			= '';
	public $marca  			= '';
	public $categoria 		= '';
	private $sottoscorta 	= '';

	function __construct( $id = NULL ) {
		parent::__construct();
		if ( !is_null($id) ) {
			$query = "SELECT * FROM prodotti WHERE id = '$id'";

			$res=$this->conn->query($query);
			$dati_prodotto = $res->fetch_object();

			$this->id 			= $dati_prodotto->id;
			$this->barcode 		= $dati_prodotto->barcode;
			$this->nome 		= $dati_prodotto->nome;	
			$this->marca 		= $dati_prodotto->marca;
			$this->categoria 	= $dati_prodotto->categoria;	
			$this->sottoscorta 	= $dati_prodotto->sottoscorta;	
			//$this->costo 		= $dati_prodotto->costo;
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

    public function select_categorie() {
    	$res=$this->conn->query("SELECT * FROM categorie");
			return $res;
    }

    public function insert_categorie($nome) {
    	$sql = "INSERT INTO categorie (nome) VALUES ('$nome')";
    	$res=$this->conn->query($sql);
			return $res;
    }

    public function del_categoria($id) {
    	$del_cat="DELETE FROM categorie WHERE id = '$id'";
    	$this->res= $this->conn->query($del_cat);
	  return $this->res;
    }

    public function select_brand() {
    	$res=$this->conn->query("SELECT * FROM marche");
			return $res;
    }

    public function insert_marca($nome) {
    	$sql = "INSERT INTO marche (nome) VALUES ('$nome')";
    	$res=$this->conn->query($sql);
			return $res;
    }

    public function del_marca($id) {
    	$del_cat="DELETE FROM marche WHERE id = '$id'";
    	$this->res= $this->conn->query($del_cat);
	  return $this->res;
    }

	public function aggiorna_prodotto($id,$barcode,$newnome,$marca,$categoria,$datainserimento) {
		$aggiornaprod="UPDATE prodotti SET barcode='$barcode', nome='$newnome', marca='$marca', categoria='$categoria' WHERE id = '$id'";
    	$this->res= $this->conn->query($aggiornaprod);
	  return $this->res;
	}
	public function del_prodotto($id) {
		$delprod="DELETE FROM prodotti WHERE id = '$id'";
    	$this->res= $this->conn->query($delprod);
	  return $this->res;
	}
	static public function insert_magazzino($barcode,$nome,$marca,$categoria,$sottoscorta)  {
		$db_con = new DB_con();
		$dati_prodotto = array('barcode'=>$barcode,'nome'=>$nome,'marca'=>$marca,'categoria'=>$categoria,'scorta_minima'=>$sottoscorta);
		/*print_r($dati_prodotto);*/
		$table 			= 'prodotti';
		$id_nuovo_oggetto = $db_con->insert($table,$dati_prodotto);
		/*var_dump($id_nuovo_oggetto);
		exit();*/
		if ( $id_nuovo_oggetto ) {
			$prodotto = new Prodotto($id_nuovo_oggetto);
			if ( $prodotto ) {
				return $prodotto;
			}
		}
		return $id_nuovo_oggetto;
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