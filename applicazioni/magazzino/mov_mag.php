<?php
session_start();
include_once('../../functions.php');
/*include CLASMOD.'Movimento.php';
$addprod = new Prodotto();
*/
if(isset($_POST['btn-save'])) {
/*
 $barcode = $addprod->pulisci_stringa($_POST['barcode']);
 $nome = $addprod->pulisci_stringa($_POST['nome']);
 $marca = $_POST['marca'];
 $categoria = $_POST['categoria'];
 $sottoscorta = $addprod->pulisci_stringa($_POST['sottoscorta']);
/*echo $barcode.' '.$nome.' '.$marca.' '.$categoria.' '.$sottoscorta;
exit();* /
 $prodotto = Prodotto::insert_magazzino($barcode,$nome,$marca,$categoria,$sottoscorta);
 /*var_dump($prodotto);
 exit();* /
 if($prodotto)   {
    header('location:?messaggio=Prodotto inserito correttamente');
  } else {
    header('location:?alert=danger&messaggio=c\'è un errore nell\'inserimento del prodotto');
  }*/
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
                <input type="text" id="barcode" name="barcode" placeholder="Barcode Prodotto" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="prezzo">Prezzo</label>
                <input type="text" name="prezzo" placeholder="Prezzo Prodotto" />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="quantita">Quantità</label>
                <input type="number" name="quantita" placeholder="Quantità" />
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="radio">
                <input type="radio" id="radio01" name="radio" />
                <label for="radio01"><span></span>Entrata</label>
              </div>

              <div class="radio">
               <input type="radio" id="radio02" name="radio" />
               <label for="radio02"><span></span>Uscita</label>
              </div>
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