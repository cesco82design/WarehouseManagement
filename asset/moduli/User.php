<?php

class User extends DB_con {
	
	public $nome 			= '';
	public $user 			= '';
	public $password  		= '';
	public $livello 		= 'guest';

	function __construct( $id = NULL ) {
		if ( !is_null($id) ) {
			/*
			 Query (che non sto a scrivere perché non è rilevante per questa guida) che preleva dal db i dati del prodotto con id uguale a quello passato al costruttore e che li salva nella variabile $dati_prodotto;
			*/
			// Nelle righe sottostanti inizializzo l'oggendo caricando nelle variabili i valori prelevati dal db
			$this->$id 			= $id;
			$this->$nome 		= $utente->nome;
			$this->$user 		= $utente->user;
			$this->$password 	= $utente->password;
			$this->$livello 	= $utente->livello;			
		}
    }
    public function modifyUser ($id,$nome,$user,$pwd,$livello){
    	$update="UPDATE utenti SET nome='$nome',user='$utente', password='$pwd', livello='$livello' WHERE idUtente = '$id'";
    	$this->check= $this->conn->query("SELECT * FROM utenti WHERE user = '$user'");
	 	$contau = $this->check->num_rows;
	 	if ($contau!=1){
	 		//faccio anche un controllo sulla password che non sia vuota
    		$this->res= $this->conn->query($update);
    	} else {
    		header('location:?messaggio=l\'utente scelto è già in uso');
    	}
    }
    public function checkPWD ($pwd) {
    	$this->res= $this->conn->query("SELECT * FROM utenti WHERE password='$pwd'");
    }

	 
}

?>