<?php
include_once 'applicazioni/check_login.php';
session_start();
include_once('functions.php');
include CLASMOD.'Azienda.php';
  $add_azienda = new Azienda(12);
if (!is_null($add_azienda->id)) {
  if(isset($_POST['update'])) {
  $updt_azienda = new Azienda();
  $denominazione = $updt_azienda->pulisci_stringa($_POST['denominazione']);
  $tipo = $_POST['tipo'];
  $proprietario = $updt_azienda->pulisci_stringa($_POST['proprietario']);
  $indirizzo = $updt_azienda->pulisci_stringa($_POST['indirizzo']);
  $citta = $updt_azienda->pulisci_stringa($_POST['citta']);
  $provincia = $updt_azienda->pulisci_stringa($_POST['provincia']);
  $cap = $updt_azienda->pulisci_stringa($_POST['cap']);
  $telefono = $updt_azienda->pulisci_stringa($_POST['telefono']);
  $telefono2 = $updt_azienda->pulisci_stringa($_POST['telefono2']);
  $cellulare = $updt_azienda->pulisci_stringa($_POST['cellulare']);
  $mail = $updt_azienda->validate_email($_POST['mail']);
  $partitaiva = $updt_azienda->pulisci_stringa($_POST['partitaiva']);
  $codicefiscale = $updt_azienda->pulisci_stringa($_POST['codicefiscale']);
  $banca = $updt_azienda->pulisci_stringa($_POST['banca']);
  $filiale = $updt_azienda->pulisci_stringa($_POST['filiale']);
  $contocorrente = $updt_azienda->pulisci_stringa($_POST['contocorrente']);
  $abi = $updt_azienda->pulisci_stringa($_POST['abi']);
  $cab = $updt_azienda->pulisci_stringa($_POST['cab']);
  $cin = $updt_azienda->pulisci_stringa($_POST['cin']);
  $cciaa = $updt_azienda->pulisci_stringa($_POST['cciaa']);
 $upd_azienda = $updt_azienda->aggiorna_azienda('12',$denominazione,$tipo,$proprietario,$indirizzo,$citta,$provincia,$cap,$telefono,$telefono2,$cellulare,$mail,$partitaiva,$codicefiscale,$banca,$filiale,$contocorrente,$abi,$cab,$cin,$cciaa);
 /*var_dump($prodotto);
 exit();*/
 if($upd_azienda)   {
    header('location:'.$_SERVER['HTTP_REFERER'].'?messaggio=Dati aggiornati correttamente');
  } else {
    header('location:'.$_SERVER['HTTP_REFERER'].'?alert=danger&messaggio=c\'è un errore nell\'aggiornamento dei dati');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Aggiorna Info Aziendali</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Aggiorna Info Aziendali</h1>
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
<section>
 <div class="container">
   <div class="row">
     <div class="col-xs-12 col-md-8 col-md-offset-2">
        <form id="insert_prod" method="post">
            <div class="col-xs-12 col-sm-6">
              <label for="denominazione">Ragione Sociale</label>
              <input type="text" name="denominazione" value="<?php echo $add_azienda->denominazione; ?>" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="tipo">tipologia</label>
                <select name="tipo" required class="col-xs-12">
                    <option value="<?php echo $add_azienda->tipo; ?>"><?php echo $add_azienda->tipo; ?></option>
                    <option value="srl">S.R.L.</option>
                    <option value="spa">S.p.A.</option>
                    <option value="snc">S.N.C.</option>
                    <option value="sas">S.a.s.</option>
                </select>          
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="proprietario">Proprietario</label>
                <input type="text" name="proprietario" value="<?php echo $add_azienda->proprietario; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="indirizzo">Indirizzo</label>
                <input type="text" name="indirizzo" value="<?php echo $add_azienda->indirizzo; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="citta">Città</label>
                <input type="text" name="citta" value="<?php echo $add_azienda->citta; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia" value="<?php echo $add_azienda->provincia; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cap">CAP</label>
                <input type="text" name="cap" value="<?php echo $add_azienda->cap; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" value="<?php echo $add_azienda->telefono; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="telefono2">Telefono 2</label>
                <input type="text" name="telefono2" value="<?php echo $add_azienda->telefono2; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cellulare">Cellulare</label>
                <input type="text" name="cellulare" value="<?php echo $add_azienda->cellulare; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="mail">Mail</label>
                <input type="text" name="mail" value="<?php echo $add_azienda->mail; ?>"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="partitaiva">Partita Iva</label>
                <input type="text" name="partitaiva" value="<?php echo $add_azienda->partitaiva; ?>" required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="codicefiscale">Codice Fiscale</label>
                <input type="text" name="codicefiscale" value="<?php echo $add_azienda->codicefiscale; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="banca">Banca</label>
                <input type="text" name="banca" value="<?php echo $add_azienda->banca; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="filiale">Filiale</label>
                <input type="text" name="filiale" value="<?php echo $add_azienda->filiale; ?>"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="contocorrente">C/C</label>
                <input type="text" name="contocorrente" value="<?php echo $add_azienda->contocorrente; ?>"  />
            </div>
            <div class="col-xs-6 col-sm-3">
                <label for="abi">ABI</label>
                <input type="text" name="abi" value="<?php echo $add_azienda->abi; ?>"  />
            </div>
            <div class="col-xs-6 col-sm-3">
                <label for="cab">CAB</label>
                <input type="text" name="cab" value="<?php echo $add_azienda->cab; ?>"  />
            </div>
            <div class="col-xs-6 col-sm-3">
                <label for="cin">CIN</label>
                <input type="text" name="cin" value="<?php echo $add_azienda->cin; ?>"  />
            </div>
            <div class="col-xs-6 col-sm-3">
                <label for="cciaa">CCIAA</label>
                <input type="text" name="cciaa" value="<?php echo $add_azienda->cciaa; ?>"  />
            </div>
            <div class="col-xs-12">
                <input type="submit" name="update" class="update margintop30" value="AGGIORNA" />
            </div>
        </form>
      </div>
  </div>
</div>

</section>
<?php include_once(LAYOUT.'footer.php'); ?>
<?php }
} 
else {
if(isset($_POST['btn-save'])) {
  $new_azienda = new Azienda();
  $denominazione = $new_azienda->pulisci_stringa($_POST['denominazione']);
  $tipo = $_POST['tipo'];
  $proprietario = $new_azienda->pulisci_stringa($_POST['proprietario']);
  $indirizzo = $new_azienda->pulisci_stringa($_POST['indirizzo']);
  $citta = $new_azienda->pulisci_stringa($_POST['citta']);
  $provincia = $new_azienda->pulisci_stringa($_POST['provincia']);
  $cap = $new_azienda->pulisci_stringa($_POST['cap']);
  $telefono = $new_azienda->pulisci_stringa($_POST['telefono']);
  $telefono2 = $new_azienda->pulisci_stringa($_POST['telefono2']);
  $cellulare = $new_azienda->pulisci_stringa($_POST['cellulare']);
  $mail = $new_azienda->validate_email($_POST['mail']);
  $partitaiva = $new_azienda->pulisci_stringa($_POST['partitaiva']);
  $codicefiscale = $new_azienda->pulisci_stringa($_POST['codicefiscale']);
  $banca = $new_azienda->pulisci_stringa($_POST['banca']);
  $filiale = $new_azienda->pulisci_stringa($_POST['filiale']);
  $contocorrente = $new_azienda->pulisci_stringa($_POST['contocorrente']);
  $abi = $new_azienda->pulisci_stringa($_POST['abi']);
  $cab = $new_azienda->pulisci_stringa($_POST['cab']);
  $cin = $new_azienda->pulisci_stringa($_POST['cin']);
  $cciaa = $new_azienda->pulisci_stringa($_POST['cciaa']);
/*echo $denominazione.' '.$tipo.' '.$proprietario.' '.$indirizzo.' '.$citta.' '.$provincia.' '.$cap.' '.$telefono.' '.$telefono2.' '.$cellulare.' '.$mail.' '.$partitaiva.' '.$codicefiscale.' '.$banca.' '.$filiale.' '.$contocorrente.' '.$abi.' '.$cab.' '.$cin.' '.$cciaa;
exit();*/
 $azienda = Azienda::insert_azienda('12',$denominazione,$tipo,$proprietario,$indirizzo,$citta,$provincia,$cap,$telefono,$telefono2,$cellulare,$mail,$partitaiva,$codicefiscale,$banca,$filiale,$contocorrente,$abi,$cab,$cin,$cciaa);
 /*var_dump($prodotto);
 exit();*/
 if($azienda)   {
    header('location:'.$_SERVER['HTTP_REFERER'].'?messaggio=Dati inseriti correttamente');
  } else {
    header('location:'.$_SERVER['HTTP_REFERER'].'?alert=danger&messaggio=c\'è un errore nell\'inserimento dei dati');
  }
} else {
// data insert code ends here.

include_once(LAYOUT.'pretitle.php'); ?>

<title>Inserimento Info Aziendali</title>

<?php include_once(LAYOUT.'header.php'); ?>


<header class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>Inserimento Info Aziendali</h1>
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
<section>
 <div class="container">
   <div class="row">
     <div class="col-xs-12 col-md-8 col-md-offset-2">
        <form id="insert_prod" method="post">
            <div class="col-xs-12 col-sm-6">
              <label for="denominazione">Ragione Sociale</label>
              <input type="text" name="denominazione" placeholder="Ragione Sociale" required />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="tipo">tipologia</label>
                <select name="tipo" required class="col-xs-12">
                    <option value="srl">S.R.L.</option>
                    <option value="spa">S.p.A.</option>
                    <option value="snc">S.N.C.</option>
                    <option value="sas">S.a.s.</option>
                </select>          
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="proprietario">Proprietario</label>
                <input type="text" name="proprietario" placeholder="Proprietario"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="indirizzo">Indirizzo</label>
                <input type="text" name="indirizzo" placeholder="Indirizzo"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="citta">Città</label>
                <input type="text" name="citta" placeholder="Città"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia" placeholder="Provincia"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cap">CAP</label>
                <input type="text" name="cap" placeholder="CAP"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" placeholder="Telefono"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="telefono2">Telefono 2</label>
                <input type="text" name="telefono2" placeholder="Telefono 2"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="cellulare">Cellulare</label>
                <input type="text" name="cellulare" placeholder="Cellulare"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="mail">Mail</label>
                <input type="text" name="mail" placeholder="Mail"  required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="partitaiva">Partita Iva</label>
                <input type="text" name="partitaiva" placeholder="Partita Iva" required/>
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="codicefiscale">Codice Fiscale</label>
                <input type="text" name="codicefiscale" placeholder="Codice Fiscale"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="banca">Banca</label>
                <input type="text" name="banca" placeholder="Banca"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="filiale">Filiale</label>
                <input type="text" name="filiale" placeholder="Filiale"  />
            </div>
            <div class="col-xs-12 col-sm-6">
                <label for="contocorrente">C/C</label>
                <input type="text" name="contocorrente" placeholder="C/C"  />
            </div>
            <div class="col-xs-6 col-sm-3">
                <label for="abi">ABI</label>
                <input type="text" name="abi" placeholder="ABI"  />
            </div>
            <div class="col-xs-6 col-sm-3">
                <label for="cab">CAB</label>
                <input type="text" name="cab" placeholder="CAB"  />
            </div>
            <div class="col-xs-6 col-sm-3">
                <label for="cin">CIN</label>
                <input type="text" name="cin" placeholder="CIN"  />
            </div>
            <div class="col-xs-6 col-sm-3">
                <label for="cciaa">CCIAA</label>
                <input type="text" name="cciaa" placeholder="CCIAA"  />
            </div>
            <div class="col-xs-12">
                <input type="submit" name="btn-save" class="btn-save margintop30" value="SALVA" />
            </div>
        </form>
      </div>
  </div>
</div>

</section>
<?php include_once(LAYOUT.'footer.php'); ?>
<?php }
} ?>