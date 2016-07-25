<?php
include_once 'asset/moduli/dbMySQL.php';
$con = new DB_con();
$table = "Magazzino";
$res=$con->select($table);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Magazzino </title>
<link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="asset/css/style.css" type="text/css" />
</head>
<body>
<center>

<div id="header">
 <div id="content">
    <label>Visuale completa del Magazzino</label>
    </div>
</div>
<div id="body">
 <div class="container">
     <div class="table-responsive">
      <table class="table table-hover">
        <tr>
        <th colspan="5" class="text-center"><a href="applicazioni/add_mag.php">Aggiungi Prodotti in magazzino</a></th>
        </tr>
        <tr>
        <th>Barcode</th>
        <th>Nome Prodotto</th>
        <th>Prezzo</th>
        <th>Quantit&agrave;</th>
        <th>Costo</th>
        <th></th>
        <th></th>
        </tr>
        <?php
         while($row=mysql_fetch_row($res))
         {
           ?>
            <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td>&euro; <?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td>&euro; <?php echo $row[4]; ?></td>
            <td></td>
            <td></td>
            </tr>
            <?php
         }
         ?>
        </table>
    </div>
</div>

<div id="footer">
 <div id="content">
    <hr /><br/>
    <label>Per qualsiasi problema contattare : <a href="http://www.cesco82design.it">Cesco82Design.it</a></label>
    </div>
</div>

</center>
</body>
</html>