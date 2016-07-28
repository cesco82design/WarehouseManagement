<?php
	
	include '../../asset/moduli/Prodotto.php';
	$modifica = new Prodotto($_GET['barcode']);
	var_dump($modifica);
	echo $modifica->nome;
	echo $modifica->quantita;
	echo $modifica->prezzo;
	/*$res=$modifica->selectProd($_GET['barcode']);
	$Usermod = $res->fetch_object();
	echo $Usermod->nome;
	/*
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
<script src="asset/js/custom_script.js"></script>
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
	if(isset($_GET['barcode'])){
		
	}
?>
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      <form name="form1" method="post">
        <p>nome
        <input type="text" name="nome" id="nome" value="<?php echo utf8_encode($row['nome']); ?>">
        </p>
        <p>user
          <input type="text" name="user" id="user" value="<?php echo utf8_encode($row['user']); ?>">
        </p>
        <p>cambia password
          <input type="password" name="password" id="password">
        </p>
        <p>
          <select name="livello" id="livello">
            <option value="<?php echo utf8_encode($row['livello']); ?>"><?php echo utf8_encode($row['livello']); ?></option>
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
<?php scollega_db();?>
</body>
</html>
*/?>