<?php
require 'protection.php';
require("connect.php");
ob_start();
    $sql = "UPDATE clanek SET id_recenzent = '$_POST[oponent]', stav ='krecenzi' where id_clanek =$_POST[id] "; //změnit ID_Recenze na ID_Oponenta až bude doplněno do DB

if (@mysqli_query($spojeni, $sql)) {
 header('location:redaktor.php');
 exit;

}
ob_end_flush();



?>



