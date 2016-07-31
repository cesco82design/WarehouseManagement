<?php
include 'asset/moduli/User.php';
include 'applicazioni/check_login.php';
session_start();
$Utenti = new DB_con();
$table = "utenti";
// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['idUtenteCancella'])){
  $delutente = new User();
  
   $res=$delutente->del_utente($_GET['idUtenteCancella']);
    /*$sql = "DELETE FROM utenti WHERE idUtente = '".$_GET['idUtenteCancella']."';";
    $result = $conn->query($sql) or die($conn->error);
    header('location:?messaggio=cancellazione avvenuta correttamente');*/
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



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Lista utenti </title>
<link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="asset/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="asset/css/style.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="asset/js/custom_script.js"></script>
</head>
<body>
<div class="page">
<div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-4 col-md-offset-8">
        <small>
          <a href="applicazioni/logout.php">Disconnetti</a>
        </small>
      </div>
    </div>
</div>
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
            <div class="messaggio">
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
        <th colspan="5" class="text-center"><a href="index.php">Home</a> | <a href="applicazioni/utenti/add_user.php">Aggiungi Utente</a></th>
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
              <td><?php echo $User->nomeutente; ?></td>
              <td><?php echo $User->user; ?></td>
              <td><?php 
              if ($User->livello=='suxuser') : echo 'Supervisor'; else : echo $User->livello; endif; ?></td>
              <td><a href="applicazioni/utenti/mod_user.php?idUtente=<?php echo $User->idUtente;?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="?idUtenteCancella=<?php echo $User->idUtente;?>" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
              </tr>
              <?php
           }
            
         }
          
         ?>
        </table>
    </div>
</section>

<footer>
  <div class="text-center">
    <small>Per qualsiasi problema contattare : <a href="http://www.cesco82design.it">Cesco82Design.it</a></small>
  </div>
</footer>

</div>
<?php 
} else {
    echo 'Non sei autorizzato';
}
 ?>
</body>
</html>
