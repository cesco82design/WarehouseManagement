<?php
session_start();
include_once('../../functions.php');
include CLASMOD.'Prodotto.php';
$add_marca = new Prodotto();

if(isset($_POST['btn-save'])) {

 $nome = $add_marca->pulisci_stringa($_POST['nome']);
 
 $marca = $add_marca->insert_marca($nome);
 //exit();/*/
 if($marca)   {
    header('location:?messaggio=Marca inserita correttamente');
  } else {
    header('location:?alert=danger&messaggio=c\'è un errore nell\'inserimento della marca');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento di un nuovo Brand</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento di un nuovo Brand</h1>
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
                <input type="text" name="nome" placeholder="Marca Prodotto" required />
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