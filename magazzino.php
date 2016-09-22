<?php
include_once('functions.php');
include CLASMOD.'Prodotto.php';
include CLASMOD.'Movimento.php';
include APPL.'check_login.php';
session_start();

$magazzino = new DB_con();
$table = "prodotti";

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
if ($_SESSION['livello']=='suxuser'){

include_once(LAYOUT.'pretitle.php');  
?>

<title>Magazzino </title>

<?php include_once(LAYOUT.'header.php'); ?>

<header>
  <div class="continer">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">Visuale completa del Magazzino</h1>
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
<section id="body">
   <div class="container">
       <div class="table-responsive">
        <table class="table table-hover">
          <tr>
          <th></th>
          </tr>
          <tr>
          <th>Barcode</th>
          <th>Nome Prodotto</th>
          <th>Marca</th>
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
                /*$totprezzo = ($dati_prodotto->quantita)*($dati_prodotto->prezzo);
                $sommaprezzo[] = $totprezzo;*/
                   ?>
                    <tr>
                    <td><?php echo $dati_prodotto->barcode; ?></td>
                    <td><?php echo $dati_prodotto->nome; ?></td>
                    <td><?php echo $dati_prodotto->marca; ?></td>
                    <td><?php  ?></td>
                    <td><?php  ?></td>
                    <?php /* <td>&euro; <?php echo $dati_prodotto->prezzo; ?></td>
                    <td><?php echo $dati_prodotto->quantita; ?></td>
                    <td>&euro; <?php echo number_format((float)$totprezzo, 2, '.', ''); ?></td>
                    <td>&euro; <?php echo $dati_prodotto->costo; ?></td>*/ ?>
                    <td><a href="<?php echo MAGAZZINO;?>mod_mag.php?barcode=<?php echo $dati_prodotto->Barcode;?>"><i class="fa fa-edit"></i></a></td>
                    <td><a href="?idMagazzinoCancella=<?php echo $dati_prodotto->Barcode;?>" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
                    </tr>
                    <?php
                 
              }
              echo '<tr><td colspan="4"></td>
            <td><strong>&euro; ';
            //$totsomma= array_sum($sommaprezzo);
            //echo number_format((float)$totsomma, 2, '.', '');
            echo '</strong></td>
            <td colspan="3"></td>
            </tr>';
            }
            
           
           ?>
          </table>
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