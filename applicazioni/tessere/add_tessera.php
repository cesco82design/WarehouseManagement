<?php 
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Tessera.php';
include CLASMOD.'Clienti.php';
$add_tessera = new Tessera();
if (isset($_POST['btn-save'])) {
	$id = $add_tessera->pulisci_stringa($_POST['barcode']);
	if ($_GET['id_cliente']!='') {
		$id_cliente = $_GET['id_cliente'];
	} else {
		$id_cliente = $add_tessera->pulisci_stringa($_POST['id_client']);
	}
  $data_attiv = $_POST ['data_attiv'];
  $time = strtotime($data_attiv);
  $data_attivazione = date('Y-m-d',$time);
  $attiva = $_POST['attiva'];
$tessera = Tessera::insert_tessera($id,$id_cliente,$data_attivazione,$attiva);
 if ($tessera) {
    $update_cliente = $add_tessera->aggiorna_associazione($id,$id_cliente);
    header('location:../../card.php?messaggio=Tessera aggiunta correttamente');
  } else {
    header('location:?messaggio=c\'è un errore nell\'inserimento della Tessera');
  }
  /*var_dump($user);
  exit();
  header('location:../../dipendenti.php?messaggio=utente aggiunto correttamente');*/
} else {
// data insert code ends here.
  if ($_SESSION['livello']!='suxuser') {
    header('location:'.PATH.'?alert=danger&messaggio=non hai i permessi per aggiungere altri dipendenti');
    exit();
  }
include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento nuova Tessera</title>

<?php include_once(LAYOUT.'header.php'); ?>

<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento nuova Tessera</h1>
      </div>
    </div>
  </div>
</header>
<section id="body">
    <div class="container">
        <div class="row">   
            <div class="col-xs-12 col-md-4 col-md-offset-4 text-center">
              
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
        <div class="row">
          <div class="col-xs-12 col-md-10 col-md-offset-1">
            <div id="content">
                <form method="post" class="add_dipendente">
                  <div class="first_block">
                    <div class="col-xs-12 col-sm-6">
                        <label for="barcode">Codice <small>(<?php 
                          $connection = new Db_con();
                          $id_card=$connection->last_card_id();
                          $last_id = $id_card->fetch_object();
                          echo $last_id->maxid; 
                          ?>)</small></label>
                        <input type="text" name="barcode" class="barcode_input" placeholder="Codice Tessera" required />
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formgroup">
                          <label for="data_attiv">Attivazione:</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="datatrattamento" placeholder="Seleziona la data di attivazione" name="data_attiv" />
                          </div> 
                        </div> 
                    </div>
                    <?php if ($_GET['id_cliente']=='') { ?>
                      <div class="col-xs-12 col-sm-6">
                        <label for="id_client">Associa al cliente:</label>
                        <select name="id_client"  class="col-xs-12">
                          <option value="">Selezionare</option>
                          <?php
                            if  ($res=$add_tessera->select_clienti()) {
                              while($cliente = $res->fetch_object())
                              {
                              echo '<option value="'.$cliente->id.'">'.$cliente->cognome.' '.$cliente->nome.'</option>';
                              }
                            }
                           ?>
                        </select>
                      </div>
                    <?php } ?>
                    <div class="col-xs-12 col-sm-6">
                    	<label for="attiva">Stato:</label>
		                  <select name="attiva" required class="col-xs-12">
		                    <option value="">Selezionare</option>
		                    <option value="si">Attiva</option>
		                    <option value="no">Non Attiva</option>
	                    </select>
                    </div>
                  </div>
                  <div class="endform">
                    <button type="submit" name="btn-save" class="btn-save margintop30"><strong>Aggiungi</strong></button>
                  </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</section>

<?php include_once(LAYOUT.'footer.php'); ?>
<?php } 
?>