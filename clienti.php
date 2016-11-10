<?php
include_once 'functions.php';
include CLASMOD.'Cliente.php';
include CLASMOD.'Scheda.php';
include 'applicazioni/check_login.php';
session_start();
$clienti = new DB_con();
$scheda = new Scheda();
$table = "clienti";
// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['id_cliente_Cancella'])){
  $del_cliente = new Cliente();
  
   $res=$del_cliente->del_cliente($_GET['id_cliente_Cancella']);
    if ($res) {
      header('location:?messaggio=cancellazione avvenuta correttamente');
   } else {
      header('location:?messaggio=si è verificato un errore durante la cancellazione');
   }
}

if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
include_once(LAYOUT.'pretitle.php');
?>

<title>Lista clienti </title>
<?php include_once(LAYOUT.'header.php'); ?>
<header>
  <div class="continer">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">Visuale completa dei clienti</h1>
        <h4 class="text-center" id="search_client">Cerca Cliente</h4>
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
  <div class="container" id="form_search">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <h4 class="paddingleft20">Cerca per Cognome</h4>
        <div class="col-xs-12">
          <form class="search_form" method="post" action="search_result.php?search=cognome">
            <div class="col-xs-12 col-sm-6">
              <input type="text" name="ricerca" id="barcode" placeholder="Cognome" required />
            </div>
            <div class="col-xs-12 col-sm-6">
              <input type="submit" value="Cerca" class="btn-save" />
            </div>
          </form>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <h4 class="paddingleft20">Cerca per Card</h4>
        <div class="col-xs-12">
          <form class="search_form" method="post" action="search_result.php?search=card">
            <div class="col-xs-12 col-sm-6">
              <input type="text" name="ricerca" placeholder="Tessera" required />
            </div>
            <div class="col-xs-12 col-sm-6">
              <input type="submit" value="Cerca" class="btn-save" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
     <div class="table-responsive">
      <table class="table table-hover">
        <tr>
        <th colspan="5"></th>
        </tr>
        <tr>
        <th>Cognome e Nome</th>
        <th>Cellulare</th>
        <th>Mail</th>
        <th>Card</th>
        <th class="text-center">Trattamenti</th>
        <th></th>
        <th></th>
        </tr>
        <?php
        if  ($res=$clienti->select($table)) {
           while($cliente = $res->fetch_object())
           {
             ?>
              <tr>
              <td><a href="details.php?details=cliente&id=<?php echo $cliente->id; ?>"><?php echo $cliente->cognome.' '.$cliente->nome; ?></a></td>
              <td><?php echo $cliente->cellulare; ?></td>
              <td><?php echo $cliente->mail; ?></td>
              <td><?php echo $cliente->card; ?></td>
              <td class="text-center"><?php $sitratt = $scheda->tratt_by_client($cliente->id);
              if ($sitratt->num_rows!='0') { echo '<a href="details.php?details=trattamenti&cliente='.$cliente->id.'"><i class="fa fa-file-text-o"></i></a>';} ?></td>
              <?php 
              if ($_SESSION['livello']=='suxuser') { ?>
              <td><a href="<?php echo CLIENTI; ?>mod_cliente.php?id_cliente=<?php echo $cliente->id;?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="?id_cliente_Cancella=<?php echo $cliente->id;?>" class="red" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
              <?php } ?>
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
