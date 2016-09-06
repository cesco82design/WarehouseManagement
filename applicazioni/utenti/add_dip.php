<?php
session_start();
include_once('../../functions.php');
  include CLASMOD.'User.php';
$adddipendente = new User();

// data insert code starts here.
if(isset($_POST['btn-save'])) {

  $nome = $adddipendente->pulisci_stringa($_POST['nome']);
  $cognome = $adddipendente->pulisci_stringa($_POST['cognome']);
  $indirizzo = $adddipendente->pulisci_stringa($_POST['indirizzo']);
  $citta = $adddipendente->pulisci_stringa($_POST['citta']);
  $provincia = $adddipendente->pulisci_stringa($_POST['provincia']);
  $cap = $adddipendente->pulisci_stringa($_POST['cap']);
  $data_nascita = $_POST ['data_nascita'];
  $telefono = $adddipendente->pulisci_stringa($_POST['telefono']);
  $cellulare = $adddipendente->pulisci_stringa($_POST['cellulare']);
  $mail = $adddipendente->validate_email($_POST['mail']);
  $partitaiva = $adddipendente->pulisci_stringa($_POST['partitaiva']);
  $codicefiscale = $adddipendente->pulisci_stringa($_POST['codicefiscale']);
  $operatrice = $adddipendente->pulisci_stringa($_POST['operatrice']);
  $registrare = $_POST ['registrare'];
  $username = $adddipendente->pulisci_stringa($_POST['username']);
  $password = $_POST ['password'];
 //echo $nomeutente.' - '.$user.' - '.$password.' - '.$livello;
 
 $dipendente = User::insert_dipendente($nome,$cognome,$indirizzo,$citta,$provincia,$cap,$data_nascita,$telefono,$cellulare,$mail,$partitaiva,$codicefiscale,$registrare,$username,$password);
 /*var_dump($utente);
 exit();*/
 if($utente) {
    header('location:../../lista_utenti.php?messaggio=utente aggiunto correttamente');
  } else {
    header('location:?messaggio=c\'è un errore nell\'inserimento del dipendente');
  }
} else {
// data insert code ends here.
  if ($_SESSION['livello']!='suxuser') {
    header('location:'.PATH.'?alert=danger&messaggio=non hai i permessi per aggiungere altri dipendenti');
    exit();
  }
include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento del dipendente</title>

<?php include_once(LAYOUT.'header.php'); ?>

<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento del dipendente</h1>
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
        <div id="content">
            <form method="post" class="add_dipendente">
              <div class="first_block">
                <div class="col-xs-12 col-sm-6">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" placeholder="Nome Dipendente" required />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="cognome">Cognome</label>
                    <input type="text" name="cognome" placeholder="Cognome Dipendente" required />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="indirizzo">Indirizzo</label>
                    <input type="text" name="indirizzo" value="Indirizzo"  required/>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="citta">Città</label>
                    <input type="text" name="citta" value="Città"  required/>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="provincia">Provincia</label>
                    <input type="text" name="provincia" value="Provincia"  required/>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="cap">CAP</label>
                    <input type="text" name="cap" value="CAP" maxlength="5"  required/>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="formgroup">
                      <label for="data_nascita">Giorno:</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="datepicker" placeholder="Seleziona la data di nascita" name="data_nascita" />
                      </div> 
                    </div> 
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" value="Telefono"  />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="cellulare">Cellulare</label>
                    <input type="text" name="cellulare" value="Cellulare"  required/>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="mail">Mail</label>
                    <input type="text" name="mail" value="Mail"  required/>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="partitaiva">Partita Iva</label>
                    <input type="text" name="partitaiva" value="Partita Iva" required/>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="codicefiscale">Codice Fiscale</label>
                    <input type="text" name="codicefiscale" value="Codice Fiscale"  />
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label for="operatrice">Operatrice</label>
                    <input type="text" name="operatrice" value="Operatrice"  />
                </div>
                <div class="col-xs-12 col-sm-6" style="margin-top:30px;"">
                  <div class="col-xs-12 col-sm-6" style="margin-top:6px;">
                      <p>Vuoi Creare un utente per questo dipendente?</p>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                      <input type="checkbox" name="registrare" id="reg_dipendente"  />
                  </div>
                </div>
                <div class="reg_mi col-xs-12 bordered">
                  <div class="col-xs-12 col-sm-6">
                      <label for="username">Username</label>
                      <input type="text" name="username" placeholder="Username" required />
                  </div>
                  <div class="col-xs-12 col-sm-6">
                      <label for="password">Password</label>
                      <input type="text" name="password" placeholder="Password" required />
                  </div>              
                </div>
              </div>
              <div class="endform">
                <button type="submit" name="btn-save" class="btn-save margintop30"><strong>Aggiungi</strong></button>
              </div>
            </form>
        </div>
    </div>
</section>

<?php include_once(LAYOUT.'footer.php'); ?>
<?php } ?>