<?php
require 'protection.php';
require("connect.php");

$aktual=$_POST["aktual"];
$orig=$_POST["orig"];
$odbor=$_POST["odbor"];
$jazyk=$_POST["jazyk"];
$text=$_POST["text"];
$idclanek=$_POST["id"];
$datum=date('Y-m-d');

ob_start();
    $sql = "INSERT INTO recenze(clanek, uzivatel, aktual, orig, odbor, jazyk, text, datum_vytvoreni, reakce ) 
VALUES ('$idclanek','$_SESSION[uzivatel]','$aktual','$orig','$odbor','$jazyk','$text','$datum','zadna')";


if (@mysqli_query($spojeni, $sql)) {
    $lastid=mysqli_insert_id($spojeni); //uloží poslední id - číslo recenze
    $sqlA = "UPDATE clanek SET id_recenze='$lastid', stav='recenze1' where id_clanek='$idclanek' ";

    if(@mysqli_query($spojeni,$sqlA))
    {
    //
 header('location:oponent.php');
 exit;
    }

}
ob_end_flush();



?>



