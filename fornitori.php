<?php
include_once 'functions.php';
include CLASMOD.'Fornitore.php';
include 'applicazioni/check_login.php';
session_start();
$fornitori = new DB_con();
$table = "fornitori";
// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['id_fornitore_Cancella'])){
  $del_fornitore = new Fornitore();
  
   $res=$del_fornitore->del_fornitore($_GET['id_fornitore_Cancella']);
    if ($res) {
      header('location:?messaggio=cancellazione avvenuta correttamente');
   } else {
      header('location:?messaggio=si è verificato un errore durante la cancellazione');
   }
}

if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
include_once(LAYOUT.'pretitle.php');
?>

<title>Lista fornitori </title>
<?php include_once(LAYOUT.'header.php'); ?>
<header>
  <div class="continer">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">Visuale completa dei fornitori</h1>
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
        <th>Denominazione</th>
        <th>Telefono</th>
        <th>Altro Telefono</th>
        <th>Cellulare</th>
        <th>Mail</th>
        <th>Sito</th>
        <th>Note</th>
        <th></th>
        <th></th>
        </tr>
        <?php
        if  ($res=$fornitori->select($table)) {
           while($fornitore = $res->fetch_object())
           {
             ?>
              <tr>
              <td><a href="details.php?details=fornitore&id=<?php echo $fornitore->id;?>"><?php echo $fornitore->denominazione; ?></a></td>
              <td><?php echo $fornitore->telefono; ?></td>
              <td><?php echo $fornitore->telefono2; ?></td>
              <td><?php echo $fornitore->cellulare; ?></td>
              <td><?php echo $fornitore->mail; ?></td>
              <td><?php echo $fornitore->sito; ?></td>
              <td><?php echo substr(nl2br($fornitore->note),0,10); 
               //echo nl2br($fornitore->note); ?></td>
              <?php 
              if ($_SESSION['livello']=='suxuser') { ?>
              <td><a href="<?php echo FORNITORI; ?>mod_fornitore.php?id_fornitore=<?php echo $fornitore->id;?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="?id_fornitore_Cancella=<?php echo $fornitore->id;?>" class="red" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
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
