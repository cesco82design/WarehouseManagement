<?php
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Trattamento.php';
$add_trattamento = new Trattamento();
if(isset($_POST['btn-save'])) {

 $nome = $add_trattamento->pulisci_stringa($_POST['nome']);
 $descrizione = $add_trattamento->pulisci_stringa($_POST['descrizione']);
 $durata = $add_trattamento->pulisci_stringa($_POST['durata']);
 
 $trattamento = $add_trattamento->insert_trattamento($nome,$descrizione,$durata);
 //exit();/*/
 if($trattamento)   {
    header('location:?messaggio=Trattamento inserito correttamente');
  } else {
    header('location:?alert=danger&messaggio=c\'è un errore nell\'inserimento del trattamento');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento di un nuovo trattamento</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento di un nuovo trattamento</h1>
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
                <input type="text" name="nome" placeholder="Nome Trattamento" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="durata">Durata</label>
                <input type="text" name="durata" placeholder="Durata Trattamento"  />
            </div>
            <div class="col-xs-12">
                <label for="descrizione">Descrizione</label>
                <textarea name="descrizione" class="col-xs-12" placeholder="Descrizione Trattamento" required ></textarea>
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