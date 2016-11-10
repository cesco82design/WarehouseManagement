<?php 
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Scheda.php';
include CLASMOD.'Tessera.php';
include CLASMOD.'Cliente.php';
include CLASMOD.'Prodotto.php';
include CLASMOD.'Dipendente.php';
$mod_scheda = new Scheda($_GET['id_scheda']);
$prodotto = new Prodotto();
$dipendente = new Dipendente();
$conn = new Db_con();
if(isset($_POST['btn-save'])) {
      $id_cliente = $conn->pulisci_stringa($_POST['id_cliente']);
      $card = $conn->pulisci_stringa($_POST['id_card']);
  $trattamento = $conn->pulisci_stringa($_POST['trattamento']);
  $barcode=$conn->pulisci_stringa($_POST['barcode']);
  $data_trattamento = $_POST['data_trattamento'];
  $time = strtotime($data_trattamento);
  $data = date('Y-m-d',$time);
  $note = $conn->pulisci_stringa($_POST['note']);
  $prezzo_tratt = $conn->pulisci_stringa($_POST['prezzo_tratt']);
  $operatrice = $_POST['operatrice'];
  $pagato = $_POST['pagato'];

$scheda = Scheda::aggiorna_scheda($_GET['id_scheda'],$id_cliente,$card,$trattamento,$barcode,$prezzo_tratt,$data,$pagato,$operatrice,$note);
 if($scheda) {
    header('location:../../schede_clienti.php?messaggio=Scheda Cliente aggiornata correttamente');
  } else {
    header('location:?messaggio=c\'è un errore nell\'aggiornamento della Scheda Cliente');
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

<title>Modifica Scheda Cliente</title>

<?php include_once(LAYOUT.'header.php'); ?>

<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Modifica Scheda Cliente</h1>
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
                <form method="post" class="add_scheda_cliente">
                  <div class="first_block">
                    <div class="col-xs-12 col-sm-6">
                      <label>Cliente:</label>
                        <select name="id_cliente" class="cliente col-xs-12">
                         <option value="<?php echo $mod_scheda->id_cliente; ?>"><?php $id_cliente = $mod_scheda->id_cliente;
              $info_cliente = new Cliente($id_cliente);
              echo $info_cliente->cognome.' '.$info_cliente->nome; ?></option>
                          <?php if  ($res=$conn->select('clienti')) {
                            while($cliente = $res->fetch_object())
                            {
                            echo '<option value="'.$cliente->id.'">'.$cliente->cognome.' '.$cliente->nome.'</option>';
                            }
                          } ?>
                       </select>
                      </div>
                      <div class="col-xs-12 col-sm-6">
                      <label>Tessera:</label>
                        <select name="id_card" class="card col-xs-12">
                         <option value="<?php echo $mod_scheda->card; ?>"><?php echo $mod_scheda->card; ?></option>
                          <?php if  ($res=$conn->select('card')) {
                            while($card = $res->fetch_object())
                            {

                              $info_cliente = new Cliente($card->id_cliente);
                            echo '<option value="'.$card->id.'">'.$card->id.' - '.$info_cliente->cognome.' '.$info_cliente->nome.'</option>';
                            }
                          } ?>
                       </select>
                      </div>
                    <div class="col-xs-12">
                      <textarea name="trattamento" class="col-xs-12"><?php echo nl2br($mod_scheda->trattamento); ?></textarea>
                    </div>
                    <div class="col-xs-12 text-center margintop30">
                      <label for="barcode">Son stati venduti prodotti</label>
                      <input type="checkbox" name="vendita" value="si" class="prod_input" />
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-12 col-sm-6 input_barcode">

                        <textarea name="barcode" class="col-xs-12"><?php echo nl2br($mod_scheda->barcode); ?></textarea>
                        </div>
                      <div class="col-xs-12 col-sm-6 text-center">
                      </div> 
                    </div> 
                    <div class="col-xs-12 col-sm-6">
                        <div class="formgroup">
                          <label for="data_trattamento">Data Trattamento:</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="datatrattamento col-xs-12" value="<?php echo $mod_scheda->data; ?>" name="data_trattamento" />
                          </div> 
                        </div> 
                    </div>
                    <div class="col-xs-12 col-sm-6">
                      <label for="prezzo_tratt">Totale:</label>
                      <input type="text" name="prezzo_tratt" class="col-xs-12" value="<?php echo $mod_scheda->prezzo_tratt; ?>" value="" />
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label for="pagato">Pagato</label>
                      <select name="pagato" required class="col-xs-12">
                        <option value="<?php echo $mod_scheda->pagato; ?>"><?php if ($scheda->pagato=='si'){echo 'Pagata';} else { echo 'Non Pagata';}?></option>
                        <option value="si">Pagato</option>
                        <option value="no">Da pagare</option>
                      </select>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label for="operatrice">Operatrice</label>
                      <select name="operatrice" class="col-xs-12">
                        <option value="<?php echo $mod_scheda->operatrice; ?>"><?php $id_operatrice = $mod_scheda->operatrice; 
                    $dipendente = new Dipendente($id_operatrice); 
                    echo $dipendente->operatrice; ?></option>
                        <?php if  ($res=$dipendente->select_operatrici()) {
                            while($dip = $res->fetch_object())
                            {
                            echo '<option value="'.$dip->id.'">'.$dip->operatrice.'</option>';
                            }
                          } ?>
                      </select>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                      <label for="note">Note</label>
                      <textarea name="note" class="col-xs-12"><?php echo $mod_scheda->note; ?></textarea>
                    </div>
                  </div>
                  <div class="endform col-xs-12">
                    <button type="submit" name="btn-save" class="btn-save margintop30 col-xs-12"><strong>Modifica</strong></button>
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