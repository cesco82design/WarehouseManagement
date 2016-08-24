<?php
include_once('functions.php');
include_once 'asset/moduli/dbMySQL.php';
include_once 'applicazioni/check_login.php';
session_start();
$login = new DB_con();

if ($_SESSION['livello']=='suxuser'){
include_once(LAYOUT.'pretitle.php'); ?>

<title>Magazzino </title>

<?php include_once(LAYOUT.'header.php'); ?>

<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Home Page</h1>
      </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
        <?php
            if(isset($_GET['messaggio'])){ ?>
            <div class="messaggio">
            <?php
              echo $_GET['messaggio'];
              ?>
              </div>
              <?php
            }
          ?>
        </div>
    </div>
  </div>
</header>
<section class="text-center">
 <div class="container">
     <div class="row">
       <div class="col-xs-12 col-md-6 text-center">
         <a href="lista_utenti.php" class="btn-home">Utenti</a>
       </div>
       <div class="col-xs-12 col-md-6 text-center">
         <a href="magazzino.php" class="btn-home">Magazzino</a>
       </div>
       <div class="col-xs-12 col-md-6 text-center">
         <a href="clienti.php" class="btn-home">Clienti</a>
       </div>
       <div class="col-xs-12 col-md-6 text-center">
         <a href="fornitori.php" class="btn-home">Fornitori</a>
       </div>
     </div>
  </div>
</section>

<?php 
include_once(LAYOUT.'footer.php');
} else {
    echo 'Non sei autorizzato';
    echo '<small>
          <a href="applicazioni/logout.php">Disconnetti</a>
        </small>';
}
 ?>