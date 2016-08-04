<?php
include_once('../functions.php');
session_start();
//echo CLASMOD;
include CLASMOD.'dbMySQL.php';
$login = new DB_con();

  if(isset($_POST['invio'])){
    $user = $login->pulisci_stringa($_POST ['user']);
    $pwd =  $login->salta_pwd($_POST ['password']);
    if($user != '' && $pwd != ''){
        $result = $login->CheckLogin($user,$pwd);
        $conta = $result->num_rows;
        $Utente_login= $result->fetch_object();
      if ($conta != '1' ){
          header('location:login.php?messaggio=credenziali errate');
       
      } else{
        $_SESSION["userID"] = $Utente_login->id;
        $_SESSION["username"] = $Utente_login->username;
        $_SESSION["livello"] = $Utente_login->livello;
        $_SESSION["nome"] = $Utente_login->nome;
         header('location:../../index.php');
      
     
        
      }
    } else {
        header('location:login.php?messaggio=devi inserire delle credenziali');
      }
  } else {

include 'home.php';
 }

 ?>