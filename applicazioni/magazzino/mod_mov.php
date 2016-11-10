<?php
//session_start();
include_once ('../check_login.php');
session_start();
include_once('../../functions.php');
include CLASMOD.'Movimento.php';
$mod_mov = new Movimento($_GET['id_movimento']);
//print_r($mod_mov);exit();
if(isset($_POST['btn-save'])) {

 $barcode = $mod_mov->pulisci_stringa($_POST['barcode']);
 $prezzo = $mod_mov->pulisci_stringa($_POST['prezzo']);
 $quantita = $mod_mov->pulisci_stringa($_POST['quantita']);
 $causale = $mod_mov->pulisci_stringa($_POST['radio']);
 if ($causale=='entrata') {
  $quantitae = $quantita;
  $quantitau = '';
 } else {
  $quantitau = $quantita;
  $quantitae = '';
 }
 $note = $mod_mov->pulisci_stringa($_POST['note']);
/*echo $barcode.' '.$nome.' '.$marca.' '.$categoria.' '.$sottoscorta;
exit();*/
 $movimento = Movimento::aggiorna_movimento($_GET['id_movimento'],$barcode,$prezzo,$quantitae,$quantitau,$note);
/*var_dump($movimento);
 exit();*/
 if($movimento)   {
    header('location:?messaggio=Movimento modificato correttamente');
  } else {
    header('location:?alert=danger&messaggio=c\'è un errore nella modifica del movimento');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>
<title>Modifica Movimento di Magazzino</title>

<?php include_once(LAYOUT.'header.php'); ?>
<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Modifica Movimento di Magazzino</h1>
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
         <form id="Mov_mag" method="post">
            
            <div class="col-xs-12 col-sm-6">
                <label for="barcode">Barcode</label>
                <input type="text" class="barcode_input" name="barcode" value="<?php echo $mod_mov->barcode; ?>" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="prezzo">Prezzo</label>
                <input type="text" name="prezzo" value="<?php echo $mod_mov->prezzo; ?>" />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="quantita">Quantità</label>
                <input type="number" name="quantita" value="<?php if ($mod_mov->quantitae=='0') { echo $mod_mov->quantitau;} else { echo $mod_mov->quantitae;} ?>" />
            </div>
            <div class="col-xs-12 col-sm-6" style="margin-top: 45px;">
              <div class="radio">
                <input type="radio" id="radio01" name="radio" value="entrata" <?php if ($mod_mov->quantitae!='0') { echo 'checked';} ?> />
                <label for="radio01"><span></span>Entrata</label>
              </div>

              <div class="radio">
               <input type="radio" id="radio02" name="radio" value="uscita" <?php if ($mod_mov->quantitau!='0') { echo 'checked';} ?>/>
               <label for="radio02"><span></span>Uscita</label>
              </div>
            </div>
            <div class="col-xs-12">
              <textarea name="note"><?php echo $mod_mov->note; ?></textarea>
            </div>
            <div class="col-xs-12">
                <input type="submit" name="btn-save" class="btn-save" value="Aggiungi" onclick="return confirm('Sei sicuro di modificare?')"/>
            </div>
        </form>
      </div>
  </div>
</div>

</section>
<?php include_once(LAYOUT.'footer.php'); ?>
<?php } ?>