<?php

define( 'DB_SERVER','');
define( 'DB_USER','');
define( 'DB_PASS','');
define( 'DB_NAME','');

	function collega_db() {
		$conn = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		if($conn->connect_errno){die('errore: Impossibile connettersi al database. '.$conn->connect_error);}
	}
	function scollega_db() {
		global $conn;
		$conn->close();
	}
?>