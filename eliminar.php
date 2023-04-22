<?php
require_once "CarritoController.php";

$carrito = new CarritoController();
$carrito->eliminarArticulo($_GET['id']);
