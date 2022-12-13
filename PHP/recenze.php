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
                <a href="oponent.php"> <button class="btn w-100 btn-outline-dark" type="button">  Články k recenzi </button></a>
            </div>
            <div class="col-md-4">
                <a href=" ************doplnit********** .php"> <button class="btn w-100 btn-outline-info" type="button">Přehled článků</button> </a>

            </div>
            <div class="col-md-4">
                <button class="btn w-100 btn-outline-secondary" type="button">Výběr čísla/statistiky</button>
            </div>
        </div>
    </div>  <!-- container py-4 -->


        <!-- <h2>Section title</h2> -->


            <?php
            $sqlclanek="select * from clanek where id_clanek=$idclanek ";
            $vysledekclanek=mysqli_query($spojeni,$sqlclanek);
            $radekclanek=mysqli_fetch_assoc($vysledekclanek);
            
            ?>
    <div class="container col-md-4 col-md-offset-4">

        <form class=" " action="recenzeupdate.php" method="post" >
        <h1 class="h3 mb-3 fw-normal">Recenze článku: <br> <b> <?php echo $radekclanek["text"] ?> </b></h1>
<hr>


            <div class="col"> Aktuálnost: </div>
            <div class="row justify-content-center">
            <div class="col-4">
            <select class="form-select" id="aktual" name="aktual" required>
                <option value="1"> 1 </option>
                <option value="2"> 2 </option>
                <option value="3"> 3 </option>
                <option value="4"> 4 </option>
                <option value="5"> 5 </option>
            </select>
            </div>
             </div>

            <br>
            <div class="col"> Originalita: </div>
            <div class="row justify-content-center">
                <div class="col-4">
                <select class="form-select" id="orig" name="orig" required>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                </select>
            </div>
            </div>

            <br>
            <div class="col"> Odborná úroveň: </div>
            <div class="row justify-content-center">
                <div class="col-4">
                <select class="form-select" id="odbor" name="odbor" required>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                </select>
            </div>
            </div>

            <br>
            <div class="col"> Jazyková a stylistická úroveň: </div>
            <div class="row justify-content-center">
                <div class="col-4">
                <select class="form-select" id="jazyk" name="jazyk" required>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                </select>
            </div>
            </div>
            <br>

            <div >
                <span class=""> Vlastní text: </span> <br>
                <textarea class="form-control" rows="5" id="text" name="text"  required> </textarea>

            </div>
            <br>

            <input type='hidden' id="id" name="id" value="<?php echo $idclanek; ?>">

        <button class="w-100 btn btn-lg btn-danger" type="submit" name="submit">Odeslat recenzi</button>

        </form>

        <br>
        <a href="oponent.php"><button class="w-100 btn btn-lg btn-outline-secondary" type="submit">Zpět na přehled menu</button></a>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
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


