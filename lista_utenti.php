<?php
include_once 'functions.php';
include CLASMOD.'User.php';
include 'applicazioni/check_login.php';
session_start();
$Utenti = new DB_con();
$table = "utenti";
// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['idUtenteCancella'])){
  $delutente = new User();
  
   $res=$delutente->del_utente($_GET['idUtenteCancella']);
    if ($res) {
      header('location:?messaggio=cancellazione avvenuta correttamente');
   } else {
      header('location:?messaggio=si è verificato un errore durante la cancellazione');
   }
}

if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
include_once(LAYOUT.'pretitle.php');
?>

<title>Lista utenti </title>
<?php include_once(LAYOUT.'header.php'); ?>
<header>
  <div class="continer">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">Visuale completa degli utenti</h1>
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
        <th>User</th>
        <th>Livello</th>
        <th></th>
        <th></th>
        </tr>
        <?php
        if  ($res=$Utenti->select($table)) {
           while($User = $res->fetch_object())
           {
             ?>
              <tr>
              <td><?php echo $User->nome.' '.$User->cognome; ?></td>
              <td><?php echo $User->username; ?></td>
              <td><?php 
                if ($User->livello=='suxuser') : echo 'Supervisor'; else : echo $User->livello; endif; ?></td>
                <?php if ($_SESSION['livello']=='dipendente') {
                  if ($_SESSION['userID']==$User->id) {
                    echo '<td><a href="applicazioni/utenti/mod_user.php?idUtente='.$User->id.'"><i class="fa fa-edit"></i></a></td><td></td>';
                  } else {
                    echo '<td></td><td></td>';
                  }
                }
              if ($_SESSION["nome"] == 'Cesco') {
              if ($_SESSION['livello']=='suxuser') { ?>
              <td><a href="applicazioni/utenti/mod_user.php?idUtente=<?php echo $User->id;?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="?idUtenteCancella=<?php echo $User->id;?>" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
              <?php }
              
              } ?>
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
