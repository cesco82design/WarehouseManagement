 <?php
//session_start();

include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Prodotto.php';
$addprod = new Prodotto();

if(isset($_POST['btn-save'])) {

 $barcode = $addprod->pulisci_stringa($_POST['barcode']);
 $nome = $addprod->pulisci_stringa($_POST['nome']);
 $marca = $_POST['marca'];
 $categoria = $_POST['categoria'];
 $sottoscorta = $addprod->pulisci_stringa($_POST['sottoscorta']);
/*echo $barcode.' '.$nome.' '.$marca.' '.$categoria.' '.$sottoscorta;
exit();*/
 $prodotto = Prodotto::insert_magazzino($barcode,$nome,$marca,$categoria,$sottoscorta);
 /*var_dump($prodotto);
 exit();*/
 if($prodotto)   {
    header('location:../../magazzino.php?messaggio=Prodotto inserito correttamente');
  } else {
    header('location:../../magazzino.php?alert=danger&messaggio=c\'è un errore nell\'inserimento del prodotto');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento del prodotto in Magazzino</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento del prodotto in Magazzino</h1>
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
                <label for="categoria">Categoria Prodotto</label>
                <select name="categoria" required class="col-xs-9">
                    <option value="">Selezionare</option>
                    <?php if  ($res=$addprod->select_categorie()) {
                               while($cat = $res->fetch_object())
                               {
                                 ?>
                                <option value="<?php echo $cat->nome; ?>"><?php echo $cat->nome; ?></option>
                        <?php } 
                            } ?>
                </select>
                <a href="add_cat.php" class="addfield col-xs-1 col-xs-offset-1" title="Aggiungi una nuova categoria"><i class="fa fa-plus"></i></a>
          
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="barcode">Barcode</label>
                <input type="text"  name="barcode" placeholder="Barcode Prodotto" class="barcode_input" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="nome">Nome Prodotto</label>
                <input type="text" name="nome" placeholder="Nome Prodotto" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="marca">Marca Prodotto</label>
                <select name="marca" required class="col-xs-9">
                    <option value="">Selezionare</option>
                    <?php if  ($res=$addprod->select_brand()) {
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
                <label for="sottoscorta">Sottoscorta</label>
                <input type="number" name="sottoscorta" placeholder="indica una scorta minima" required />
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