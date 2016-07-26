<?php
session_start();
session_destroy();
header('location: login.php?messaggio=hai effettuato il logout');
?>
