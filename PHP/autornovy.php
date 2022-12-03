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
    <title>Autor</title>
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
                <a href="autor.php"> <button class="btn w-100 btn-outline-dark" type="button">  Moje příspěvky </button></a>
            </div>
            <div class="col-md-4">
                <a href="autornovy.php"> <button class="btn w-100 btn-outline-info" type="button">Nový příspěvek</button> </a>

            </div>
            <div class="col-md-4">
                <button class="btn w-100 btn-outline-secondary" type="button">Výběr čísla/statistiky</button>
            </div>
        </div>


        <!-- <h2>Section title</h2> -->

        <form action="upload.php" method="post" enctype="multipart/form-data">
            
        <h1 class="h3 mb-3 fw-normal">Nový článku</h1>
        <!-- SELECT tématu -->
        <div class="d-flex justify-content-center">
                   <select name='tema' class='btn w-100 btn-outline-dark' >
                    <option  selected value="prazdne"> Vyber Téma</option>
                    <?php
                    $sqltema="select * from tema ";
                    $vysledektema=mysqli_query($spojeni,$sqltema);
                    while ($radektema=mysqli_fetch_assoc($vysledektema))
                    {
                    ?>
                    <option value="<?php echo $radektema["id_tema"]; ?>"  > <?php echo $radektema["nazev"]." ";?> </options>
                        <?php } ?>
                </select> 

        </div>

        <!-- Konec SELECT tématu-->


        <div class="form-floating">
            <input type=text class="form-control" id="floatingInputArticleName" placeholder="text" name="nazev" required>
            <label for="floatingInputArticleName">Název článku</label>
        </div>
        <div class="form-floating">

        </div>
        <div class="form-floating">
            <input class="form-control" type="file" id="myfile" name="myfile" required accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
        </div>


        <button class="w-100 btn btn-lg btn-danger" type="submit" name="submit">Přidat článek</button>
        </form>

        </br></br>
        <a href="autor.php"><button class="w-100 btn btn-lg btn-outline-secondary" type="submit">Zpět na hlavní menu</button></a>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>


    

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


