<?php 
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Tessera.php';
include CLASMOD.'Cliente.php';
$mod_tessera = new Tessera($_GET['id_tessera']);
$connection = new Db_con();
if(isset($_POST['btn-save'])) {
	$id_cliente = $mod_tessera->pulisci_stringa($_POST['id_client']);
  $data_attiv = $_POST ['data_attiv'];
  $time = strtotime($data_attiv);
  $data_attivazione = date('Y-m-d',$time);
  $data_disattiv = $_POST ['data_disattiv'];
  $time2 = strtotime($data_disattiv);
  $data_disattivazione = date('Y-m-d',$time2);
  $attiva = $_POST['attiva'];
$tessera = Tessera::aggiorna_tessera($_GET['id_tessera'],$id_cliente,$data_attivazione,$data_disattivazione,$attiva);
 if($tessera) {
  $update_cliente = $mod_tessera->aggiorna_associazione($_GET['id_tessera'],$id_cliente);
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

<title>Modifica Tessera</title>

<?php include_once(LAYOUT.'header.php'); ?>

<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Modifica Tessera</h1>
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
                        <div class="formgroup">
                          <label for="data_attiv">Attivazione:</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="datepicker" value="<?php echo $mod_tessera->data_attivazione; ?>" name="data_attiv" />
                          </div> 
                        </div> 
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formgroup">
                          <label for="data_disattiv">Disattivazione:</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="datepicker" value="<?php echo $mod_tessera->data_disattivazione; ?>" name="data_disattiv" />
                          </div> 
                        </div> 
                    </div>
                    <div class="col-xs-12 col-sm-6">
                    	<label for="attiva">Stato:</label>
		                  <select name="attiva" required class="col-xs-12">
                        <option value="<?php echo $mod_tessera->attiva; ?>"><?php if ($mod_tessera->attiva=='si') {echo 'Attiva';} else {echo 'Disattivata';} ?></option>
		                    <option value="" disabled>------------</option>
		                    <option value="si">Attiva</option>
		                    <option value="no">Non Attiva</option>
	                    </select>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label for="id_client">Associa al cliente:</label>
                        <select name="id_client"  class="col-xs-12">
                          <option value=""><?php $id_cliente = $mod_tessera->id_cliente; 
                          if ($id_cliente==''){ 
                            echo 'Seleziona un cliente';
                          } else {
                            $info_cliente = new Cliente($id_cliente);
                            echo $info_cliente->cognome.' '.$info_cliente->nome;
                          } ?></option>
                          <?php
                            if  ($res=$mod_tessera->select_clienti()) {
                              while($cliente = $res->fetch_object())
                              {
                              echo '<option value="'.$cliente->id.'">'.$cliente->cognome.' '.$cliente->nome.'</option>';
                              }
                            }
                           ?>
                        </select>
                      </div>
                  </div>
                  <div class="endform">
                    <button type="submit" name="btn-save" class="btn-save margintop30"><strong>Salva</strong></button>
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