<?php
session_start();
include_once('../../functions.php');
include CLASMOD.'Prodotto.php';
$add_cat = new Prodotto();

if(isset($_POST['btn-save'])) {

 $nome = $add_cat->pulisci_stringa($_POST['nome']);
 
 $categoria = $add_cat->insert_categorie($nome);
 //exit();/*/
 if($categoria)   {
    header('location:?messaggio=Categoria inserita correttamente');
  } else {
    header('location:?alert=danger&messaggio=c\'è un errore nell\'inserimento della categoria');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento di una nuova categoria</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento di una nuova Categoria</h1>
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
                <input type="text" name="nome" placeholder="Categoria Prodotto" required />
            </div>
            <div class="col-xs-12">
                <input type="submit" name="btn-save" value="Aggiungi" />
            </div>
        </form>
      </div>
  </div>
</div>

</section>
<?php include_once(LAYOUT.'footer.php'); ?>
<?php } ?>