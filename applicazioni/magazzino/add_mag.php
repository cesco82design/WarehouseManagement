<?php
include '../../asset/moduli/Prodotto.php';
$addprod = new Prodotto();

if(isset($_POST['btn-save'])) {

 $barcode = $addprod->pulisci_stringa($_POST['barcode']);
 $nome = $addprod->pulisci_stringa($_POST['nome']);
 $prezzo = $addprod->pulisci_stringa($_POST['prezzo']);
 $quantita = $addprod->pulisci_stringa($_POST['quantita']);
 $costo = $addprod->pulisci_stringa($_POST['costo']);

 $prodotto = Prodotto::insert_magazzino($barcode,$nome,$prezzo,$quantita,$costo);

 if($prodotto)   {
  ?>
  <script>
    alert('Prodotto inserito');
    window.location='../../magazzino.php'
  </script>
  <?php
 } else {
  ?>
  <script>
    alert('Errore durante l&rsquo;inserimento del prodotto');
    window.location='../../magazzino.php'
  </script>
  <?php
 }
} else {
// data insert code ends here.

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Inserimento del prodotto in Magazzino</title>
<link rel="stylesheet" href="../../asset/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../../asset/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="../../asset/css/style.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../../asset/js/custom_script.js"></script>
</head>
<body>
<center>

<div id="header">
 <div id="content">
    <label>Inserimento del prodotto in Magazzino</label>
    </div>
</div>
<div id="body">
 <div id="content">
    <form method="post">
    <table align="center">
    <tr>
    <td colspan="2"><input type="text" name="barcode" placeholder="Barcode Prodotto" required /></td>
    </tr>
    <tr>
    <td colspan="2"><input type="text" name="nome" placeholder="Nome Prodotto" required /></td>
    </tr>
    <tr>
    <td colspan="2"><input type="text" name="prezzo" placeholder="Prezzo unitario" required /></td>
    </tr>
    <tr>
    <td colspan="2"><input type="text" name="quantita" placeholder="Quantità" required /></td>
    </tr>
    <tr>
    <td colspan="2"><input type="text" name="costo" placeholder="Costo di Vendita" required /></td>
    </tr>
    <tr>
    <td>
    <button type="submit" name="btn-save"><strong>Aggiungi</strong></button>
    </td>
    <td>
    <button href="../../index.php"><strong>Home</strong></button>
    </td>
    </tr>
    </table>
    </form>
    </div>
</div>

</center>
</body>
</html>
<?php } ?>