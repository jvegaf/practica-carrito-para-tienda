<?php
require __DIR__ . '/../vendor/autoload.php';

use ShoppingCart\Infrastructure\Controllers\MainController;

$mainController = new MainController();

$error = '';
if (isset($_REQUEST['email'])) {
  if (isset($_REQUEST['remember'])){
      $mainController->loginClient($_REQUEST['email'], $_REQUEST['password'], true);
  }else {
      $mainController->loginClient($_REQUEST['email'], $_REQUEST['password'], false);
  }
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
  <title>Store Login</title>
  <link rel="stylesheet" href="css/signin.css">
  <!--Bootstrap-->
  < <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
  <div class="custom-control custom-switch mb-3">
    <input type="checkbox" class="custom-control-input" id="switch1" name="remember" value="true">
    <label class="custom-control-label" for="switch1">Recuerdame</label>
  </div>
  <button class="btn btn-lg btn-primary btn-block mt-6" type="submit">Iniciar Sesión</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
</form>
</body>
</html>