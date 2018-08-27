<?php
include "mail1.php";
$mail = $_GET['mail'];
$nope = $_GET['nope'];
$id_hwn = $_GET['hwn'];
surel($mail,$nope,$id_hwn);
?>