<?php

include '../check_login.php';
	include '../../asset/moduli/User.php';
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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Modifica Utente</title>
<link rel="stylesheet" href="../../asset/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../../asset/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="../../asset/css/style.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../../asset/js/custom_script.js"></script>
</head>

<body>
<header class="text-center">
  <h1>Modifica Utente <?php echo $modUser->user;?></h1>
</header>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
        <?php
            if(isset($_GET['messaggio'])){ ?>
            <div class="messaggio">
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
        <input type="text" name="nome" id="nome" required value="<?php echo $modUser->nomeutente; ?>">
        </p>
        <p>user
          <input type="text" name="user" id="user" required value="<?php echo $modUser->user; ?>">
        </p>
        <p>password
          <input type="password" name="password" id="password" required value="<?php echo $modUser->password; ?>" >
        </p>
        <?php if ($_SESSION['livello']=='suxuser') { ?>
        <p>
          <select name="livello" id="livello">
            <option value="<?php echo $modUser->livello; ?>"><?php echo $modUser->livello; ?></option>
            <option value="suxuser">Admin</option>
            <option value="dipendente">Dipendnete</option>
            <option value="guest">Guest</option>
          </select>
        </p>
        <?php }
        if ($_SESSION['livello']=='dipendnete') {echo '<p><input type="hidden"  name="livello" value="guest" /></p>';} ?>
        <p>
        	<input type="hidden" name="hidden_id" value="<?php echo $_GET['idUtente']; ?>">
          <input type="submit" name="aggiorna" value="MODIFICA">
        </p>
      </form>
    </div>
  </div>
</div>
</body>
</html>
<?php } ?>