<?php
	
include '../../asset/moduli/Prodotto.php';
$modifica = new Prodotto($_GET['barcode']);
//var_dump($modifica);
if(isset($_POST['aggiorna'])) {

  $barcode=$modifica->pulisci_stringa($_GET['barcode']);
  $newnome = $modifica->pulisci_stringa($_POST['nome']);
  $newquantita = $modifica->pulisci_stringa($_POST['quantita']);
  $newprezzo = $modifica->pulisci_stringa($_POST['prezzo']);
  $newcosto = $modifica->pulisci_stringa($_POST['costo']);

 
  $res=$modifica->aggiorna_prodotto($barcode,$newnome,$newquantita,$newprezzo,$newcosto);
  if($res) {
    ?>
  <script>
    window.location='../../magazzino.php?messaggio=Prodotto Modificato correttamente';
    </script>
  <?php
  } else {
    ?>
  <script>
    window.location='../../magazzino.php?messaggio=c\'è stato un errore durante la modifica del prodotto, si prega di riprovare';
    </script>
  <?php
  }
} else {
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Modifica Utente</title>
<link rel="stylesheet" href="../../asset/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../../asset/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="../../asset/css/style.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="asset/js/custom_script.js"></script>
</head>

<body>
<header>
  <h1>Modifica Prodotto <?php echo $modifica->barcode;?></h1>
</header>
<section class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      <form name="form1" method="post">
        <p>nome
        <input type="text" name="nome" id="nome" value="<?php echo $modifica->nome; ?>">
        </p>
        <p>quantità
          <input type="text" name="quantita" value="<?php echo $modifica->quantita; ?>">
        </p>
        <p>prezzo
          <input type="text" name="prezzo" value="<?php echo $modifica->prezzo; ?>">
        </p>
        <p>costo
          <input type="text" name="costo" value="<?php echo $modifica->costo; ?>">
        </p>
        <p>
        	<input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $_GET['barcode']; ?>">
          <input type="submit" name="aggiorna" onclick="return confirm('Sei sicuro di modificare?')" value="MODIFICA">
        </p>
      </form>
    </div>
  </div>
</section>
</body>
</html>
<?php } ?>