<?php
require __DIR__ . '/../vendor/autoload.php';

use ShoppingCart\Controller\MainController;

$mainController = new MainController();


if (isset($_REQUEST['add_to_cart'])) {
    $mainController->addItemToCart($_REQUEST['item']);
}

if (isset($_REQUEST['remove'])) {
    $mainController->removeItemInCart($_REQUEST['remove']);
}

$shopItems = $mainController->getAllShopItems();
$cartItemsAmount = $mainController->getCartItemsAmount();

$items = $mainController->getCartItems();
$subTotal = 0;

$cartIcon = "<a href=\"cart.php\" class='mr-4'><span class=\"h6 mr-3 text-white\">" . $cartItemsAmount . "</span><img src=\"img/cart.png\" alt=\"Cart\" width=\"20\" height=\"18\"></a>";
$nameCl = $mainController->getClientName();
$clientName = "<span class='navbar-text mr-sm-4'>" . $mainController->getClientName() . "</span>";

if ($mainController->isClientLogged()) {
    $logButton = "<a href=\"logout.php\" class=\"btn btn-sm btn-outline-danger my-2 my-sm-0\">Cerrar Sesión</a>";
} else {
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
  <title>VapeStore - Carrito</title>
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
<?php include("Templates/header.php"); ?>
<div class="container">
  <div class="w-75 mx-auto">
    <table class="table table-striped">
      <thead>
      <tr>
        <th style="width: 10%" scope="col">Cantidad</th>
        <th style="width: 50%" scope="col">Articulo</th>
        <th class="text-center" style="width: 20%" scope="col">Precio</th>
        <th class="text-center" style="width: 20%" scope="col">Eliminar</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($items as $item) {
          $sItem = $mainController->getItemFromShop($item['itemId']);
          $subTotal += $sItem->getPrice(); ?>
        <tr>
          <td class="text-center"><?= $item['quantity'] ?></td>
          <td><?= $sItem->getName() ?></td>
          <td class="text-center"><?= $sItem->getPrice() / 100 . " €" ?></td>
          <td class="text-center"><a href="cart.php?remove=<?=$item['itemId']?>"><img src="img/delete.png" alt="Eliminar"></a></td>
        </tr>
      <? } ?>
      </tbody>
    </table>
    <div class="d-flex justify-content-end">
      <table class="table w-50">
        <thead>
        <tr>
          <th style="width: 70%" scope="col"></th>
          <th style="width: 30%" scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Subtotal:</td>
          <td><?= $subTotal / 100 ?> €</td>
        </tr>
        <tr>
          <td>Gastos de Envio:</td>
          <td>10 €</td>
        </tr>
        <tr>
          <td><strong>Total:</strong></td>
          <td><strong><?= $subTotal / 100 + 10 ?> €</strong></td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-end">
      <div class="w-50 d-flex justify-content-around">
        <a href="main.php" class="btn btn-info" style="width: 120px;">Volver</a>
        <? if ($mainController->isClientLogged()){?>
          <a href="#" class="btn btn-success" style="width: 200px;">Pagar</a>
        <?}else{?>
          <a href="login.php" class="btn btn-success" style="width: 200px;">Iniciar Sesión</a>
        <?}?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
