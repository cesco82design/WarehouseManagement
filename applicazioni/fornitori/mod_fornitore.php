<?php
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Fornitore.php';
$mod_fornitore = new Fornitore($_GET['id_fornitore']);
//print_r($mod_fornitore);exit();
if(isset($_POST['btn-save'])) {
  $denominazione = $mod_fornitore->pulisci_stringa($_POST['denominazione']);
  $indirizzo = $mod_fornitore->pulisci_stringa($_POST['indirizzo']);
  $citta = $mod_fornitore->pulisci_stringa($_POST['citta']);
  $provincia = $mod_fornitore->pulisci_stringa($_POST['provincia']);
  $cap = $mod_fornitore->pulisci_stringa($_POST['cap']);
  $telefono = $mod_fornitore->pulisci_stringa($_POST['telefono']);
  $telefono2 = $mod_fornitore->pulisci_stringa($_POST['telefono2']);
  $cellulare = $mod_fornitore->pulisci_stringa($_POST['cellulare']);
  $mail = $mod_fornitore->validate_email($_POST['mail']);
  $partitaiva = $mod_fornitore->pulisci_stringa($_POST['partitaiva']);
  $codicefiscale = $mod_fornitore->pulisci_stringa($_POST['codicefiscale']);
  $iban = $mod_fornitore->pulisci_stringa($_POST['iban']);
  $sito = $mod_fornitore->pulisci_stringa($_POST['sito']);
  $note = $mod_fornitore->pulisci_stringa($_POST['note']);

/*echo $nome.' '.$cognome.' '.$indirizzo.' '.$citta.' '.$provincia.' '.$cap.' '.$telefono.' '.$telefono2.' '.$cellulare.' '.$mail.' '.$partitaiva.' '.$codicefiscale;
exit();*/
 $fornitore = Fornitore::aggiorna_fornitore($_GET['id_fornitore'],$denominazione,$indirizzo,$citta,$provincia,$cap,$telefono,$telefono2,$cellulare,$mail,$partitaiva,$codicefiscale,$iban,$sito,$note);
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

<title>Modifica Fornitore</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Modifica Fornitore</h1>
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
              <input type="text" name="denominazione" value="<?php echo $mod_fornitore->denominazione; ?>" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="indirizzo">Indirizzo</label>
                <input type="text" name="indirizzo" value="<?php echo $mod_fornitore->indirizzo; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="citta">Città</label>
                <input type="text" name="citta" value="<?php echo $mod_fornitore->citta; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia" value="<?php echo $mod_fornitore->provincia; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cap">CAP</label>
                <input type="text" name="cap" value="<?php echo $mod_fornitore->cap; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" value="<?php echo $mod_fornitore->telefono; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="telefono2">Altro telefono</label>
                <input type="text" name="telefono2" value="<?php echo $mod_fornitore->telefono2; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cellulare">Cellulare</label>
                <input type="text" name="cellulare" value="<?php echo $mod_fornitore->cellulare; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="mail">Mail</label>
                <input type="text" name="mail" value="<?php echo $mod_fornitore->mail; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="partitaiva">Partita Iva</label>
                <input type="text" name="partitaiva" value="<?php echo $mod_fornitore->partitaiva; ?>" />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="codicefiscale">Codice Fiscale</label>
                <input type="text" name="codicefiscale" value="<?php echo $mod_fornitore->codicefiscale; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="iban">IBAN</label>
                <input type="text" name="iban" value="<?php echo $mod_fornitore->iban; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="sito">Sito Web</label>
                <input type="text" name="sito" value="<?php echo $mod_fornitore->sito; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="note">Note</label>
                <textarea name="note" style="width:100%;"><?php echo $mod_fornitore->note; ?></textarea>
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