<?php 
include '../functions.php';
$logurl = 'http://'.$_SERVER['SERVER_NAME'].'/applicazioni/login.php';
session_start();
if(!$_SESSION['username']){
	//echo  LOGIN ;	
	header('location:'.$logurl);
}
?>