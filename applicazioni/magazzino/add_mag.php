<?php
include_once('../../functions.php');
include moduli.'Prodotto.php';
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
    window.location=PATH.'magazzino.php'
  </script>
  <?php
 } else {
  ?>
  <script>
    alert('Errore durante l&rsquo;inserimento del prodotto');
    window.location=PATH.'magazzino.php'
  </script>
  <?php
 }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento del prodotto in Magazzino</title>

<?php include_once(LAYOUT.'header.php'); ?>

<header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>Inserimento del prodotto in Magazzino</h1>
            </div>
        </div>
    </div>
</header>
<section>
 <div class="container">
 <div class="row">
 <div class="col-xs-12 col-md-4 col-md-offset-4">
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
</div>

</section>
<?php include_once(LAYOUT.'footer.php'); ?>
<?php } ?>