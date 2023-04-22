<?php
require_once "CarritoModel.php";

class CarritoController {
  private $model;

  function __construct() {
    $this->model = new CarritoModel(new mysqli('localhost', 'root', '', 'superselectos'));
  }

  function agregarArticulo($nombre, $cantidad, $precio_unitario) {
    $this->model->agregarArticulo($nombre, $cantidad, $precio_unitario);
  }

  function obtenerArticulos() {
    return $this->model->obtenerArticulos();
  }

  function actualizarCantidad($id, $cantidad) {
    $this->model->actualizarCantidad($id, $cantidad);
  }

  function eliminarArticulo($id) {
    $this->model->eliminarArticulo($id);
  }

  function obtenerTotal() {
    return $this->model->obtenerTotal();
  }
}
