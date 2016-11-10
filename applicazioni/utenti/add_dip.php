<?php
//session_start();
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
  include CLASMOD.'User.php';
  include CLASMOD.'Dipendente.php';
$adddipendente = new Dipendente();
$newUser = new User();
// data insert code starts here.*/
if(isset($_POST['btn-save'])) {

  $nome = $adddipendente->pulisci_stringa($_POST['nome']);
  $cognome = $adddipendente->pulisci_stringa($_POST['cognome']);
  $indirizzo = $adddipendente->pulisci_stringa($_POST['indirizzo']);
  $citta = $adddipendente->pulisci_stringa($_POST['citta']);
  $provincia = $adddipendente->pulisci_stringa($_POST['provincia']);
  $cap = $adddipendente->pulisci_stringa($_POST['cap']);
  $data_nascita = $_POST ['data_nascita'];
  $time = strtotime($data_nascita);
  $newformat = date('Y-m-d',$time);
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
 /*echo $nome;
 exit();*/
  if ($registrare) {
   $user = User::insert_user($nome,$cognome,$username,$password,'dipendente');
  }
  
 $dipendente = Dipendente::insert_dipendente($nome,$cognome,$indirizzo,$citta,$provincia,$cap,$newformat,$telefono,$cellulare,$mail,$partitaiva,$codicefiscale,$operatrice,$registrare);
 /*var_dump($dipendente);
 exit();*/
 if($dipendente) {
    header('location:../../dipendenti.php?messaggio=Dipendente aggiunto correttamente');
  } else {
    header('location:?messaggio=c\'è un errore nell\'inserimento del dipendente');
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
        <div class="row">
          <div class="col-xs-12 col-md-10 col-md-offset-1">
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
                        <input type="text" name="cap" placeholder="CAP" maxlength="5"  required/>
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
                        <input type="text" name="partitaiva" maxlength="11" placeholder="Partita Iva" />
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label for="codicefiscale">Codice Fiscale</label>
                        <input type="text" name="codicefiscale" maxlength="16" placeholder="Codice Fiscale"  />
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label for="operatrice">Operatrice</label>
                        <input type="text" name="operatrice" placeholder="Operatrice"  />
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
                          <input type="text" name="username" placeholder="Username"  />
                      </div>
                      <div class="col-xs-12 col-sm-6">
                          <label for="password">Password</label>
                          <input type="text" name="password" placeholder="Password"  />
                      </div>              
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