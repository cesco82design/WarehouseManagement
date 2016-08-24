<link rel="stylesheet" href="<?php echo CSS; ?>bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo CSS; ?>font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo CSS; ?>style.css" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Anagrafica <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Azienda</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo PATH;?>/lista_utenti.php">Lista Utenti</a></li>
              <li><a href="<?php echo UTENTI;?>add_user.php">Aggiungi Utenti</a></li>
              <li class="divider"></li>
              <li><a href="#">Lista Dipendenti</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clienti <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Lista Clienti</a></li>
              <li><a href="#">Aggiungi Cliente</a></li>
              <li><a href="#">Scheda Cliente</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Magazzino <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header">Gestione Prodotti</li>
              <li><a href="<?php echo PATH;?>/magazzino.php">Tutti i prodotti</a></li>
              <li><a href="<?php echo MAGAZZINO;?>add_mag.php">Aggiungi Prodotto</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Gestione Categorie</li>
              <li><a href="<?php echo PATH;?>/categorie.php">Tutte le categorie</a></li>
              <li><a href="<?php echo MAGAZZINO;?>add_cat.php">Aggiungi categoria</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Gestione Marche</li>
              <li><a href="<?php echo PATH;?>/marche.php">Tutte le marche</a></li>
              <li><a href="<?php echo MAGAZZINO;?>add_mar.php">Aggiungi marca</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Gestione Magazzino</li>
              <li><a href="#">Movimenti Magazzino</a></li>
              <li><a href="#">Inventario Magazzino</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Fornitori <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Anagrafica Fornitori</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header"><?php echo $_SESSION['nome'];?></li>
              <li><a href="#">Profile</a></li>
              <li><a href="#">link</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo UTENTI;?>add_user.php"><i class="fa fa-check-square-o"></i> Registrati</a></li>
              <li><a href="<?php echo APP;?>/logout.php"><i class="fa fa-sign-out"></i> Disconnetti</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</div>