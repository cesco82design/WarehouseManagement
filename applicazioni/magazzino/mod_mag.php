<?php
	//session_start();

include_once '../check_login.php';
  include_once('../../functions.php');
include CLASMOD.'Prodotto.php';
$modifica = new Prodotto($_GET['barcode']);
//var_dump($modifica);
if(isset($_POST['aggiorna'])) {

  $barcode=$modifica->pulisci_stringa($_POST['barcode']);
  $newnome = $modifica->pulisci_stringa($_POST['nome']);
  $newmarca = $_POST['marca'];
  $newcategoria = $_POST['categoria'];
  $newsottoscorta = $modifica->pulisci_stringa($_POST['sottoscorta']);

 
  $res=Prodotto::aggiorna_prodotto($_GET['barcode'],$barcode,$newnome,$newmarca,$newcategoria,$newsottoscorta);
  if($res) {
       header('location:?messaggio=Prodotto modificato correttamente');
  } else {
    header('location:?alert=danger&messaggio=c\'è un errore nella modifica del Prodotto');
  }/*
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
  }*/
} else {
include_once(LAYOUT.'pretitle.php'); ?>

<title>Modifica Prodotto</title>

<?php include_once(LAYOUT.'header.php'); ?>

<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Modifica Prodotto <?php echo $modifica->nome;?></h1>
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
<section class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      <form name="form1" method="post">
        <div class="col-xs-12 col-sm-6">
            <label for="barcode">Barcode</label>
            <input type="text" name="barcode" class="barcode_input" value="<?php echo $modifica->barcode; ?>">
        </div>
        <div class="col-xs-12 col-sm-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php echo $modifica->nome; ?>">
        </div>
        <div class="col-xs-12 col-sm-6">
            <label for="marca">Marca Prodotto</label>
            <select name="marca" required class="col-xs-9">
                <option value="<?php echo $modifica->marca; ?>"><?php echo $modifica->marca; ?></option>
                <option disabled>-------------</option>
                <?php if  ($res=$modifica->select_brand()) {
                           while($marca = $res->fetch_object())
                           {
                             ?>
                            <option value="<?php echo $marca->nome; ?>"><?php echo $marca->nome; ?></option>
                    <?php } 
                        } ?>
            </select>
            <a href="add_marca.php" class="addfield col-xs-1 col-xs-offset-1" title="Aggiungi una nuova marca"><i class="fa fa-plus"></i></a>
      
        </div>
        <div class="col-xs-12 col-sm-6">
            <label for="categoria">Categoria Prodotto</label>
            <select name="categoria" required class="col-xs-9">
                <option value="<?php echo $modifica->categoria; ?>"><?php echo $modifica->categoria; ?></option>
                <option disabled>-------------</option>
                <?php if  ($res=$modifica->select_categorie()) {
                           while($categoria = $res->fetch_object())
                           {
                             ?>
                            <option value="<?php echo $categoria->nome; ?>"><?php echo $categoria->nome; ?></option>
                    <?php } 
                        } ?>
            </select>
            <a href="add_cat.php" class="addfield col-xs-1 col-xs-offset-1" title="Aggiungi una nuova categoria"><i class="fa fa-plus"></i></a>
      
        </div>
        <div class="col-xs-12 col-sm-6">
          <label for="sottoscorta">Sottoscorta</label>
          <input type="text" name="sottoscorta" value="<?php echo $modifica->scorta_minima; ?>" />
        </div>
        <div class="col-xs-12 margintop30">
        	<input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $_GET['barcode']; ?>">
          <input type="submit" name="aggiorna" class="btn-save" onclick="return confirm('Sei sicuro di modificare?')" value="MODIFICA">
        </div>
      </form>
    </div>
  </div>
</section>
<?php include_once(LAYOUT.'footer.php'); ?>
<?php } ?>