<?php

class User extends DB_con {
	
	public $nome 			= '';
	public $user 			= '';
	public $password  		= '';
	public $livello 		= 'guest';

	function __construct( $id = NULL ) {
		if ( !is_null($id) ) {
			$this->check= $this->conn->query("SELECT * FROM utenti WHERE idUtente = '$id'");
			$utente = $this->check->fetch_object();/*
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
    public function modifyUser($id,$newnome,$newuser,$newpwd,$newlivello){
    	$update="UPDATE utenti SET nome='$newnome',user='$newuser', password='$newpwd', livello='$newlivello' WHERE idUtente = '$id'";
    	$updateNoPwd="UPDATE utenti SET nome='$newnome',user='$newuser', livello='$newlivello' WHERE idUtente = '$id'";
    	$this->check= checkUserExist($newuser);
	 	$contau = $this->check->num_rows;
	 	if ($contau!=1){
	 		if ($this->checkpass= checkPWD($newpwd)) {
	 			$this->res= $this->conn->query($update);
	 		} else {
	    		$this->res= $this->conn->query($updateNoPwd);
	    	}
    	} else {
    		header('location:?messaggio=l\'utente scelto è già in uso');
    	}
    }
    public function checkPWD($pwd) {
    	if (!is_null($pwd)) {
    		return true;
    	} else {
    		return false;
    	}
    }

	 
}

?>