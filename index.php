<?php
include_once('functions.php');
include_once 'asset/moduli/dbMySQL.php';
include_once 'applicazioni/check_login.php';
session_start();
$login = new DB_con();


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
            <div class="messaggio <?php if (isset($_GET['alert'])) { echo 'alert alert-danger';} else { echo 'alert alert-success';} ?>">
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
<?php if ($_SESSION['livello']=='suxuser'){ ?>
<section class="text-center">
 <div class="container">
     <div class="row">
       <div class="col-xs-12 col-sm-3 text-center">
         <div class="box_home bordered">
          <a href="clienti.php" class="btn-home">
          <div class="square clienti">
           <img src="asset/img/clienti.png" width="200">
           </div><span>Clienti</span></a>
        </div>
       </div>
       <div class="col-xs-12 col-sm-3 text-center">
         <div class="box_home bordered">
          <a href="schede_clienti.php" class="btn-home">
          <div class="square schede">
           <img src="asset/img/schede.png">
           </div><span>Schede Clienti</span></a>
        </div>
       </div>
       <div class="col-xs-12 col-sm-3 text-center">
         <div class="box_home bordered">
          <a href="magazzino.php" class="btn-home">
          <div class="square magazzino">
           <img src="asset/img/magazzino.png">
           </div><span>Magazzino</span></a>
        </div>
       </div>
       <div class="col-xs-12 col-sm-3 text-center">
         <div class="box_home bordered">
         <a href="fornitori.php" class="btn-home">
         <div class="square fornitori">
           <img src="asset/img/fornitori.png">
           </div><span>Fornitori</span></a>
        </div>
       </div>
       <div class="col-xs-12 col-sm-3 text-center">
         <div class="box_home bordered">
           <a href="dipendenti.php" class="btn-home">
           <div class="square utenti">
             <img src="asset/img/utenti.png">
           </div><span>Dipendenti</span></a>
         </div>
       </div>
       <div class="col-xs-12 col-sm-3 text-center">
         <div class="box_home bordered">
           <a href="lista_utenti.php" class="btn-home">
           <div class="square utenti">
             <img src="asset/img/utenti.png">
           </div><span>Utenti</span></a>
         </div>
       </div>
     </div>
  </div>
</section>

<?php 

} else {
    echo '<section class="container text-center">
            <div class="row">
              <div class="col-xs-12">
    Non sei autorizzato<br>';
    echo '<small>
          <a href="applicazioni/logout.php">Disconnetti</a>
        </small>
        </div>
        </div>
        </section>';
}
include_once(LAYOUT.'footer.php');
 ?>