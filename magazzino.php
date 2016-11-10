<?php
include_once('functions.php');
include CLASMOD.'Prodotto.php';
include CLASMOD.'Movimento.php';
include 'applicazioni/check_login.php';
session_start();

$magazzino = new DB_con();
$table = "prodotti";

// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['id_Magazzino_Cancella'])){
  $delprodotto = new Prodotto();
  
   $res=$delprodotto->del_prodotto($_GET['id_Magazzino_Cancella']);
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
          <th>Categoria</th>
          <th>Prezzo Medio</th>
          <th>Q.t&agrave;</th>
          <th>Valore</th>
          <th>Scorta minima</th>
          <th>Modifica</th>
          <th>Elimina</th>
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
                    <td><a href="details.php?details=prodotto&id=<?php echo $dati_prodotto->id; ?>"><?php echo $dati_prodotto->barcode; ?></a></td>
                    <td><a href="details.php?details=prodotto&id=<?php echo $dati_prodotto->id; ?>"><?php echo $dati_prodotto->nome; ?></td>
                    <td><?php echo $dati_prodotto->marca; ?></td>
                    <td><?php echo $dati_prodotto->categoria; ?></td>
                    <td><?php $barcode = $dati_prodotto->barcode;
                    $prezzo_quantita = new Movimento();
                    $prezzo_medio = $prezzo_quantita->prezzo_medio_prodotto( $barcode );
                    echo '&euro; '.number_format((float)$prezzo_medio, 2, '.', '');  ?></td>
                    <td><?php 
                    $quantita_prodotto = $prezzo_quantita->quantita_prodotto( $barcode );
                    if ($quantita_prodotto<=$dati_prodotto->scortaminima) {
                      echo '<span class="red">'.$quantita_prodotto.'</span>';
                    } else {
                      echo $quantita_prodotto; 
                    }?></td>
                    <td>&euro; <?php $valore_magazzino = ($prezzo_medio*$quantita_prodotto); echo number_format((float)$valore_magazzino, 2, '.', '');?></td>
                    <td><?php echo $dati_prodotto->scorta_minima; ?></td>
                    <?php /* 
                    <td><?php echo $dati_prodotto->quantita; ?></td>
                    <td>&euro; <?php echo number_format((float)$totprezzo, 2, '.', ''); ?></td>
                    <td>&euro; <?php echo $dati_prodotto->costo; ?></td>*/ ?>
                    <td><a href="<?php echo MAGAZZINO;?>mod_mag.php?barcode=<?php echo $dati_prodotto->id;?>"><i class="fa fa-edit"></i></a></td>
                    <td><a href="?id_Magazzino_Cancella=<?php echo $dati_prodotto->id;?>" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
                    </tr>
                    <?php
                    $totale_inventario[]= $valore_magazzino;
              }
              $media_inventario = array_sum( $totale_inventario );

            
              echo '<tr><td colspan="3"></td><td colspan="2"><strong>Totale Magazzino</strong></td><td><strong>&euro; '.number_format((float)$media_inventario, 2, '.', '').'</td>
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