<?php
include_once 'functions.php';
include CLASMOD.'Scheda.php';
include CLASMOD.'Cliente.php';
include CLASMOD.'Dipendente.php';
include CLASMOD.'Fornitore.php';
include CLASMOD.'Trattamento.php';
include CLASMOD.'Movimento.php';
include CLASMOD.'Prodotto.php';
include CLASMOD.'User.php';
include 'applicazioni/check_login.php';
session_start();
$schede = new DB_con();
$details = $_GET['details'];
switch ($details) {
  case 'scheda':
    $scheda = new Scheda($_GET['id']);

    if(isset($_POST['pagata'])) {
      $scheda_upd = new Scheda();
      $saldata = $scheda_upd->scheda_saldata($scheda->id);
      //var_dump($saldata);exit();
       header('location:schede_clienti.php?messaggio=Scheda Saldata');
     }
    if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
    include_once(LAYOUT.'pretitle.php');
    ?>

    <title>Dettaglio Scheda Cliente n° <?php echo $_GET['id']; ?></title>
    <?php include_once(LAYOUT.'header.php'); ?>
    <header>
      <div class="continer">
        <div class="row">
          <div class="col-xs-12">
            <h1 class="text-center">Dettaglio Scheda Cliente n° <?php echo $_GET['id']; ?></h1>
          </div>
        </div>
      </div>
    </header>
    <section id="bodydetails">
      <div class="container">
        <div class="row margintop30">
          <div class="col-xs-12 col-sm-9">
            <label>Scheda n° <?php echo $_GET['id']; ?> del <?php $time = strtotime($scheda->data);
    $data = date('d/m/Y',$time); echo $data; ?> - <span class="maiuscolo"><?php if ($scheda->pagato=='si'){echo 'Pagata';} else { echo 'Non Pagata';}?></span></label>
          </div>
          <?php if ($scheda->pagato=='no'){ ?>
          <div class="col-xs-12 col-sm-3">
            <form method="post" action=" <?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
              <input type="submit" name="pagata" value="Saldata" class="col-xs-12">
            </form>
          </div>
          <?php } ?>
        </div>
        <div class="row margintop30 bordered">
          <div class="col-xs-12 col-sm-6">
            <label>Cliente:</label>
            <p><?php $id_cliente = $scheda->id_cliente;
                  $info_cliente = new Cliente($id_cliente);
                  echo $info_cliente->cognome.' '.$info_cliente->nome; ?></p>
          </div>
          <div class="col-xs-12 col-sm-3">
            <label>Tessera:</label>
            <p><?php echo $scheda->card; ?></p>
          </div>
          <div class="col-xs-12 col-sm-3">
            <label>Operatrice:</label>
            <p><?php //echo $scheda->operatrice; ?>
              <?php $id_operatrice = $scheda->operatrice; 
                    $dipendente = new Dipendente($id_operatrice); 
                    echo $dipendente->operatrice;
              ?>
            </p>
          </div>
        </div>
        <div class="row margintop30">
          <div class="col-xs-12 bordered">
          <label>Trattamento eseguito:</label>
            <p><?php echo nl2br($scheda->trattamento);
                 // $info_trattamento = new Trattamento($id_trattamento);
                  //echo $info_trattamento->nome.' - '.$info_trattamento->descrizione; ?></p>
          </div>
        </div>
        <div class="row margintop30">
          <div class="col-xs-12 bordered">
          <label>Prodotti venduti:</label>
            <p><?php echo nl2br($scheda->barcode); ?></p>
          </div>
        </div>
        <div class="row margintop30">
          <div class="col-xs-12 col-sm-9 bordered">
          <label>Note:</label>
            <p><?php echo nl2br($scheda->note); ?></p>
          </div>
          <div class="col-xs-12 col-sm-3 text-right">
          <label>Prezzo:</label>
            <p><?php echo $scheda->prezzo_tratt; ?></p>
          </div>
        </div>
         <div class="table-responsive">
        </div>
    </section>

    <?php 
    include_once(LAYOUT.'footer.php');
    } else {
       echo 'Non sei autorizzato';
        echo '<small>
              <a href="applicazioni/logout.php">Disconnetti</a>
            </small>';
    }
  break;
  case 'cliente':
    $cliente = new Cliente($_GET['id']);

    if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
    include_once(LAYOUT.'pretitle.php');
    ?>

    <title>Dettaglio Cliente</title>
    <?php include_once(LAYOUT.'header.php'); ?>
    <header>
      <div class="continer">
        <div class="row">
          <div class="col-xs-12">
            <h1 class="text-center">Dettaglio Cliente</h1>
          </div>
        </div>
      </div>
    </header>
    <section id="bodydetails">
      <div class="container">
        <div class="row margintop30 bordered">
          <div class="col-xs-12 col-sm-9">
            <label>Cognome Nome</label>
            <p><?php echo $cliente->cognome.' '.$cliente->nome; ?></p>
          </div>
          <div class="col-xs-12 col-sm-3">
            <label>Tessera</label>
            <p><?php echo $cliente->card; ?></p>
          </div>
        </div>
        <div class="row margintop30 bordered">
          <h3>Dati Anagrafici</h3>
          <div class="col-xs-12 col-sm-6">
            <label>Residente in</label>
            <p><?php echo $cliente->indirizzo; ?><br>
            <?php echo $cliente->citta; ?> -  <?php echo $cliente->provincia; ?><br>
             <?php echo $cliente->cap; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Nato/a il:</label>
            <p><?php $time = strtotime($cliente->data_nascita);
    $data = date('d/m/Y',$time); echo $data; ?></p>
          </div>
        </div>
        <div class="row margintop30 bordered">
          <h3>Informazioni di contatto</h3>
          <div class="col-xs-12 col-sm-6">
            <label>Telefono</label>
            <p> <?php echo $cliente->telefono; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Altro telefono</label>
            <p> <?php echo $cliente->telefono2; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Cellulare</label>
            <p> <?php echo $cliente->cellulare; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Indirizzo Email</label>
            <p> <?php echo $cliente->mail; ?></p>
          </div>
        </div>
        <div class="row margintop30 bordered">
          <h3>Dati fiscali</h3>
          <div class="col-xs-12 col-sm-6">
            <label>Partita Iva</label>
            <p> <?php echo $cliente->partitaiva; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Codice Fiscale</label>
            <p> <?php echo $cliente->codicefiscale; ?></p>
          </div>
        </div>
        <div class="row margintop30 bordered">
          <h3>Trattamenti eseguiti:</h3>
          <div class="col-xs-12">
            <div class="table-responsive">
              <table class="table table-hover">
                <tr>
                <th colspan="5"></th>
                </tr>
                <tr>
                <th>N.</th>
                <th>Data</th>
                <th>Operatrice</th>
                <th>Prezzo</th>
                <th>Note</th>
                <th></th>
                </tr>
                <?php
                $scheda = new Scheda();
                if ($sitratt = $scheda->tratt_by_client($cliente->id)) {
                  //var_dump($sitratt); exit();
                   while($scheda_cliente = $sitratt->fetch_object())
                   {  //print_r($scheda_cliente);
                     ?>
                    <tr>
                      <td><?php echo $scheda_cliente->id; ?></td>
                     
                      <td><?php echo $scheda_cliente->data; ?></td>
                      <td><?php $id_operatrice = $scheda_cliente->operatrice; 
                            $dipendente = new Dipendente($id_operatrice); 
                            echo $dipendente->operatrice;
                      ?></td>
                      <td><?php if ($scheda_cliente->pagato=='si'){echo 'Pagata';} else { echo 'Non Pagata';} ?></td>
                      <td><?php echo $scheda_cliente->note; ?></td>
                      <td class="text-center"><a href="details.php?details=scheda&id=<?php echo $scheda_cliente->id;?>"><i class="fa fa-file-text-o"></i></a></td>
                    </tr>
                      <?php
                   }
                  } else {
                    echo 'non ci sono schede per questo cliente';
                  }
                  
                 ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php 
    include_once(LAYOUT.'footer.php');
    } else {
       echo 'Non sei autorizzato';
        echo '<small>
              <a href="applicazioni/logout.php">Disconnetti</a>
            </small>';
    }
  break;
  case 'dipendente':
    $dipendente = new Dipendente($_GET['id']);
    //print_r($dipendente); exit();
    if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
      include_once(LAYOUT.'pretitle.php');
      ?>

      <title>Dettaglio Dipendente</title>
      <?php include_once(LAYOUT.'header.php'); ?>
      <header>
        <div class="continer">
          <div class="row">
            <div class="col-xs-12">
              <h1 class="text-center">Dettaglio Dipendente</h1>
            </div>
          </div>
        </div>
      </header>
      <section id="bodydetails">
        <div class="container">
          <div class="row margintop30 bordered">
            <h3>Dati Anagrafici</h3>
            <div class="col-xs-12">
              <label>Cognome Nome</label>
              <p><?php echo $dipendente->cognome.' '.$dipendente->nome; ?></p>
            </div>
            <div class="col-xs-12 col-sm-6">
              <label>Residente in</label>
              <p><?php echo $dipendente->indirizzo; ?><br>
              <?php echo $dipendente->citta; ?> -  <?php echo $dipendente->provincia; ?><br>
               <?php echo $dipendente->cap; ?></p>
            </div>
            <div class="col-xs-12 col-sm-6">
              <label>Nato/a il:</label>
              <p><?php $time = strtotime($dipendente->data_nascita);
              $data = date('d/m/Y',$time); echo $data; ?></p>
            </div>
          </div>
          <div class="row margintop30 bordered">
            <h3>Informazioni di contatto</h3>
            <div class="col-xs-12 col-sm-4">
              <label>Telefono</label>
              <p> <?php echo $dipendente->telefono; ?></p>
            </div>
            <div class="col-xs-12 col-sm-4">
              <label>Cellulare</label>
              <p> <?php echo $dipendente->cellulare; ?></p>
            </div>
            <div class="col-xs-12 col-sm-4">
              <label>Indirizzo Email</label>
              <p> <?php echo $dipendente->mail; ?></p>
            </div>
          </div>
          <div class="row margintop30 bordered">
            <h3>Dati fiscali</h3>
            <div class="col-xs-12 col-sm-4">
              <label>Partita Iva</label>
              <p> <?php echo $dipendente->partitaiva; ?></p>
            </div>
            <div class="col-xs-12 col-sm-4">
              <label>Codice Fiscale</label>
              <p> <?php echo $dipendente->codicefiscale; ?></p>
            </div>
            <div class="col-xs-12 col-sm-4">
              <label>Iban</label>
              <p> <?php echo $dipendente->iban; ?></p>
            </div>
          </div>
          <div class="row margintop30 bordered">
            <div class="col-xs-12 col-sm-6">
              <label>Operatrice</label>
              <p> <?php echo $dipendente->operatrice; ?></p>
            </div>
            <div class="col-xs-12 col-sm-6">
              <label>Username</label>
              <p> <?php //echo $dipendente->id_utente.' - '.$dipendente->id_utente; exit();
              if ( $dipendente->idutente != '0' ) {
                  $User = new User($dipendente->idutente);
                   echo $User->username;
                   } ?></p>
            </div>
          </div>
        </div>
      </section>

      <?php 
      include_once(LAYOUT.'footer.php');
    } else {
       echo 'Non sei autorizzato';
        echo '<small>
              <a href="applicazioni/logout.php">Disconnetti</a>
            </small>';
    }
  break;
  case 'fornitore':
    $fornitore = new Fornitore($_GET['id']);
    if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
    include_once(LAYOUT.'pretitle.php');
    ?>

    <title>Dettaglio Fornitore</title>
    <?php include_once(LAYOUT.'header.php'); ?>
    <header>
      <div class="continer">
        <div class="row">
          <div class="col-xs-12">
            <h1 class="text-center">Dettaglio Fornitore</h1>
          </div>
        </div>
      </div>
    </header>
    <section id="bodydetails">      
      <div class="container">
        <div class="row margintop30 bordered">
        <h2>Anagrafica</h2>
          <div class="col-xs-12 col-sm-6">
            <label>Ragione Sociale</label>
            <p><?php echo $fornitore->denominazione;?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Indirizzo</label>
            <p><?php echo $fornitore->indirizzo; ?><br>
            <?php echo $fornitore->citta; ?> -  <?php echo $fornitore->provincia; ?><br>
             <?php echo $fornitore->cap; ?></p>
          </div>
        </div>
        <div class="row margintop30 bordered">
          <h3>Informazioni di contatto</h3>
          <div class="col-xs-12 col-sm-6">
            <label>Telefono</label>
            <p> <?php echo $fornitore->telefono; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Fax</label>
            <p> <?php echo $fornitore->telefono2; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Cellulare</label>
            <p> <?php echo $fornitore->cellulare; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Indirizzo Email</label>
            <p> <?php echo $fornitore->mail; ?></p>
          </div>
        </div>
        <div class="row margintop30 bordered">
          <h3>Dati fiscali</h3>
          <div class="col-xs-12 col-sm-6">
            <label>Partita Iva</label>
            <p> <?php echo $fornitore->partitaiva; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Codice Fiscale</label>
            <p> <?php echo $fornitore->codicefiscale; ?></p>
          </div>
          <div class="col-xs-12">
            <label>IBAN</label>
            <p> <?php echo $fornitore->iban; ?></p>
          </div>
        </div>
        <div class="row margintop30 bordered">
          <h3>Sito ed eventuali note</h3>
          <div class="col-xs-12">
            <label>Sito Web</label>
            <p> <?php echo $fornitore->sito; ?></p>
          </div>
          <div class="col-xs-12">
            <label>Note</label>
            <p> <?php echo nl2br($fornitore->note); ?></p>
          </div>
        </div>
      </div>
    </section>

    <?php 
    include_once(LAYOUT.'footer.php');
    } else {
       echo 'Non sei autorizzato';
        echo '<small>
              <a href="applicazioni/logout.php">Disconnetti</a>
            </small>';
    }
  break;
  case 'trattamenti':
    $scheda = new Scheda();
    if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
    include_once(LAYOUT.'pretitle.php');
    ?>

    <title>Schede Cliente</title>
    <?php include_once(LAYOUT.'header.php'); ?>
    <header>
      <div class="continer">
        <div class="row">
          <div class="col-xs-12">
            <h1 class="text-center">Schede Cliente</h1>
          </div>
        </div>
      </div>
    </header>
    <section id="body">
      
    <div class="container">
     <div class="table-responsive">
      <table class="table table-hover">
        <tr>
        <th colspan="5"></th>
        </tr>
        <tr>
        <th>N.</th>
        <th>Cliente</th>
        <th>Card</th>
        <th>Data</th>
        <th>Operatrice</th>
        <th>Prezzo</th>
        <th>Note</th>
        <th></th>
        <th></th>
        </tr>
        <?php
        if ($sitratt = $scheda->tratt_by_client($_GET['cliente'])) {
          //var_dump($sitratt); exit();
           while($scheda_cliente = $sitratt->fetch_object())
           {  //print_r($scheda_cliente);
             ?>
              <tr>
              <td><?php echo $scheda_cliente->id; ?></td>
              <td><?php //echo $scheda->id_cliente;
              $id_cliente = $scheda_cliente->id_cliente;
              $info_cliente = new Cliente($id_cliente);
              echo $info_cliente->cognome.' '.$info_cliente->nome;
               ?></td>
              <td><?php echo $scheda_cliente->card; ?></td>
              <td><?php echo $scheda_cliente->data; ?></td>
              <td><?php $id_operatrice = $scheda_cliente->operatrice; 
                    $dipendente = new Dipendente($id_operatrice); 
                    echo $dipendente->operatrice;
              ?></td>
              <td><?php if ($scheda_cliente->pagato=='si'){echo 'Pagata';} else { echo 'Non Pagata';} ?></td>
              <td><?php echo $scheda_cliente->note; ?></td>
              <td class="text-center"><a href="details.php?details=scheda&id=<?php echo $scheda_cliente->id;?>"><i class="fa fa-file-text-o"></i></a></td>
              <?php 
              if ($_SESSION['livello']=='suxuser') { ?>
              <td><a href="<?php echo SCHEDE; ?>mod_scheda.php?id_scheda=<?php echo $scheda_cliente->id;?>"><i class="fa fa-edit"></i></a></td>
              <td><a href="?id_schedacliente_Cancella=<?php echo $scheda_cliente->id;?>" class="red" onclick="return confirm('Sei sicuro di voler cancellare?')"><i class="fa fa-times-circle"></i></a></td>
              <?php } ?>
              </tr>
              <?php
           }
          } else {
            echo 'non ci sono schede per questo cliente';
          }
          
         ?>
        </table>
      </div>
    </div>
    </section>

    <?php 
    include_once(LAYOUT.'footer.php');
    } else {
       echo 'Non sei autorizzato';
        echo '<small>
              <a href="applicazioni/logout.php">Disconnetti</a>
            </small>';
    }
  break;
  case 'prodotto' :
    $prodotto = new Prodotto($_GET['id']);

    if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
    include_once(LAYOUT.'pretitle.php');
    ?>

    <title>Dettaglio Prodotto</title>
    <?php include_once(LAYOUT.'header.php'); ?>
    <header>
      <div class="continer">
        <div class="row">
          <div class="col-xs-12">
            <h1 class="text-center">Dettaglio Prodotto</h1>
          </div>
        </div>
      </div>
    </header>
    <section id="bodydetails">
      <div class="container">
        <div class="row margintop30 bordered">
          <div class="col-xs-12 col-sm-6">
            <label>Nome Prodotto</label>
            <p><?php echo $prodotto->nome; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Barcode</label>
            <p><?php echo $prodotto->barcode; ?></p>
          </div>
        </div>
        <div class="row margintop30 bordered">
          <div class="col-xs-12 col-sm-6">
            <label>Marca</label>
            <p><?php echo $prodotto->marca; ?></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <label>Categoria</label>
            <p><?php echo $prodotto->categoria; ?></p>
          </div>
        </div>
        <div class="row margintop30 bordered">
          <div class="col-xs-12 col-sm-4">
            <label>Prezzo medio</label>
            <p><?php $prezzo_quantita = new Movimento();
                    $prezzo_medio = $prezzo_quantita->prezzo_medio_prodotto( $prodotto->barcode );
                    echo '&euro; '.number_format((float)$prezzo_medio, 2, '.', ''); ?></p>
          </div>
          <div class="col-xs-12 col-sm-4">
            <label>Quantità in magazzino</label>
            <p><?php $quantita_prodotto = $prezzo_quantita->quantita_prodotto( $prodotto->barcode );
                    if ($quantita_prodotto<=$dati_prodotto->scortaminima) {
                      echo '<span class="red">'.$quantita_prodotto.'</span>';
                    } else {
                      echo $quantita_prodotto; 
                    } ?></p>
          </div>
          <div class="col-xs-12 col-sm-4">
            <label>Scorta Minima</label>
            <p><?php echo $prodotto->scorta_minima; ?></p>
          </div>
        </div>
      </div>
     </section>

    <?php 
    include_once(LAYOUT.'footer.php');
    } else {
       echo 'Non sei autorizzato';
        echo '<small>
              <a href="applicazioni/logout.php">Disconnetti</a>
            </small>';
    }
  break;

}


 ?>
