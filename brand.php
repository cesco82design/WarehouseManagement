<?php
include_once('functions.php');
include CLASMOD.'Prodotto.php';
include 'applicazioni/check_login.php';
//session_start();

$marca = new Prodotto();

// cancello utente se mi è stato passato un parametro di cancellazione
if(isset($_GET['idmarcaCancella'])){
  
  
   $res=$marca->del_marca($_GET['idmarcaCancella']);
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

include_once(LAYOUT.'pretitle.php');  
?>

<title>Brand </title>

<?php include_once(LAYOUT.'header.php'); ?>

<header>
  <div class="continer">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">Visuale completa dei Brand</h1>
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
          <th></th>
          </tr>
          <tr>
          <th>Nome Brand</th>
          <th></th>
          <th></th>
          </tr>
          <?php
            if ($res = $marca->select_brand()){
              while ($brand = $res->fetch_object()) {
                   ?>
                    <tr>
                    <td><?php echo $brand->nome; ?></td>
                    <td><a href="applicazioni/magazzino/mod_brand.php?id=<?php echo $brand->ID;?>"><i class="fa fa-edit"></i></a></td>
                    <td><a href="?idmarcaCancella=<?php echo $brand->ID;?>" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
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