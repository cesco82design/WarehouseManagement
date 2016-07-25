<?php
include 'asset/conn/db.php';
include 'applicazioni/check_login.php';
session_start();
collega_db();

if ($_SESSION['livello']=='dipendente'){
    header('location:dipendente.php?messaggio=questa è la pagina a te dedicata');
    exit;
}
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
<link rel="stylesheet" href="../asset/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../asset/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="../asset/css/style.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="asset/js/custom_script.js"></script>
</head>
<body>
<div class="page text-center">
<div class="container">
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
<header>
    <h1>Home Page</h1>
</header>
<section>
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
  <div id="content">
    <hr /><br/>
    <label>Per qualsiasi problema contattare : <a href="http://www.cesco82design.it">Cesco82Design.it</a></label>
  </div>
</footer>
</div>

<?php 
} else {
    echo 'Non sei autorizzato';
}
scollega_db(); ?>
</body>
</html>