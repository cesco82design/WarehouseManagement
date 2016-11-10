<?php
include_once 'functions.php';
include CLASMOD.'Scheda.php';
include CLASMOD.'Cliente.php';
include CLASMOD.'Dipendente.php';
include 'applicazioni/check_login.php';
session_start();
$schede = new DB_con();
$table = "schede_clienti";
// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['id_schedacliente_Cancella'])){
  $del_scheda = new Scheda();
  
   $res=$del_scheda->del_scheda($_GET['id_schedacliente_Cancella']);
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
              <input type="text" name="ricerca" placeholder="Cognome" required />
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
        <th>N.</th>
        <th>Cliente</th>
        <th>Card</th>
        <th>Data</th>
        <th>Operatrice</th>
        <th>Prezzo</th>
        <th>Note</th>
        <th></th>
        <th></th>
        </tr>
        <?php
        if  ($res=$schede->select($table)) {
           while($scheda = $res->fetch_object())
           {
             ?>
              <tr>
              <td><?php echo $scheda->id; ?></td>
              <td><?php //echo $scheda->id_cliente;
              $id_cliente = $scheda->id_cliente;
              $info_cliente = new Cliente($id_cliente);
              echo '<a href="details.php?details=cliente&id='.$id_cliente.'">';
              echo $info_cliente->cognome.' '.$info_cliente->nome;
              echo '</a>';
               ?></td>
              <td><?php echo $scheda->card; ?></td>
              <td><?php echo $scheda->data; ?></td>
              <td><?php $id_operatrice = $scheda->operatrice; 
                    $dipendente = new Dipendente($id_operatrice); 
                    echo $dipendente->operatrice;
              ?></td>
              <td><?php if ($scheda->pagato=='si'){echo 'Pagata';} else { echo 'Non Pagata';} ?></td>
              <td><?php echo $scheda->note; ?></td>
              <td class="text-center"><a href="details.php?details=scheda&id=<?php echo $scheda->id;?>"><i class="fa fa-file-text-o"></i></a></td>
              <?php 
              if ($_SESSION['livello']=='suxuser') { ?>
              <td><a href="<?php echo SCHEDE; ?>mod_scheda.php?id_scheda=<?php echo $scheda->id;?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="?id_schedacliente_Cancella=<?php echo $scheda->id;?>" class="red" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
              <?php } ?>
              </tr>
              <?php
           }
            
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
