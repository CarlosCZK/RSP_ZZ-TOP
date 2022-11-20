<?php
require 'protection.php';
require("connect.php");
ob_start();
    $sql = "UPDATE clanek SET id_recenzent = '$_POST[oponent]', stav ='krecenzi' where id_clanek =$_POST[id] "; 
if (@mysqli_query($spojeni, $sql)) {
 header('location:autor.php');
 exit;

}
ob_end_flush();



?>



