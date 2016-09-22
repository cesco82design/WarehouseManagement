<?PHP 

include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserisci le credenziali</title>

<?php include_once(LAYOUT.'header.php'); ?>
<header>
  <div class="contaienr">
    <div class="row">
      <div class="col-xs-12 text-center">
      <h1>Login // Register</h1>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
        <?php
            if(isset($_GET['messaggio'])){ ?>
            <div class="messaggio <?php if (isset($_GET['alert'])) { echo 'alert alert-danger';} else { echo 'alert alert-success';} ?>">
            <?php
              echo $_GET['messaggio'];
              //echo PATH;
              //echo LOGURL;
              ?>
              </div>
              <?php
            }
          ?>
        </div>
    </div>
  </div>
</header>
<div class="container">
  <div class="row">
    <div id="loginform" class="col-xs-12 col-md-4 col-md-offset-4 bordered padding20 margintop">
      <div class="logo">
        <img src="<?php echo IMG; ?>logo_jole_acconciature.jpg" class="img-responsive img-circle" alt="logo">
      </div>
      <form name="form1" method="post">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
          <input type="text" class="form-control" name="user" id="user" placeholder="Username">
        </div> 
        <div class="input-group margintop20">
          <span class="input-group-addon"><i class="fa fa-key"></i></span>
          <input class="form-control" type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="btn-group margintop20 fullwidth">
          <button type="submit" name="invio" id="invio" class="enter cyano"><i class="fa fa-sign-in"></i> Entra</button>
        </div>
        
        
      </form>
    </div>
  </div> 
</div> 
<?php include_once(LAYOUT.'footer.php'); ?>