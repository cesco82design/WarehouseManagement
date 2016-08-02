<?php
include '../../asset/moduli/User.php';
$addUser = new User();

// data insert code starts here.
if(isset($_POST['btn-save'])) {

 $nomeutente = $addUser->pulisci_stringa($_POST['nome']);
 $user = $addUser->pulisci_stringa($_POST['user']);
 $password = $addUser->reg_pwd($_POST ['password']);
 $livello = $_POST['livello'];
 
 $utente = User::insert_user($nomeutente,$user,$password,$livello);
 if($utente) {
  ?>
  <script>
    //alert('Utente inserito');
    window.location='../../lista_utenti.php?messaggio=Utente inserito'
  </script>
  <?php
 } else {
  ?>
  <script>
    //alert('Errore durante l&rsquo;inserimento dell&rsquo;utente');
    window.location='../../lista_utenti.php?messaggio=c&rsquo;&egrave; un errore nell&rsquo;inserimento dell&rsquo;utente'
  </script>
  <?php
 } 
} else {
// data insert code ends here.

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Inserimento dell&rsquo;utente</title>
<link rel="stylesheet" href="../../asset/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../../asset/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="../../asset/css/style.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../../asset/js/custom_script.js"></script>
</head>
<body>
<div class="page text-center">

<header>
    <div id="content">
        <h1>Inserimento dell&rsquo;utente</h1>
    </div>
</header>
<section id="body">
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
        <div id="content">
            <form method="post">
                <table align="center">
                <tr>
                <td colspan="2"><input type="text" name="nome" placeholder="Nome Utente" required /></td>
                </tr>
                <tr>
                <td colspan="2"><input type="text" name="user" placeholder="Username" required /></td>
                </tr>
                <tr>
                <td colspan="2"><input type="password"  name="password" placeholder="Password" required /></td>
                </tr>
                <tr>
                <td colspan="2">
                    <select name="livello" id="livello">
                        <option value="suxuser">Admin</option>
                        <option value="guest">Guest</option>
                        <option value="ore">Ore</option>
                    </select>
                </td>
                </tr>
                <tr>
                <td>
                <button type="submit" name="btn-save"><strong>Aggiungi</strong></button>
                </td>
                <td>
                <button href="../../index.php"><strong>Home</strong></button>
                </td>
                </tr>
                </table>
            </form>
        </div>
    </div>
</section>

</div>
</body>
</html>
<?php } ?>