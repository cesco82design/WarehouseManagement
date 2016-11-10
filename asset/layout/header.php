<link rel="stylesheet" href="<?php echo CSS; ?>bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo CSS; ?>font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?php echo CSS; ?>style.css" type="text/css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo JS; ?>imgLiquid-min.js"></script>
<script src="<?php echo JS; ?>custom_script.js"></script>
<script src="<?php echo JS; ?>bootstrap.min.js"></script>
<!--favicon-->
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo IMG;?>apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMG;?>apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo IMG;?>apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo IMG;?>apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo IMG;?>apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo IMG;?>apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo IMG;?>apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo IMG;?>apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="<?php echo IMG;?>favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="<?php echo IMG;?>favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href=<?php echo IMG;?>"favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo IMG;?>favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="<?php echo IMG;?>favicon-128.png" sizes="128x128" />
<meta name="application-name" content="&nbsp;"/>
<meta name="msapplication-TileColor" content="#FFFFFF" />
<meta name="msapplication-TileImage" content="<?php echo IMG;?>mstile-144x144.png" />
<meta name="msapplication-square70x70logo" content="<?php echo IMG;?>mstile-70x70.png" />
<meta name="msapplication-square150x150logo" content="<?php echo IMG;?>mstile-150x150.png" />
<meta name="msapplication-wide310x150logo" content="<?php echo IMG;?>mstile-310x150.png" />
<meta name="msapplication-square310x310logo" content="<?php echo IMG;?>mstile-310x310.png" />
</head>
<body>
<?php $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if ($url=='http://gestionale.francescosciolti.com/') { ?>
  <div class="background imgLiquidFill">
    <img src="<?php echo IMG;?>negozio.jpg">
    <div class="overlay"></div>
  </div>
<?php } ?>
<div id="menu">
  <nav class="navbar navbar-inverse navbar-fixed-top navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://acconciaturejole.it"><img src="<?php echo IMG; ?>logo_top_jole_acconciature.jpg" alt="Dispute Bills">
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo PATH; ?>">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Magazzino <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header">Gestione Prodotti</li>
              <?php if ($_SESSION['livello']=='suxuser') { ?>
              <li><a href="<?php echo PATH;?>/magazzino.php">Inventario Magazzino</a></li>
              <li><a href="<?php echo MAGAZZINO;?>add_mag.php">Aggiungi Prodotto</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Gestione Magazzino</li>
              <li><a href="<?php echo MAGAZZINO;?>mov_mag.php">Aggiungi Movimenti</a></li>
              <li><a href="<?php echo PATH;?>/movimenti.php">Lista Movimenti</a></li>
              <?php } ?>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clienti <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <?php if ($_SESSION['livello']=='suxuser') { ?>
                <li class="divider"></li>
                <li class="dropdown-header">Anagrafica Clienti</li>
                <li><a href="<?php echo PATH;?>/clienti.php">Lista Clienti</a></li>
                <li><a href="<?php echo PATH;?>/cerca.php">Cerca Cliente</a></li>
                <li><a href="<?php echo CLIENTI;?>add_cliente.php">Aggiungi Cliente</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Schede Clienti</li>
                <li><a href="<?php echo PATH;?>/schede_clienti.php">Schede Cliente</a></li>
                <li><a href="<?php echo SCHEDE;?>add_scheda.php">Aggiungi Scheda</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Gestione Tessere</li>
                <li><a href="<?php echo PATH;?>/card.php">Lista Tessere</a></li>
                <li><a href="<?php echo TESSERE;?>add_tessera.php">Aggiungi Tessera</a></li>
              <?php } ?>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Fornitori <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li class="divider"></li>
                <li class="dropdown-header">Anagrafica Fornitori</li>
                <li><a href="<?php echo PATH;?>/fornitori.php">Lista Fornitori</a></li>
                <li><a href="<?php echo FORNITORI;?>add_fornitore.php">Aggiungi Fornitore</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              
              <li><a href="<?php echo PATH;?>/lista_utenti.php">Lista Utenti</a></li>
              <?php if ($_SESSION['livello']=='suxuser') { ?>
                <li><a href="<?php echo UTENTI;?>add_user.php">Aggiungi Utenti</a></li>
              <?php } ?>
              <li class="divider"></li>
            </ul>
          </li>
          <?php 
          if (!$_SESSION['nome']) {
            echo '
          <li class="dropdown">
            <a href="'.APP.'/login.php" role="button" aria-expanded="false">Login</a>
          </li>';
          } else {
          ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['nome'];?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header"><?php echo $_SESSION['nome'];?></li>
              <li><a href="#">Profile</a></li>
              <li><a href="#">link</a></li>
              <?php if ($_SESSION['livello']=='suxuser') {
                echo '<li class="divider"></li>
                        <li class="dropdown-header">Configurazione</li>
                        <li><a href="'.PATH.'/azienda.php">Dati Azienda</a></li>
                        <li><a href="'.PATH.'/dipendenti.php">Lista Dipendenti</a></li>
                        <li><a href="'.UTENTI.'add_dip.php">Aggiungi Dipendente</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Gestione Categorie</li>
                        <li><a href="'.PATH.'/categorie.php">Tutte le categorie</a></li>
                        <li><a href="'.MAGAZZINO.'add_cat.php">Aggiungi categoria</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Gestione Marche</li>
                        <li><a href="'.PATH.'/brand.php">Tutte le marche</a></li>
                        <li><a href="'.MAGAZZINO.'add_marca.php">Aggiungi marca</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Gestione Trattamenti</li>
                        <li><a href="'.PATH.'/trattamenti.php">Tutti trattamenti</a></li>
                        <li><a href="'.TRATTAMENTI.'add_trattamento.php">Aggiungi Trattamento</a></li>';
                } ?>
              <li class="divider"></li>
              <?php /*<li><a href="<?php echo UTENTI;?>add_user.php"><i class="fa fa-check-square-o"></i> Registrati</a></li>*/ ?>
              <li><a href="<?php echo APP;?>/logout.php"><i class="fa fa-sign-out"></i> Disconnetti</a></li>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</div>