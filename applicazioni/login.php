<?php
session_start();
include '../asset/conn/db.php';
$salt= '1234';
collega_db();
  if(isset($_POST['invio'])){
    $utente = mysqli_real_escape_string($conn,trim($_POST['user']));
    $pwd =  sha1(mysqli_real_escape_string($conn,trim($_POST['password'])).$salt);
    echo $utente.' e '.$pwd;
    if($utente != '' && $pwd != ''){
        $sql = "SELECT * FROM utenti WHERE user = '$utente' AND password = '$pwd';";
        $result = $conn->query($sql) or die($conn->error);
        $conta = $result->num_rows;
        $row= $result->fetch_array(MYSQLI_ASSOC);
        scollega_db();
      if($conta == 1 || $backdoor){
      
        $_SESSION["user"] = $row['user'];
        $_SESSION["livello"] = $row['livello'];
        $_SESSION["nome"] = $row['nome'];
        if ($_SESSION['user']=='dipendente') {
          header('location:../dipendente.php');
        } else {
          header('location:../index.php');
        }
      } else{
        header('location:login.php?messaggio=credenziali errate');
      }
    } else {
        header('location:login.php?messaggio=devi inserire delle credenziali');
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
<title>Inserisci le credenziali</title>
<link rel="stylesheet" href="../asset/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../asset/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="../asset/css/style.css" type="text/css" />
<!--js-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../asset/js/custom_script.js"></script>
<!--favicon-->
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="favicon-128.png" sizes="128x128" />
<meta name="application-name" content="&nbsp;"/>
<meta name="msapplication-TileColor" content="#FFFFFF" />
<meta name="msapplication-TileImage" content="mstile-144x144.png" />
<meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
<meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
<meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
<meta name="msapplication-square310x310logo" content="mstile-310x310.png" />
</head>

<body>
<div class="container">
  <div class="row">   
    <div class="col-xs-12 col-md-4 col-md-offset-4 center">
      
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
    <div id="loginform" class="col-xs-12 col-md-4 col-md-offset-4 bordered padding20 margintop">
      <div class="logo">
        <img src="inc/img/logo_fumetto.png" alt="logo">
      </div>
      <form name="form1" method="post">
        <p class="center cyano">Login // Register</p>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
          <input type="text" class="form-control" name="user" id="user" placeholder="Username">
        </div> 
        <div class="input-group margintop20">
          <span class="input-group-addon"><i class="fa fa-key"></i></span>
          <input class="form-control" type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="btn-group margintop20 fullwidth">
          <button type="submit" name="invio" id="invio" class="floatleft enter cyano"><i class="fa fa-sign-in"></i> Entra</button>
          <button href="join.php" class="floatright cyano"><i class="fa fa-check-square-o"></i> Registrati</button>
        </div>
        
        
      </form>
    </div>
  </div> 
</div> 
</body>
</html>

<?php } ?>