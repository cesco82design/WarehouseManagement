<?php
include_once 'functions.php';
include 'applicazioni/check_login.php';
session_start();

if (($_SESSION['livello']=='suxuser')||($_SESSION['livello']=='dipendente')){
include_once(LAYOUT.'pretitle.php');
?>

<title>Cerca clienti </title>
<?php include_once(LAYOUT.'header.php'); ?>
<header>
  <div class="continer">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">Cerca clienti</h1>
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
      <div class="col-xs-12 col-sm-6">
        <h4 class="paddingleft20">Cerca per Cognome</h4>
        <div class="col-xs-12">
          <form class="search_form" method="post" action="search_result.php?search=cognome">
            <div class="col-xs-12 col-sm-6">
              <input type="text" name="ricerca" placeholder="Cognome" required />
            </div>
            <div class="col-xs-12 col-sm-6">
              <input type="submit" value="Cerca" class="btn-save" />
            </div>
          </form>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <h4 class="paddingleft20">Cerca per Card</h4>
        <div class="col-xs-12">
          <form class="search_form" method="post" action="search_result.php?search=card">
            <div class="col-xs-12 col-sm-6">
              <input type="text" name="ricerca" placeholder="Tessera" required />
            </div>
            <div class="col-xs-12 col-sm-6">
              <input type="submit" value="Cerca" class="btn-save" />
            </div>
          </form>
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
 ?>
