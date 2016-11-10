<?php
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Fornitore.php';
$add_fornitore = new Fornitore();

if(isset($_POST['btn-save'])) {
  $denominazione = $add_fornitore->pulisci_stringa($_POST['denominazione']);
  $indirizzo = $add_fornitore->pulisci_stringa($_POST['indirizzo']);
  $citta = $add_fornitore->pulisci_stringa($_POST['citta']);
  $provincia = $add_fornitore->pulisci_stringa($_POST['provincia']);
  $cap = $add_fornitore->pulisci_stringa($_POST['cap']);
  $telefono = $add_fornitore->pulisci_stringa($_POST['telefono']);
  $telefono2 = $add_fornitore->pulisci_stringa($_POST['telefono2']);
  $cellulare = $add_fornitore->pulisci_stringa($_POST['cellulare']);
  $mail = $add_fornitore->validate_email($_POST['mail']);
  $partitaiva = $add_fornitore->pulisci_stringa($_POST['partitaiva']);
  $codicefiscale = $add_fornitore->pulisci_stringa($_POST['codicefiscale']);
  $iban = $add_fornitore->pulisci_stringa($_POST['iban']);
  $sito = $add_fornitore->pulisci_stringa($_POST['sito']);
  $note = $add_fornitore->pulisci_stringa($_POST['note']);

/*echo $denominazione.' '.$indirizzo.' '.$citta.' '.$provincia.' '.$cap.' '.$telefono.' '.$telefono2.' '.$telefono2.' '.$cellulare.' '.$mail.' '.$partitaiva.' '.$codicefiscale;
exit();*/
 $fornitore = Fornitore::insert_fornitore($denominazione,$indirizzo,$citta,$provincia,$cap,$telefono,$telefono2,$cellulare,$mail,$partitaiva,$codicefiscale,$iban,$sito,$note);
 /*var_dump($prodotto);
 exit();*/
 if($fornitore)   {
    header('location:'.$_SERVER['HTTP_REFERER'].'?messaggio=Dati inseriti correttamente');
  } else {
    header('location:'.$_SERVER['HTTP_REFERER'].'?alert=danger&messaggio=c\'è un errore nell\'inserimento dei dati');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento Nuovo Fornitore</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento Nuovo Fornitore</h1>
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
     <div class="col-xs-12 col-md-10 col-md-offset-1">
        <form id="insert_prod" method="post">
            <div class="col-xs-12 col-sm-6">
              <label for="denominazione">Ragione Sociale</label>
              <input type="text" name="denominazione" placeholder="Ragione Sociale" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="indirizzo">Indirizzo</label>
                <input type="text" name="indirizzo" placeholder="Indirizzo"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="citta">Città</label>
                <input type="text" name="citta" placeholder="Città"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia" placeholder="Provincia"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cap">CAP</label>
                <input type="text" name="cap" placeholder="CAP"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" placeholder="Telefono"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="telefono2">Altro Telefono</label>
                <input type="text" name="telefono2" placeholder="Telefono"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cellulare">Cellulare</label>
                <input type="text" name="cellulare" placeholder="Cellulare"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="mail">Mail</label>
                <input type="text" name="mail" placeholder="Mail"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="partitaiva">Partita Iva</label>
                <input type="text" name="partitaiva" placeholder="Partita Iva"/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="codicefiscale">Codice Fiscale</label>
                <input type="text" name="codicefiscale" placeholder="Codice Fiscale"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="iban">IBAN</label>
                <input type="text" name="iban" placeholder="specificare IBAN"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="sito">Sito Web</label>
                <input type="text" name="sito" placeholder="Sito Web"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="note">Note</label>
                <textarea name="note" placeholder="Eventuali note" style="width:100%;"></textarea>
            </div>
            <div class="col-xs-12">
                <input type="submit" name="btn-save" class="btn-save margintop30" value="SALVA" />
            </div>
        </form>
      </div>
  </div>
</div>

</section>
<?php include_once(LAYOUT.'footer.php'); ?>
<?php } ?>