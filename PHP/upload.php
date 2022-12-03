<?php
require 'protection.php';
require("connect.php");
error_reporting(E_ALL);
ini_set('display_errors',1);



?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta http-equiv="refresh" content="2; url=autor.php">


<?php

if(isset($_FILES['myfile'])){

    $errors= array();
    $file_name = $_FILES['myfile']['name'];
    $file_size =$_FILES['myfile']['size'];
    $file_tmp =$_FILES['myfile']['tmp_name'];
    $file_type=$_FILES['myfile']['type'];
    $tmp=explode('.',$_FILES['myfile']['name']);
    $file_ext=strtolower(end($tmp));

    $extensions= array("pdf","doc","docx");


    $soubor=$file_name.time();  //přidá časovou značku, tím zajistí unikátnost názvu - vypůjčeno od SSG
    $cesta="./files/".$soubor;
    $uziv=$_SESSION['uzivatel'];
    $datum=date('Y-m-d');
    $nazev=$_POST['nazev'];

    $up=1;

//test na výběr tématu
    if($_POST['tema']=="prazdne"){
        echo"<b>Nebylo vybráno téma</b>";
        $up=0;
    }
    else {
        //test na příponu a velikost
        if (in_array($file_ext, $extensions) && $file_size<2000000 ){
            $up=1;
        }
        else {
            echo "Lze nahrát pouze dokument ve formátu <b>PDF, DOC, DOCX</b> <br>";
            echo "Maximální velikost souboru je <b>2 MB</b>";
            $up=0;
        }
    }




if ($up==1)
{
    if (move_uploaded_file($file_tmp,"./files/".$soubor))
      {
        //přidání do dtbz
        $sql="INSERT INTO clanek(id_uzivatel, text, file_path, oprava, stav, datum_vytvoreni)
           VALUES ('$uziv','$nazev','$cesta','neni','novy', '$datum')";
        if(mysqli_query($spojeni, $sql))
        {   $lastid=mysqli_insert_id($spojeni);  //uloží poslední vytvořené id do proměnné
            $sqlA="INSERT INTO clanek_tema(id_tema, id_clanek) VALUES ('$_POST[tema]','$lastid' )"; //nová zkouška propojení tématu a článku
            mysqli_query($spojeni, $sqlA);
        }
        //konec přidání
        echo "<br> Soubor <b>".$file_name."</b> byl úspěšně nahrán";

        }
        else {
        echo "File was not uploaded";
        echo $_FILES["myfile"]["error"];
              }

      } //konec if move
}
else { echo "SOUBOR NEBYL NAHRÁN"; }






?>

