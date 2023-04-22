<?php
require_once "CarritoController.php";

$carrito = new CarritoController();
$carrito->actualizarCantidad($_GET['id'], $_GET['cantidad']);
