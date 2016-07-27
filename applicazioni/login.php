<?php
session_start();
include '../asset/moduli/dbMySQL.php';
$salt= '1234';
$login = new CheckLogin();
$login->collega_db();
  if(isset($_POST['invio'])){
    $utente = mysqli_real_escape_string($conn,trim($_POST['user']));
    $pwd =  sha1(mysqli_real_escape_string($conn,trim($_POST['password'])).$salt);
    if($utente != '' && $pwd != ''){
        $sql = "SELECT * FROM utenti WHERE user = '$utente' AND password = '$pwd';";
        $result = $conn->query($sql) or die($conn->error);
        $conta = $result->num_rows;
        $row= $result->fetch_object();
        $login->scollega_db();

      if($conta == '1' ){
        $_SESSION["user"] = $row->user;
        $_SESSION["livello"] = $row->livello;
        $_SESSION["nome"] = $row->nome;

        if ($_SESSION['user']=='dipendente') {
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