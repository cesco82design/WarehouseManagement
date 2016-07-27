<?php
include '../../asset/moduli/User.php';
//$conUser = new DB_con();
//$modUser = new User($_GET['idUtente']);
$modUser = new User(6);
$table = "utenti";
if(isset($_POST['btn-save'])) {
   $id = $_GET['idUtente'];
   $nome = $modUser->pulisci_stringa($_POST['nome']);
   $user = $modUser->pulisci_stringa($_POST['user']);
   $password = $modUser->salta_pwd($_POST ['password']);
   $livello = $_POST['livello'];
  $res= $modUser->modifyUser($id,$newnome,$newuser,$newpwd,$newlivello);
  if ($res) {
    echo 'ok';
  } else {
    echo 'ko';
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
<div class="page text-center">
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
<?php
  /*if(isset($_GET['idUtente'])){
    $res=$modUser->select($table);
    $modificautente=$res->fetch_object();
  }*/
?>
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      <form name="form1" method="post">
        <p>nome
        <input type="text" name="nome" id="nome" value="<?php echo $modUser->nome; ?>">
        </p>
        <p>user
          <input type="text" name="user" id="user" value="<?php echo $modUser->user; ?>">
        </p>
        <p>cambia password
          <input type="password" name="password" id="password" value="<?php echo $modUser->password; ?>">
        </p>
        <p>
          <select name="livello" id="livello">
            <option value="<?php echo $modUser->livello; ?>"><?php echo $modUser->livello; ?></option>
            <option value="suxuser">Admin</option>
            <option value="guest">Guest</option>
            <option value="ore">Ore</option>
          </select>
        </p>
        <p>
          <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $_GET['idUtente']; ?>">
          <input type="submit" name="invio" id="invio" value="MODIFICA">
        </p>
      </form>
    </div>
  </div>
</div>

</body>
</html>
<?php } ?>
