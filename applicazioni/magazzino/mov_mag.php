<?php
//session_start();
include_once ('../check_login.php');
session_start();
include_once('../../functions.php');
include CLASMOD.'Movimento.php';
$add_mov = new Movimento();

if(isset($_POST['btn-save'])) {

 $barcode = $add_mov->pulisci_stringa($_POST['barcode']);
 $prezzo = $add_mov->pulisci_stringa($_POST['prezzo']);
 $quantita = $add_mov->pulisci_stringa($_POST['quantita']);
 $causale = $add_mov->pulisci_stringa($_POST['radio']);
 if ($causale=='entrata') {
  $quantitae = $quantita;
  $quantitau = '';
 } else {
  $quantitau = $quantita;
  $quantitae = '';
 }
 $note = $add_mov->pulisci_stringa($_POST['note']);
/*echo $barcode.' '.$nome.' '.$marca.' '.$categoria.' '.$sottoscorta;
exit();*/
 $movimento = Movimento::insert_movimento($barcode,$prezzo,$quantitae,$quantitau,$note);
/* var_dump($movimento);
 exit();*/
 if($movimento)   {
    header('location:?messaggio=Movimento inserito correttamente');
  } else {
    header('location:?alert=danger&messaggio=c\'è un errore nell\'inserimento del movimento');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>
<title>Movimenti di Magazzino</title>

<?php include_once(LAYOUT.'header.php'); ?>
<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Movimenti di Magazzino</h1>
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
                <input type="text" class="barcode_input" name="barcode" placeholder="Barcode Prodotto" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="prezzo">Prezzo</label>
                <input type="text" name="prezzo" placeholder="Prezzo Prodotto" />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="quantita">Quantità</label>
                <input type="number" name="quantita" placeholder="Quantità" />
            </div>
            <div class="col-xs-12 col-sm-6" style="margin-top: 45px;">
              <div class="radio">
                <input type="radio" id="radio01" name="radio" value="entrata"/>
                <label for="radio01"><span></span>Entrata</label>
              </div>

              <div class="radio">
               <input type="radio" id="radio02" name="radio" value="uscita"/>
               <label for="radio02"><span></span>Uscita</label>
              </div>
            </div>
            <div class="col-xs-12">
              <textarea placeholder="Inserisci eventuali note" name="note"></textarea>
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