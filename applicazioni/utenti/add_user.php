<?php
session_start();
include_once('../../functions.php');
  include CLASMOD.'User.php';
$addUser = new User();

// data insert code starts here.
if(isset($_POST['btn-save'])) {

 $nomeutente = $addUser->pulisci_stringa($_POST['nome']);
 $cognome = $addUser->pulisci_stringa($_POST['cognome']);
 $user = $addUser->pulisci_stringa($_POST['user']);
 $password = $addUser->reg_pwd($_POST ['password']);
 $livello = $_POST['livello'];
 //echo $nomeutente.' - '.$user.' - '.$password.' - '.$livello;
 
 $utente = User::insert_user($nomeutente,$cognome,$user,$password,$livello);
 //var_dump($utente);
 if($utente) {
    header('location:../../lista_utenti.php?messaggio=utente aggiunto correttamente');
  } else {
    header('location:?messaggio=c\'è un errore nell\'inserimento dell\'utente');
  }
} else {
// data insert code ends here.
include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento dell&rsquo;utente</title>

<?php include_once(LAYOUT.'header.php'); ?>

<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento dell&rsquo;utente</h1>
      </div>
    </div>
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
  </div>
</header>
<section id="body">
    <div class="container">
        <div class="row">   
            <div class="col-xs-12 col-md-4 col-md-offset-4 text-center">
              
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
                <td colspan="2"><input type="text" name="cognome" placeholder="Cognome Utente" required /></td>
                </tr>
                <tr>
                <td colspan="2"><input type="text" name="user" placeholder="Username" required /></td>
                </tr>
                <tr>
                <td colspan="2"><input type="password" maxlength="12" name="password" placeholder="Password" required /></td>
                </tr>
                <tr>
                <td colspan="2"><input type="hidden"  name="livello" value="guest" /></td>
                </tr>
                <tr>
                <td class="text-center">
                <button type="submit" name="btn-save"><strong>Aggiungi</strong></button>
                </td>
                </tr>
                </table>
            </form>
        </div>
    </div>
</section>

<?php include_once(LAYOUT.'footer.php'); ?>
<?php } ?>