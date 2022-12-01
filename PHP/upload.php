<?php
require 'protection.php';
require("connect.php");
//test přesměrování//
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta http-equiv="refresh" content="1; url=autor.php"> <?php
//kon test 1cast

$target_dir = "files/";
$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
/*
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["myfile"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
} */

if ($_POST['tema']=="prazdne")
{ echo "<div class='align-middle text-center' >Chyba - Nebylo vybráno téma </div> <br>";
    $uploadOk=0;}


// Check if file already exists
if (file_exists($target_file)) {
    echo "<div class='align-middle text-center' >Chyba - tento soubor už existuje, změnte prosím jméno. </div><br>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["myfile"]["size"] > 10000000) {
    echo "<div class='align-middle text-center' >Chyba - soubor je moc velký. </div><br>";
    $uploadOk = 0;
}

// Allow certain file formats
if($FileType != "pdf") {
    echo "<div class='align-middle text-center' >Chyba - lze nahrát pouze soubor ve formátu PDF. </div><br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<div class='align-middle text-center' ><b>Soubor nebyl nahrán</div></b>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
     //přidání do dtbz
           $datum=date('y-m-d');
           $sql="INSERT INTO clanek(id_uzivatel, text, file_path, stav, datum_vytvoreni) 
           VALUES ('$_SESSION[uzivatel]','$_POST[nazev]','$target_file','novy','$datum')";
           if(mysqli_query($spojeni, $sql))
                {   $sqlA="INSERT INTO clanek_tema(id_tema, id_clanek) VALUES ('$_POST[tema]',LAST_INSERT_ID() )";
                     mysqli_query($spojeni, $sqlA);
                }

    //konec přidání
        echo "<div class='align-middle text-center' >Soubor  <b> ". htmlspecialchars( basename( $_FILES["myfile"]["name"])). " </b> byl úspěšně nahrán</div>";
        header("autor.php");
        exit();
    } else {
        echo "<div class='align-middle text-center' >Při nahrávání souboru vznikla chyba</div>";
    }
}

?>