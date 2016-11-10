<?php
include_once 'functions.php';
include CLASMOD.'Trattamento.php';
include 'applicazioni/check_login.php';
session_start();
$trattamenti = new DB_con();
$table = "trattamenti";
// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['id_trattamento_Cancella'])){
  $del_trattamento = new Trattamento();
  
   $res=$del_trattamento->del_trattamento($_GET['id_trattamento_Cancella']);
    if ($res) {
      header('location:?messaggio=cancellazione avvenuta correttamente');
   } else {
      header('location:?messaggio=si è verificato un errore durante la cancellazione');
   }
}

if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
include_once(LAYOUT.'pretitle.php');
?>

<title>Lista trattamenti </title>
<?php include_once(LAYOUT.'header.php'); ?>
<header>
  <div class="continer">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">Visuale completa dei trattamenti</h1>
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
        <th>Nome</th>
        <th>Descrizione</th>
        <th>Durata</th>
        <th></th>
        <th></th>
        </tr>
        <?php
        if  ($res=$trattamenti->select($table)) {
           while($trattamento = $res->fetch_object())
           {
             ?>
              <tr>
              <td><?php echo $trattamento->nome; ?></td>
              <td><?php echo substr(nl2br($trattamento->descrizione),0,15); ?></td>
              <td><?php echo $trattamento->durata_trattamento; ?></td>
              <?php 
              if ($_SESSION['livello']=='suxuser') { ?>
              <td><a href="<?php echo TRATTAMENTI; ?>mod_trattamento.php?id_trattamento=<?php echo $trattamento->id;?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="?id_trattamento_Cancella=<?php echo $trattamento->id;?>" class="red" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
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
