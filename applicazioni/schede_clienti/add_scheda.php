<?php 
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include CLASMOD.'Scheda.php';
include CLASMOD.'Tessera.php';
include CLASMOD.'Cliente.php';
include CLASMOD.'Prodotto.php';
include CLASMOD.'Dipendente.php';
include CLASMOD.'Trattamento.php';
$add_scheda = new Scheda();
$prodotto = new Prodotto();
$dipendente = new Dipendente();
$conn = new Db_con();
if(isset($_POST['btn-save'])) {
  $add_scheda = $_POST['add_scheda'];
  switch ($add_scheda) {
    case 'cliente':
      $id_cliente = $conn->pulisci_stringa($_POST['id_cliente']);
      $card_cliente = new Cliente($id_cliente);
      $card = $card_cliente->card;
      break;
    
    case 'tessera':
      $card = $conn->pulisci_stringa($_POST['id_card']);
      $cliente_card = new Tessera($card);
      $id_cliente = $cliente_card->id_cliente;
      break;
  }
  $tratt = $_POST['trattamento'];
  switch ($tratt) {
    case 'select':
      //$trattamento = $conn->pulisci_stringa($_POST['trattamentos']);
      $trattamenti = $_POST['trattamentos'];
      $trattamento ='';
        foreach( $trattamenti as $valore)  
         {  
          $info_trattamento = new Trattamento($valore);
          $trattamento.=$valore." - ".$info_trattamento->nome."\r\n";  
         } 
      break;
    case 'textarea':
      $trattamento = $conn->pulisci_stringa($_POST['trattamentom']);
      break;
  }
  $prodotti=$_POST['barcode'];
  $barcode ='';
        foreach( $prodotti as $value)  
         {  
          $res = $prodotto->prod_by_barcode($value);
           while($prod = $res->fetch_object())
              {
                $id_prod = $prod->id;
                $info_prod = new Prodotto($id_prod);
                $barcode.=$value." - ".$info_prod->nome."\r\n"; 
              }          
         } 
  $data_trattamento = $_POST['data_trattamento'];
  $time = strtotime($data_trattamento);
  $data = date('Y-m-d',$time);
  $note = $conn->pulisci_stringa($_POST['note']);
  $prezzo_tratt = $conn->pulisci_stringa($_POST['prezzo_tratt']);
  $operatrice = $_POST['operatrice'];
  $pagato = $_POST['pagato'];
  /*
  echo $id_cliente;
  echo '<br>';
  echo $card;
  echo '<br>';
  echo nl2br($trattamento);
  echo '<br>';
  echo $barcode;
  echo '<br>';
  echo $data;
  echo '<br>';
  echo $prezzo_tratt;
  echo '<br>';
  echo $operatrice;
  echo '<br>';
  echo $pagato;
  exit();*/

$scheda = Scheda::insert_scheda($id_cliente,$card,$trattamento,$barcode,$prezzo_tratt,$data,$pagato,$operatrice,$note);
 if($scheda) {
    header('location:../../schede_clienti.php?messaggio=Scheda Cliente aggiunta correttamente');
  } else {
    header('location:?messaggio=c\'è un errore nell\'inserimento della Scheda Cliente');
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

<title>Inserimento nuova Scheda Cliente</title>

<?php include_once(LAYOUT.'header.php'); ?>

<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento nuova Scheda Cliente</h1>
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
                      <div class="radio">
                       <input type="radio" id="radio01" name="add_scheda" value="cliente" checked />
                       <label for="radio01"><span></span>cerca per cliente</label>
                      </div>
                      <div class="radio">
                       <input type="radio" id="radio02" name="add_scheda" value="tessera"/>
                       <label for="radio02"><span></span>cerca per tessera</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                      <div class="col-xs-12" id="cliente">
                        <select name="id_cliente" class="cliente col-xs-12">
                         <option value="">Cliente:</option>
                          <?php if  ($res=$conn->select('clienti')) {
                            while($cliente = $res->fetch_object())
                            {
                            echo '<option value="'.$cliente->id.'">'.$cliente->cognome.' '.$cliente->nome.'</option>';
                            }
                          } ?>
                       </select>
                      </div>
                      <div class="col-xs-12" id="card">
                        <select name="id_card" class="card col-xs-12">
                         <option value="">Tessera:</option>
                          <?php if  ($res=$conn->select('card')) {
                            while($card = $res->fetch_object())
                            {

                              $info_cliente = new Cliente($card->id_cliente);
                            echo '<option value="'.$card->id.'">'.$card->id.' - '.$info_cliente->cognome.' '.$info_cliente->nome.'</option>';
                            }
                          } ?>
                       </select>
                      </div>
                    </div>
                    <div class="col-xs-12 text-center margintop30">
                      <label>Scegli come inserire il trattamento</label>
                      <div class="radio">
                       <input type="radio" id="radio03" name="trattamento" value="select" checked />
                       <label for="radio03"><span></span>Seleziona</label>
                      </div>
                      <div class="radio">
                       <input type="radio" id="radio04" name="trattamento" value="textarea"/>
                       <label for="radio04"><span></span>Inserimento manuale</label>
                      </div>
                    </div>
                    <div class="col-xs-12" id="trattamentos">
                      <select name="trattamentos[]" class="col-xs-12 selectpicker" multiple>
                         <option value="">-</option>
                          <?php if  ($res=$conn->select('trattamenti')) {
                            while($trattamento = $res->fetch_object())
                            {
                            echo '<option value="'.$trattamento->id.'">'.$trattamento->nome.'</option>';
                            }
                          } ?>
                       </select>
                    </div>
                    <div class="col-xs-12" id="trattamentom">
                      <textarea name="trattamentom" placeholder="Scrivi qui il trattamento" class="col-xs-12"></textarea>
                    </div>
                    <div class="col-xs-12 text-center margintop30">
                      <label for="barcode">Son stati venduti prodotti</label>
                      <input type="checkbox" name="vendita" value="si" class="prod_input" />
                    </div>
                    <div class="col-xs-12" id="prodotti">
                      <div class="other_input">
                        <div class="col-xs-12 col-sm-6 input_barcode">
                          <input type="text" name="barcode[]" placeholder="Inserisci il barcode del prodotto" class="barcode_input col-xs-12" />
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 text-center">
                        <a href="#" class="more_input" title="Aggiungi una nuova categoria"><i class="fa fa-plus"></i></a>
                      </div> 
                    </div> 
                    <div class="col-xs-12 col-sm-6">
                        <div class="formgroup">
                          <label for="data_trattamento">Data Trattamento:</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="datatrattamento col-xs-12" placeholder="Seleziona la data" name="data_trattamento" />
                          </div> 
                        </div> 
                    </div>
                    <div class="col-xs-12 col-sm-6">
                      <label for="prezzo_tratt">Totale:</label>
                      <input type="text" name="prezzo_tratt" class="col-xs-12" placeholder="Inserisci il costo del trattamento" value="" />
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label for="pagato">Pagato</label>
                      <select name="pagato" required class="col-xs-12">
                        <option value="">Selezionare</option>
                        <option value="si">Pagato</option>
                        <option value="no">Da pagare</option>
                      </select>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label for="operatrice">Operatrice</label>
                      <select name="operatrice" class="col-xs-12">
                        <option value="">Selezionare</option>
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
                      <textarea name="note" placeholder="Eventuali note" class="col-xs-12"></textarea>
                    </div>
                  </div>
                  <div class="endform col-xs-12">
                    <button type="submit" name="btn-save" class="btn-save margintop30 col-xs-12"><strong>Aggiungi</strong></button>
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