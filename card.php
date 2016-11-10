<?php
include_once 'functions.php';
include CLASMOD.'Tessera.php';
include CLASMOD.'Cliente.php';
include 'applicazioni/check_login.php';
session_start();
$tessere = new DB_con();
$table = "card";
// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['id_tessera_Cancella'])){
  $del_tessera = new Tessera();
  
   $res=$del_tessera->del_tessera($_GET['id_tessera_Cancella']);
    if ($res) {
      header('location:?messaggio=cancellazione avvenuta correttamente');
   } else {
      header('location:?messaggio=si è verificato un errore durante la cancellazione');
   }
}

if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
include_once(LAYOUT.'pretitle.php');
?>

<title>Lista tessere </title>
<?php include_once(LAYOUT.'header.php'); ?>
<header>
  <div class="continer">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">Visuale completa delle tessere</h1>
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
        <th>Codice</th>
        <th>Associata a</th>
        <th>Data di Attivazione</th>
        <th>Data di Disattivazione</th>
        <th>Stato</th>
        <th></th>
        <th></th>
        </tr>
        <?php
        if  ($res=$tessere->select($table)) {
           while($tessera = $res->fetch_object())
           {
             ?>
              <tr>
              <td><?php echo $tessera->id; ?></td>
              <td><?php $id_cliente = $tessera->id_cliente;
              $info_cliente = new Cliente($id_cliente);
              echo $info_cliente->cognome.' '.$info_cliente->nome; ?></td>
              <td><?php echo $tessera->data_attivazione; ?></td>
              <td><?php if ($tessera->attiva=='no') {echo $tessera->data_disattivazione;} ?></td>
              <td><?php if ($tessera->attiva=='si') {echo 'Attiva';} else {echo 'Disattivata';} ?></td>
              <td class="text-center"><i class="fa fa-file-text-o"></i></td>
              <?php 
              if ($_SESSION['livello']=='suxuser') { ?>
              <td><a href="<?php echo TESSERE; ?>mod_tessera.php?id_tessera=<?php echo $tessera->id;?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="?id_tessera_Cancella=<?php echo $tessera->id;?>" class="red" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
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
