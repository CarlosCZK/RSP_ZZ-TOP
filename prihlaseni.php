<?php


if (isset($_GET['action']))
{
    require("connect.php");
    $user=$_POST['username'];
    $pass=($_POST['password']);

    $sql = "select * from uzivatel where login='$user' AND password='$pass' ";


    $vysledek = mysqli_query($spojeni, $sql);

    if ( mysqli_num_rows($vysledek)>0 )
    {
        $zaznam = mysqli_fetch_assoc($vysledek);
        session_start();
        header("Cache-control: private");
        $_SESSION["user_is_logged"] = 1;
        $_SESSION["role"] = $zaznam['role'] ;
     //   $_SESSION["login"] = $zaznam['login'] ;


    switch ($_SESSION["role"])
    {
        case "autor":
            header("location:autor.php");
               exit();
        case "redaktor":
            header("location:redaktor.php");
            exit();
        case "recenzent":
            header("location:recenzent.php");
            exit();
        case "sefredaktor":
            header("location:sefredaktor.php");
            exit();
        default:
            echo 'špatné přihlašovací údaje';
    }

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>
    html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
    
    <title>Document</title>


    
</head>
<body class="text-center">
    
    <main class="form-signin w-100 m-auto">
      <form action="./prihlaseni.php?action=validate" method="post">
        <h1 class="h3 mb-3 fw-normal">Přihlášení</h1>

        <div class="form-floating">
          <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Uživatelské jméno" >
          <label for="floatingInput">Uživatelské jméno</label>
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Heslo</label>
        </div>
    
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" name="remember" value="remember-me"> Zapamatovat si
          </label>
        </div>

        <input type="submit" class="w-100 btn btn-lg btn-danger" value="Přihlásit" />
     </form>
    </main>
    
    
        
      </body>
</html>