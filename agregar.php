<?php
require_once "CarritoController.php";

$carrito = new CarritoController();
$carrito->agregarArticulo($_POST['nombre'], $_POST['cantidad'], $_POST['precio_unitario']);
header("Location: index.php");
exit();
