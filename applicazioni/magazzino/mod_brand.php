<?php


//session_start();

include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Prodotto.php';
$mod_brand = new Prodotto();
//print_r($mod_cat);
if ($_GET['id']) {
  $res = $mod_brand->select_brand($_GET['id']);
  $brand = $res->fetch_object();
  //print_r($cat)
} else {
    header('location:../../brand.php?alert=danger&messaggio=nessun brand da modificare');
}
if(isset($_POST['btn-save'])) {

 $nome = $mod_brand->pulisci_stringa($_POST['nome']);
 
 $brand = Prodotto::aggiorna_brand($_GET['id'],$nome);
 //exit();/*/
 if($brand)   {
    header('location:../../brand.php?messaggio=Brand aggiornato correttamente');
  } else {
    header('location:?alert=danger&messaggio=c\'è un errore l\'aggiornamento del brand');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Modifica di un brand</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Modifica di un brand</h1>
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
<section>
 <div class="container">
   <div class="row">
     <div class="col-xs-12 col-md-6 col-md-offset-3">
        <form id="insert_prod" method="post">
            <div class="col-xs-12 col-sm-6">
                <label for="nome">Marca</label>
                <input type="text" name="nome" value="<?php echo $brand->nome; ?>" required />
            </div>
            <div class="col-xs-12">
                <input type="submit" name="btn-save" value="Modifica" />
            </div>
        </form>
      </div>
  </div>
</div>

</section>
<?php include_once(LAYOUT.'footer.php'); ?>
<?php } ?>