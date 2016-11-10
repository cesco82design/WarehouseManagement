<?php
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Cliente.php';
include CLASMOD.'Tessera.php';
$mod_cliente = new Cliente($_GET['id_cliente']);

 $tessera = new Tessera();
if(isset($_POST['btn-save'])) {
  $nome = $mod_cliente->pulisci_stringa($_POST['nome']);
  $cognome = $mod_cliente->pulisci_stringa($_POST['cognome']);
  $indirizzo = $mod_cliente->pulisci_stringa($_POST['indirizzo']);
  $citta = $mod_cliente->pulisci_stringa($_POST['citta']);
  $provincia = $mod_cliente->pulisci_stringa($_POST['provincia']);
  $cap = $mod_cliente->pulisci_stringa($_POST['cap']);
  $telefono = $mod_cliente->pulisci_stringa($_POST['telefono']);
  $data_nascita = $_POST ['data_nascita'];
  $time = strtotime($data_nascita);
  $newformat = date('Y-m-d',$time);
  $cellulare = $mod_cliente->pulisci_stringa($_POST['cellulare']);
  $mail = $mod_cliente->validate_email($_POST['mail']);
  $partitaiva = $mod_cliente->pulisci_stringa($_POST['partitaiva']);
  $codicefiscale = $mod_cliente->pulisci_stringa($_POST['codicefiscale']);
  $card = $_POST['card'];

/*echo $nome.' '.$cognome.' '.$indirizzo.' '.$citta.' '.$provincia.' '.$cap.' '.$telefono.' '.$telefono2.' '.$cellulare.' '.$mail.' '.$partitaiva.' '.$codicefiscale;
exit();*/
 $cliente = Cliente::aggiorna_cliente($_GET['id_cliente'],$nome,$cognome,$indirizzo,$citta,$provincia,$cap,$newformat,$telefono,$cellulare,$mail,$partitaiva,$codicefiscale,$card);
 /*var_dump($prodotto);
 exit();*/ 
 $associazione = $tessera->mod_card_cliente($_GET['id_cliente'],$card);
 if($cliente)   {
    header('location:../../clienti.php?messaggio=Dati inseriti correttamente');
  } else {
    header('location:'.$_SERVER['HTTP_REFERER'].'?alert=danger&messaggio=c\'è un errore nell\'inserimento dei dati');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Modifica Cliente</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Modifica Cliente</h1>
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
              <label for="nome">Nome</label>
              <input type="text" name="nome" value="<?php echo $mod_cliente->nome; ?>" required />
            </div>
            <div class="col-xs-12 col-sm-6">
              <label for="cognome">Cognome</label>
              <input type="text" name="cognome" value="<?php echo $mod_cliente->cognome; ?>" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="indirizzo">Indirizzo</label>
                <input type="text" name="indirizzo" value="<?php echo $mod_cliente->indirizzo; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="citta">Città</label>
                <input type="text" name="citta" value="<?php echo $mod_cliente->citta; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia" value="<?php echo $mod_cliente->provincia; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cap">CAP</label>
                <input type="text" name="cap" value="<?php echo $mod_cliente->cap; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="formgroup">
                  <label for="data_nascita">Giorno:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="datacliente" value="<?php echo $mod_cliente->data_nascita; ?>" name="data_nascita" />
                  </div> 
                </div> 
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" value="<?php echo $mod_cliente->telefono; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cellulare">Cellulare</label>
                <input type="text" name="cellulare" value="<?php echo $mod_cliente->cellulare; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="mail">Mail</label>
                <input type="text" name="mail" value="<?php echo $mod_cliente->mail; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="partitaiva">Partita Iva</label>
                <input type="text" name="partitaiva" value="<?php echo $mod_cliente->partitaiva; ?>" />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="codicefiscale">Codice Fiscale</label>
                <input type="text" name="codicefiscale" value="<?php echo $mod_cliente->codicefiscale; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="card">Card</label>
                <select name="card" class="col-xs-12">
                    <option value="<?php echo $mod_cliente->card; ?>"><?php echo $mod_cliente->card; ?></option>
                    <option disabled>----------------</option>
                    <?php
                      if  ($res=$tessera->select_free()) {
                        while($tessera_free = $res->fetch_object())
                        {
                        echo '<option value="'.$tessera_free->id.'">'.$tessera_free->id.'</option>';
                        }
                      }
                     ?>
                 </select>
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