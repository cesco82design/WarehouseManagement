<?php
include 'asset/conn/db.php';
include 'applicazioni/check_login.php';
session_start();
collega_db();

// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['idUtenteCancella'])){
    $sql = "DELETE FROM utenti WHERE idUtente = '".$_GET['idUtenteCancella']."';";
    $result = $conn->query($sql) or die($conn->error);
    header('location:?messaggio=cancellazione avvenuta correttamente');
}
if ($_SESSION['livello']=='dipendente'){
    header('location:dipendente.php?messaggio=questa è la pagina a te dedicata');
    exit;
}
if ($_SESSION['livello']=='suxuser'){

include_once 'asset/moduli/dbMySQL.php';
$con = new DB_con();
$table = "utenti";
$res=$con->select($table);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Magazzino </title>
<link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="asset/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="asset/css/style.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="asset/js/custom_script.js"></script>
</head>
<body>
<div class="page text-center">
<div class="container">
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
<div id="header">
 <div id="content">
    <h1>Visuale completa degli utenti</h1>
    </div>
</div>
<div id="body">
 <div class="container">
     <div class="table-responsive">
      <table class="table table-hover">
        <tr>
        <th colspan="5" class="text-center"><a href="index.php">Home</a> | <a href="applicazioni/add_user.php">Aggiungi Utente</a></th>
        </tr>
        <tr>
        <th>Nome</th>
        <th>User</th>
        <th>Livello</th>
        <th></th>
        <th></th>
        </tr>
        <?php
         while($row=mysql_fetch_row($res))
         {
           ?>
            <tr>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td><a href="applicazioni/utenti/mod_user.php?idUtente=<?php echo $row['0'];?>"><i class="fa fa-edit"></i></a></td>
            <td><a href="applicazioni/utenti/del_user.php?idUtente=<?php echo $row['0'];?>"><i class="fa fa-times-circle"></i></a></td>
            </tr>
            <?php
         }
         ?>
        </table>
    </div>
</div>

<div id="footer">
 <div id="content">
    <hr /><br/>
    <label>Per qualsiasi problema contattare : <a href="http://www.cesco82design.it">Cesco82Design.it</a></label>
    </div>
</div>

</div>
<?php 
} else {
    echo 'Non sei autorizzato';
}
scollega_db(); ?>
</body>
</html>