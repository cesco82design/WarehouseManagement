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
<script src="asset/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://disputebills.com"><img src="http://res.cloudinary.com/candidbusiness/image/upload/v1455406304/dispute-bills-chicago.png" alt="Dispute Bills">
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Azienda <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Dati Azienda</a></li>
              <li><a href="#">Utenti</a></li>
              <li><a href="#">Dipendenti</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clienti <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Anagrafica</a></li>
              <li><a href="#">Scheda Clienti</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Magazzino <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Gestione Prodotti</a></li>
              <li><a href="#">Movimenti Magazzino</a></li>
              <li><a href="#">Inventario Magazzino</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Fornitori <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Anagrafica Fornitori</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Profile</a></li>
              <li><a href="#">link</a></li>
              <li class="divider"></li>
              <li class="dropdown-header"><i class="fa fa-sign-out"></i> LogOut</li>
              <li><a href="applicazioni/logout.php">Disconnetti</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
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