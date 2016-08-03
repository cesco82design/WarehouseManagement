<?php
//include 'asset/conn/db.php';
include_once 'asset/moduli/dbMySQL.php';
include_once 'applicazioni/check_login.php';
session_start();
$login = new DB_con();

if ($_SESSION['livello']=='suxuser'){

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Magazzino </title>
<link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="asset/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="asset/css/style.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="asset/js/custom_script.js"></script>
</head>
<body>
<div class="container text-center">
    <div class="row">
      <div class="col-xs-12 col-md-4 col-md-offset-8">
        <small>
          <a href="applicazioni/logout.php">Disconnetti</a>
        </small>
      </div>
    </div>
</div>
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
       <div class="col-xs-12 col-md-6">
         <a href="lista_utenti.php">Lista<br>Utenti</a>
       </div>
       <div class="col-xs-12 col-md-6">
         <a href="magazzino.php">Gestione<br>Magazzino</a>
       </div>
     </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center">
        <hr /><br/>
        <small>Per qualsiasi problema contattare : <a href="http://www.cesco82design.it">Cesco82Design.it</a></small>
      </div>
    </div>
  </div>
</footer>

</body>
</html>
<?php 
} else {
    echo 'Non sei autorizzato';
    echo '<small>
          <a href="applicazioni/logout.php">Disconnetti</a>
        </small>';
}
 ?>