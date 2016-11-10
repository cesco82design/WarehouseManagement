<?php
//session_start();
include_once '../check_login.php';
session_start();
include_once('../../functions.php');
include APPL.'check_login.php';
	include CLASMOD.'User.php';
	$modUser = new User($_GET['idUtente']);
//var_dump($modUser);

if(isset($_POST['aggiorna'])) {

  $idUtente         = $modUser->pulisci_stringa($_GET['idUtente']);
  $newnomeutente   = $modUser->pulisci_stringa($_POST['nome']);
  $newuser          = $modUser->pulisci_stringa($_POST['user']);
  
    $password      = $modUser->pulisci_stringa($_POST ['password']);
       
  $newlivello       = $modUser->pulisci_stringa($_POST['livello']);

  //echo $idUtente.','.$newnomeutente.','.$newuser.','.$password.','.$newlivello;
 
  $res=$modUser->aggiorna_utente($idUtente,$newnomeutente,$newuser,$password,$newlivello);
  if($res) {
    header('location:../../lista_utenti.php?messaggio=Utente Modificato correttamente');
  }
  else {
    header('location:../../lista_utenti.php?messaggio=c\'è stato un errore durante la modifica dell\'utente, si prega di effettuare verifiche');
  }
} else {
  
include_once(LAYOUT.'pretitle.php'); ?>

<title>Modifica Utente</title>

<?php include_once(LAYOUT.'header.php'); ?>

<header class="text-center">
  <h1>Modifica Utente <?php echo $modUser->username;?></h1>
</header>
<div class="container">
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
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      <form name="form1" method="post">
        <p>nome
        <input type="text" name="nome" id="nome" required value="<?php echo $modUser->nome; ?>">
        </p>
        <p>user
          <input type="text" name="user" id="user" required value="<?php echo $modUser->username; ?>">
        </p>
        <p>password
          <input type="password" name="password" id="password" required value="<?php echo $modUser->password; ?>" >
        </p>
        <?php 
        if ($_SESSION['livello']=='suxuser') { ?>
        <p>
          <select name="livello" id="livello">
            <option value="<?php echo $modUser->livello; ?>"><?php if ($modUser->livello=='suxuser') : echo 'Supervisor'; else : echo $modUser->livello; endif; ?></option>
            <option value="suxuser">Supervisor</option>
            <option value="dipendente">Dipendente</option>
            <option value="guest">Guest</option>
          </select>
        </p>
        <?php }
        if ($_SESSION['livello']=='dipendnete') {echo '<p><input type="hidden"  name="livello" value="guest" /></p>';} ?>
        <p>
        	<input type="hidden" name="hidden_id" value="<?php echo $_GET['idUtente']; ?>">
          <input type="submit" name="aggiorna" value="MODIFICA" onclick="return confirm('Sei sicuro di modificare?')">
        </p>
      </form>
    </div>
  </div>
</div>

<?php include_once(LAYOUT.'footer.php'); ?>
<?php } ?>