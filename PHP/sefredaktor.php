<?php
require("protection.php");
require("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="styly.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Šéfredaktor</title>
</head>

<body class="text-center">
    
    <main>
        <div class="container py-4">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
              <span class="fs-4">Náš Časopis</span>
            </a>

            <div class="text-end">
                <span class="fs-8">jste přihlášen jako <span class="fw-bold"> <?php echo $_SESSION["role"]." "; ?> </span></span>
                <a href="index.php"><button type="button" class="btn btn-outline-secondary me-2">Odhlásit</button></a>
              </div>
          </header>



        <!--  <div class="row d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-4">
                <a href="redaktor.php"> <button class="btn w-100 btn-outline-dark" type="button">  Nové příspěvky </button></a>
            </div>
            <div class="col-md-4">
                <a href="redaktorvyber.php"> <button class="btn w-100 btn-outline-info" type="button">Přehled příspěvků</button> </a>

            </div>
            <div class="col-md-4">
                <button class="btn w-100 btn-outline-secondary" type="button">Výběr čísla/statistiky</button>
            </div>
          </div>
-->

          <!-- <h2>Section title</h2> -->

            <!-- SELECT tématu -->

              <form   action='' method='post'>
             <select name='tema' class='btn w-100 btn-outline-dark' >
             <option  selected> Vyber Téma</option>
             <?php
                $sqltema="select * from tema ";
                $vysledektema=mysqli_query($spojeni,$sqltema);
                  while ($radektema=mysqli_fetch_assoc($vysledektema))
                        {
                         ?>
                            <option value="<?php echo $radektema["id_tema"]; ?>"  > <?php echo $radektema["nazev"]." ";?> </options>
                        <?php } ?>
               </select> <br><input type="submit" Value="ZOBRAZ"/>
               </form>
            <!-- Konec SELECT tématu-->

                                <?php

if (empty($_POST["tema"]))
{echo "<br> <br> <h3> vyber téma </h3>";}
else
{
$sqlA="select * from uzivatel natural join clanek natural join clanek_tema natural join tema where id_tema='$_POST[tema]' order by id_clanek desc";
$vysledekA = mysqli_query($spojeni, $sqlA);


if(mysqli_num_rows($vysledekA)>0)
{

    // echo "<h3> Přehled posledních příspěvků </h3> <hr>";

    echo  " <div class='table-responsive'> ";
    echo  "<table class='table table-striped table-sm'>";
    echo  "<thead>";
    echo  "<tr>";
    echo  "    <th scope='col'>Téma</th>";
    echo  "    <th scope='col'>Název</th>";
    echo  "    <th scope='col'>Článek</th>";
    echo  "    <th scope='col'>Stav</th>";
    echo  "    <th scope='col'>Recenzent</th>";
    echo  "    <th scope='col'>Kontakt recenzent</th>";
    echo  "    <th scope='col'>Autor</th>";
    echo  "    <th scope='col'>Kontakt autor</th>";
    echo  "    <th scope='col'>Vytvořeno dne</th>";
    echo  "    <th scope='col'>Recenze</th>";
    echo  "</tr>";
    echo  "</thead>";

    while ($radekA=mysqli_fetch_assoc($vysledekA)):

        $idA=$radekA["id_clanek"];
        echo  "<tr>";
        echo  "    <td scope='col'>".$radekA["nazev"]; "</td>";     //upravit podle DB - sloupec název tématu
        echo  "    <td scope='col'>".$radekA["text"]; "</td>";
        ?>  <td scope='col'> <a href= "<?php echo $radekA["file_path"]?>"><button type='button'> Zobraz článek </button></a> <?php
        //stav - switchem kvůli čitelnému označení
        switch ($radekA["stav"]) {
            case "novy":
                echo "<td scope='col'>  Nový </td>";
                break;

            case "krecenzi":
                echo "<td scope='col'>  Odesláno k recenzi </td>";
                break;
            case "recenze1":
                echo "<td scope='col'>  Recenze hotová </td>";
                break;

            default:
                echo "Doplnit stav";
                break;
        } //konec switche
        if($radekA["stav"]!="novy")
        {
            // recenzent
            $sqlrece="select * from uzivatel where id_uzivatel='$radekA[id_recenzent]'";
            $vysledekrece=mysqli_query($spojeni,$sqlrece);
            $radekrece=mysqli_fetch_assoc($vysledekrece);
            //
            echo  "    <td scope='col'>".$radekrece["jmeno"]." ".$radekrece["prijmeni"]; ?> </td>
            <td scope="col"> <a href="mailto:<?php echo $radekrece["email"]?>?subject=Recenze: <?php echo $radekA["text"].", Ze dne: ".$radekA["datum_vytvoreni"]?>" > <button type='button'> Poslat zprávu </button> </a></td><?php
            // konec recenzent
        }
        else {
            echo "<td scope=col> --- </td>";
            echo "<td scope=col> --- </td>";

        }
        echo  "    <td scope='col'>".$radekA["jmeno"]." ".$radekA["prijmeni"]; "</td>"; //autor
        echo  "    <td scope='col'>" ?> <a href="mailto:<?php echo $radekA["email"]?>?subject=Článek: <?php echo $radekA["text"].", Ze dne: ".$radekA["datum_vytvoreni"]?>" > <button type='button'> Poslat zprávu </button> </a> </td>
        <?php
        echo  "    <td scope='col'>".$radekA["datum_vytvoreni"]; "</td>";
        //recenze
        if($radekA["id_recenze"]!=NULL){
            ?> <td scope='col'> <a href='showrec.php?cislo=<?php echo $radekA["id_clanek"]; ?> '><button type='button'>  Zobraz recenzi </button></a> </td> <?php
        }
        else {echo "<td scope='col'> Není </td>";} //konec recenze
        echo  "</tr>";


    endwhile;
    echo  "</tbody>";
    echo  "</table>";
}
 }//konec else - if empty
?>

    </main>
  </div>
</div>

          <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2022
          </footer>
        </div>
      </main>
    
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</html>