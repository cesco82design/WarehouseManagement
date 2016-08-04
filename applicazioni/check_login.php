<?php 
session_start();
if(!$_SESSION['username']){
	
	header('location: applicazioni/login.php');
}
?>