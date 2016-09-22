<?php
include_once 'functions.php';
include CLASMOD.'User.php';
include CLASMOD.'Dipendente.php';

include APPL.'check_login.php';
session_start();
$Dipendenti = new DB_con();
$table = "dipendenti";
// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['iddipendenteCancella'])){
  $del_dipendente = new Dipendente();
  
   $res=$del_dipendente->del_dipendente($_GET['iddipendenteCancella']);
    if ($res) {
      header('location:?messaggio=cancellazione avvenuta correttamente');
   } else {
      header('location:?messaggio=si è verificato un errore durante la cancellazione');
   }
}

if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
include_once(LAYOUT.'pretitle.php');
?>

<title>Lista dipendenti </title>
<?php include_once(LAYOUT.'header.php'); ?>
<header>
  <div class="continer">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">Visuale completa dei dipendenti</h1>
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
        <th>Nome e Cognome</th>
        <th>User</th>
        <th>Cellulare</th>
        <th>Mail</th>
        <th>Operatrice</th>
        <th></th>
        <th></th>
        </tr>
        <?php
        if  ($res=$Dipendenti->select($table)) {
           while($Dipendente = $res->fetch_object())
           {
             ?>
              <tr>
              <td><?php echo $Dipendente->nome.' '.$Dipendente->cognome; ?></td>
              <td><?php if ( $Dipendente->idutente != '0' ) {
                $User = new User($Dipendente->idutente);
                 echo $User->username; 
              } ?></td>
              <td><?php echo $Dipendente->cellulare; ?></td>
              <td><?php echo $Dipendente->mail; ?></td>
              <td><?php echo $Dipendente->operatrice; ?></td>
              <td><?php 
              if ($Dipendente->livello=='suxuser') : echo 'Supervisor'; else : echo $Dipendente->livello; endif; ?></td>
              <?php if ($_SESSION['livello']=='dipendente') {
                if ($_SESSION['userID']==$Dipendente->id) {
                  echo '<td><a href="applicazioni/utenti/mod_dip.php?idDipendente='.$Dipendente->id.'"><i class="fa fa-edit"></i></a></td><td></td>';
                } else {
                  echo '<td></td><td></td>';
                }
              }
              if ($_SESSION['livello']=='suxuser') { ?>
              <td><a href="applicazioni/utenti/mod_dip.php?idDipendente=<?php echo $Dipendente->id;?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="?iddipendenteCancella=<?php echo $Dipendente->id;?>" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
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
