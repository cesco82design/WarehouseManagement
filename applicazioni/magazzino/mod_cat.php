<?php


//session_start();

include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Prodotto.php';
$mod_cat = new Prodotto();
//print_r($mod_cat);
if ($_GET['id']) {
  $res = $mod_cat->select_categorie($_GET['id']);
  $cat = $res->fetch_object();
  //print_r($cat)
} else {
    header('location:../../categorie.php?alert=danger&messaggio=nessuna categoria da modificare');
  }
if(isset($_POST['btn-save'])) {

 $nome = $mod_cat->pulisci_stringa($_POST['nome']);
 
 $categoria = Prodotto::aggiorna_categoria($_GET['id'],$nome);
 //exit();/*/
 if($categoria)   {
    header('location:../../categorie.php?messaggio=Categoria aggiornata correttamente');
  } else {
    header('location:?alert=danger&messaggio=c\'è un errore l\'aggiornamento della categoria');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Modifica di una nuova categoria</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Modifica di una nuova Categoria</h1>
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
                <label for="nome">Categoria</label>
                <input type="text" name="nome" value="<?php echo $cat->nome; ?>" required />
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