<?php
# Verify if the user is logged-in


 //specify file, which will be included when user is not logged-in
 //Napiš soubor, který se zobrazí, pokud uživatel neni přihlášen
 $error_file="login.php";
 
 session_start();
 header("Cache-control: private");
 if ($_SESSION["user_is_logged"] != 1){
  header("Location: ".$error_file);
  exit();
  }
?>
