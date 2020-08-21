<?php
require __DIR__ . '/../vendor/autoload.php';
use ShoppingCart\Controllers\MainController;
session_start();
$mainController = new MainController();

if (!isset($_SESSION['sesion-started'])){
    if (isset($_COOKIE['token'])){
        $mainController->checkClientToken($_COOKIE['token']);
    }
}

if (isset($_REQUEST['add_to_cart'])){
  $mainController->addItemToCart($_REQUEST['item']);
}

$shopItems = $mainController->getAllShopItems();
$cartItemsAmount = $mainController->getCartItemsAmount();



$cartIcon = "<a href=\"cart.php\" class='mr-4'><span class=\"h6 mr-3 text-white\">" .  $cartItemsAmount . "</span><img src=\"img/cart.png\" alt=\"Cart\" width=\"20\" height=\"18\"></a>";
$nameCl = $mainController->getClientName();
$clientName = "<span class='navbar-text mr-sm-4'>" . $mainController->getClientName() . "</span>";

if ($mainController->isClientLogged()){
    $logButton = "<a href=\"logout.php\" class=\"btn btn-sm btn-outline-danger my-2 my-sm-0\">Cerrar Sesión</a>";
}else{
    $logButton = "<a href=\"login.php\" class=\"btn btn-sm btn-outline-success my-2 my-sm-0\">Iniciar Sesión</a>";
}


?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Store</title>
  <link rel="stylesheet" href="css/style.css">
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
<body>
  <?php include ("Templates/header.php");?>
  <div class="container">
    <main>
      <div class="row">
        <?php foreach ($shopItems as $item) { ?>
          <div class="col-lg-3 col-sm-12 mb-3">
            <div class="card">
              <img src="<?= $mainController->getImgSrc($item['itemId'])?>" class="card-img-top" height="253" width="auto" alt="...">
              <div class="card-body">
                <h5 class="card-title font-weight-bold"><?= $item['itemName']?></h5>
                <p class="card-text price-text"><?= $item['itemPrice']?> €</p>
                <form action="main.php" method="get">
                  <input type="hidden" name="add_to_cart" value="true">
                  <input type="hidden" name="item" value="<?= $item['itemId']?>">
                  <button type="submit" class="btn btn-info col-12">Comprar</button>
                </form>
              </div>
            </div>
          </div>
        <?}?>
      </div>
    </main>
    <footer>

    </footer>
  </div>
</body>
</html>
