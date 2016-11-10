<?php
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Cliente.php';
include CLASMOD.'Tessera.php';
$add_cliente = new Cliente();
 $tessera = new Tessera();
if(isset($_POST['btn-save'])) {
  $nome = $add_cliente->pulisci_stringa($_POST['nome']);
  $cognome = $add_cliente->pulisci_stringa($_POST['cognome']);
  $indirizzo = $add_cliente->pulisci_stringa($_POST['indirizzo']);
  $citta = $add_cliente->pulisci_stringa($_POST['citta']);
  $provincia = $add_cliente->pulisci_stringa($_POST['provincia']);
  $cap = $add_cliente->pulisci_stringa($_POST['cap']);
  $telefono = $add_cliente->pulisci_stringa($_POST['telefono']);
  $data_nascita = $_POST ['data_nascita'];
  $time = strtotime($data_nascita);
  $newformat = date('Y-m-d',$time);
  $cellulare = $add_cliente->pulisci_stringa($_POST['cellulare']);
  $mail = $add_cliente->validate_email($_POST['mail']);
  $partitaiva = $add_cliente->pulisci_stringa($_POST['partitaiva']);
  $codicefiscale = $add_cliente->pulisci_stringa($_POST['codicefiscale']);
  $card = $add_cliente->pulisci_stringa($_POST['card']);

/*echo $nome.' '.$cognome.' '.$indirizzo.' '.$citta.' '.$provincia.' '.$cap.' '.$telefono.' '.$telefono2.' '.$cellulare.' '.$mail.' '.$partitaiva.' '.$codicefiscale;
exit();*/
 $cliente = Cliente::insert_cliente($nome,$cognome,$indirizzo,$citta,$provincia,$cap,$newformat,$telefono,$cellulare,$mail,$partitaiva,$codicefiscale,$card);

 //var_dump($cliente);
 //exit();
 $associazione = $tessera->aggiorna_card_cliente($card);
 /*var_dump($prodotto);
 exit();*/
 if($cliente)   {
    header('location:'.$_SERVER['HTTP_REFERER'].'?messaggio=Dati inseriti correttamente');
  } else {
    header('location:'.$_SERVER['HTTP_REFERER'].'?alert=danger&messaggio=c\'è un errore nell\'inserimento dei dati');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento Nuovo Cliente</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento Nuovo Cliente</h1>
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
              <input type="text" name="nome" placeholder="Nome" required />
            </div>
            <div class="col-xs-12 col-sm-6">
              <label for="cognome">Cognome</label>
              <input type="text" name="cognome" placeholder="Cognome" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="indirizzo">Indirizzo</label>
                <input type="text" name="indirizzo" placeholder="Indirizzo"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="citta">Città</label>
                <input type="text" name="citta" placeholder="Città"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia" placeholder="Provincia"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cap">CAP</label>
                <input type="text" name="cap" placeholder="CAP"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="formgroup">
                  <label for="data_nascita">Giorno:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="datacliente" placeholder="Seleziona la data di nascita" name="data_nascita" />
                  </div> 
                </div> 
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" placeholder="Telefono"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cellulare">Cellulare</label>
                <input type="text" name="cellulare" placeholder="Cellulare"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="mail">Mail</label>
                <input type="text" name="mail" placeholder="Mail"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="partitaiva">Partita Iva</label>
                <input type="text" name="partitaiva" placeholder="Partita Iva"/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="codicefiscale">Codice Fiscale</label>
                <input type="text" name="codicefiscale" placeholder="Codice Fiscale"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="card">Card</label>
                <select name="card" class="col-xs-12">
                    <option value="">Selezionare</option>
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