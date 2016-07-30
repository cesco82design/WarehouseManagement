<?php
//include 'asset/moduli/dbMySQL.php';
include 'asset/moduli/Prodotto.php';
include 'applicazioni/check_login.php';
session_start();

$magazzino = new DB_con();
$table = "Magazzino";

// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['idMagazzinoCancella'])){
  $delprodotto = new Prodotto();
  
   $res=$delprodotto->del_prodotto($_GET['idMagazzinoCancella']);
   if ($res) {
      header('location:?messaggio=cancellazione avvenuta correttamente');
   } else {
      header('location:?messaggio=si è verificato un errore durante la cancellazione');
   }
}
if ($_SESSION['livello']=='dipendente'){
    header('location:dipendente.php?messaggio=questa è la pagina a te dedicata');
    exit;
}
if ($_SESSION['livello']=='suxuser'){/*
$res = $magazzino->select($table)
var_dump($res);*/
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
<div class="page">
<div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-4 col-md-offset-8">
        <small>
          <a href="applicazioni/logout.php">Disconnetti</a>
        </small>
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
<header id="header">
  <div id="content" class="text-center">
    <h1>Visuale completa del Magazzino</h1>
  </div>
</header>
<section id="body">
   <div class="container">
       <div class="table-responsive">
        <table class="table table-hover">
          <tr>
          <th colspan="8" class="text-center"><a href="index.php">Home</a> | <a href="applicazioni/magazzino/add_mag.php">Aggiungi Prodotti in magazzino</a></th>
          </tr>
          <tr>
          <th>Barcode</th>
          <th>Nome Prodotto</th>
          <th>Prezzo</th>
          <th>Quantit&agrave;</th>
          <th>Tot. articolo</th>
          <th>Costo unitario</th>
          <th></th>
          <th></th>
          </tr>
          <?php
            if ($res = $magazzino->select($table)){
              while ($dati_prodotto = $res->fetch_object()) {
                $totprezzo = ($dati_prodotto->quantita)*($dati_prodotto->prezzo);
                $sommaprezzo[] = $totprezzo;
                   ?>
                    <tr>
                    <td><?php echo $dati_prodotto->Barcode; ?></td>
                    <td><?php echo $dati_prodotto->nome; ?></td>
                    <td>&euro; <?php echo $dati_prodotto->prezzo; ?></td>
                    <td><?php echo $dati_prodotto->quantita; ?></td>
                    <td>&euro; <?php echo number_format((float)$totprezzo, 2, '.', ''); ?></td>
                    <td>&euro; <?php echo $dati_prodotto->costo; ?></td>
                    <td><a href="applicazioni/magazzino/mod_mag.php?barcode=<?php echo $dati_prodotto->Barcode;?>"><i class="fa fa-edit"></i></a></td>
                    <td><a href="?idMagazzinoCancella=<?php echo $dati_prodotto->Barcode;?>" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
                    </tr>
                    <?php
                 
              }
              echo '<tr><td colspan="4"></td>
            <td><strong>&euro; ';
            $totsomma= array_sum($sommaprezzo);
            echo number_format((float)$totsomma, 2, '.', '');
            echo '</strong></td>
            <td colspan="3"></td>
            </tr>';
            }
            
           
           ?>
          </table>
      </div>
  </div>
</section>
<footer id="footer">
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
 ?>
</body>
</html>