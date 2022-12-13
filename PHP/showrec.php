<?php
require("protection.php");
require("connect.php");


$idclanek=$_GET['cislo'];
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
    <title>Recenze </title>
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



        <div class="row d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-4">
                <a href="redaktor.php"> <button class="btn w-100 btn-outline-dark" type="button">  Zpět na přehled </button></a>
            </div>
          <!--  <div class="col-md-4">
                <a href=" ************doplnit********** .php"> <button class="btn w-100 btn-outline-info" type="button">Přehled článků</button> </a>

            </div>
            <div class="col-md-4">
                <button class="btn w-100 btn-outline-secondary" type="button">Výběr čísla/statistiky</button>
            </div>
        </div> -->
    </div>  <!-- container py-4 -->


    <!-- <h2>Section title</h2> -->


    <?php
    $sql="select * from clanek natural join clanek_tema natural join tema where clanek.id_clanek=$idclanek ";
    $vysledek=mysqli_query($spojeni,$sql);
    $radek=mysqli_fetch_assoc($vysledek);

    ?>
    <div class="container col-md-4 col-md-offset-4">


            <h1 class="h3 mb-3 fw-normal">Recenze článku: <br> <b> <?php echo $radek["text"] ?> </b></h1>
<hr>
            <?php
            echo $radek["datum_vytvoreni"]." - ";
            echo $radek["nazev"]; ?>
            <hr>
        <?php
        $sqlA="select * from recenze where clanek=$idclanek ";
        $vysledekA=mysqli_query($spojeni,$sqlA);
        $radekA=mysqli_fetch_assoc($vysledekA);
        ?>

            <div class="col"> Aktuálnost: </div>
            <div class="row justify-content-center">
                <div class="col-4">
            <?php echo $radekA["aktual"]; ?>

                </div>
            </div>

            <br>
        <div class="col"> Originalita: </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <?php echo $radekA["orig"]; ?>

            </div>
        </div>

            <br>
        <div class="col"> Odborná úroveň </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <?php echo $radekA["odbor"]; ?>

            </div>
        </div>

            <br>
            <div class="col"> Jazyková a stylistická úroveň: </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <?php echo $radekA["jazyk"]; ?>

            </div>
        </div>
            <br>

            <div >
                <div class="col"> Doplňující text: </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php echo $radekA["text"]; ?>

            </div>



    </div>



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


