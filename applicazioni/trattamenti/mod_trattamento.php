<?php
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Trattamento.php';
$mod_trattamento = new Trattamento($_GET['id_trattamento']);

if(isset($_POST['btn-save'])) {

 $nome = $mod_trattamento->pulisci_stringa($_POST['nome']);
 $descrizione = $mod_trattamento->pulisci_stringa($_POST['descrizione']);
 $durata = $mod_trattamento->pulisci_stringa($_POST['durata']);
 
 $trattamento = $mod_trattamento->aggiorna_trattamento($_GET['id_trattamento'],$nome,$descrizione,$durata);
 //exit();/*/
 if($trattamento)   {
    header('location:?messaggio=Trattamento modificato correttamente');
  } else {
    header('location:?alert=danger&messaggio=c\'è un errore nella modifica del trattamento');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Modifica di un  trattamento</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Modifica di un  trattamento</h1>
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
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="<?php echo $mod_trattamento->nome; ?>" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="durata">Durata</label>
                <input type="text" name="durata" value="<?php echo $mod_trattamento->durata_trattamento; ?>"  />
            </div>
            <div class="col-xs-12">
                <label for="descrizione">Descrizione</label>
                <textarea name="descrizione" class="col-xs-12" required ><?php echo $mod_trattamento->descrizione; ?></textarea>
            </div>
            <div class="col-xs-12">
                <input type="submit" name="btn-save" class="btn-save" value="Modifica" />
            </div>
        </form>
      </div>
  </div>
</div>

</section>
<?php include_once(LAYOUT.'footer.php'); ?>
<?php } ?>