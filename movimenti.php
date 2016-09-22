<?php
include_once 'functions.php';
include CLASMOD.'Prodotto.php';
include CLASMOD.'Movimento.php';

include APPL.'check_login.php';
session_start();
$Movimenti = new DB_con();
$table='movimenti';
// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['id_movimento_del'])){
  $del_dipendente = new Dipendente();
  
   $res=$del_dipendente->del_dipendente($_GET['id_movimento_del']);
    if ($res) {
      header('location:?messaggio=cancellazione avvenuta correttamente');
   } else {
      header('location:?messaggio=si è verificato un errore durante la cancellazione');
   }
}

if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
include_once(LAYOUT.'pretitle.php');
?>

<title>Lista movimenti </title>
<?php include_once(LAYOUT.'header.php'); ?>
<header>
  <div class="continer">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">Visuale completa dei movimenti</h1>
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
        <th colspan="5"></th>
        </tr>
        <tr>
        <th>Barcode</th>
        <th>Prodotto</th>
        <th>Causale</th>
        <th>Q.tà</th>
        <th>Note</th>
        <th></th>
        <th></th>
        </tr>
        <?php
        if  ($res=$Movimenti->select($table)) {
           while($Movimento = $res->fetch_object())
           {
             ?>
              <tr>
              <td><?php echo $Movimento->barcode; ?></td>
              <td><?php $barcode = $Movimento->barcode;
              $id_prod = $Movimenti->sel_ID_prod($barcode);
              //$id_prod = '1';
              /*var_dump($id_prod);
              exit();*/
              $Prodotto = new Prodotto($id_prod);
              echo $Prodotto->nome; ?></td>
              <td><?php echo $Movimento->causale; ?></td>
              <td><?php if ($Movimento->causale=='uscita') { $simbolo='-';} else {$simbolo='';} echo $simbolo.' '.$Movimento->quantita; ?></td>
              <td><?php echo $Movimento->note; ?></td>
              <td><?php 
              if ($_SESSION['livello']=='suxuser') { ?>
              <td><a href="<?php echo MAGAZZINO;?>mod_mov.php?id_movimento=<?php echo $Movimento->id;?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="?id_movimento_del=<?php echo $Movimento->id;?>" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
              <?php } ?> </td>
              </tr>
              <?php
           }
            
         }
          
         ?>
        </table>
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
