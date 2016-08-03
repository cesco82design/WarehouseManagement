<?php
session_start();
include '../asset/moduli/dbMySQL.php';
$login = new DB_con();

  if(isset($_POST['invio'])){
    $user = $login->pulisci_stringa($_POST ['user']);
    $pwd =  $login->salta_pwd($_POST ['password']);
    if($user != '' && $pwd != ''){
        $result = $login->CheckLogin($user,$pwd);
        $conta = $result->num_rows;
        $Utente_login= $result->fetch_object();

      if($conta == '1' ){
        $_SESSION["userID"] = $Utente_login->idUtente;
        $_SESSION["user"] = $Utente_login->user;
        $_SESSION["livello"] = $Utente_login->livello;
        $_SESSION["nomeutente"] = $Utente_login->nomeutente;

        if ($_SESSION['livello']=='dipendente') {
          header('location:../dipendente.php');
        } else {
          header('location:../index.php');
        }
      } else{
        header('location:login.php?messaggio=credenziali errate');
      }
    } else {
        header('location:login.php?messaggio=devi inserire delle credenziali');
      }
  } else {

include 'home.php';
 }

 ?>