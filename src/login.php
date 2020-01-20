<?php
require __DIR__ . '/../vendor/autoload.php';

use ShoppingCart\Controller\MainController;

$mainController = new MainController();
//quitar la linea de debajo
//$mainController->loginClient("jlopez@gmail.com", "jlopez");

$error = '';
if (isset($_REQUEST['email'])) {
    $mainController->loginClient($_REQUEST['email'], $_REQUEST['password']);
}


if (isset($_REQUEST['error'])) {
    $error = "Error Usuario / Contraseña";
}

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>VapeStore Login</title>
  <link rel="stylesheet" href="css/signin.css">
  <!--Bootstrap-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
          integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
          crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
          integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
          crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
          integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
          crossorigin="anonymous"></script>
  <!--Bootstrap End-->
</head>
<body class="text-center">
<div id="error"><?= $error ?></div>
<form action="login.php" method="get" class="form-signin">
  <img class="mb-4" src="img/logo.png" alt="" width="150" height="125">
  <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>
  <label for="inputEmail" class="sr-only">Correo Electrónico</label>
  <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Correo Electrónico" required autofocus>
  <label for="inputPassword" class="sr-only">Contraseña</label>
  <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Contraseña" required>
  <button class="btn btn-lg btn-primary btn-block mt-6" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
</form>
</body>
</html>