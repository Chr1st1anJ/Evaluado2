<?php
class CarritoModel {
  private $db;

  function __construct($db) {
    $this->db = $db;
    $this->crearTabla();
  }

  function crearTabla() {
    $this->db->query("CREATE TABLE IF NOT EXISTS articulos (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(255) NOT NULL,
                        cantidad INT NOT NULL,
                        precio_unitario DECIMAL(10,2) NOT NULL,
                        precio_total DECIMAL(10,2) NOT NULL
                      )");
  }

  function agregarArticulo($nombre, $cantidad, $precio_unitario) {
    $precio_total = $cantidad * $precio_unitario;
    $this->db->query("INSERT INTO articulos (nombre, cantidad, precio_unitario, precio_total)
                      VALUES ('$nombre', $cantidad, $precio_unitario, $precio_total)");
  }

  function obtenerArticulos() {
    return $this->db->query("SELECT * FROM articulos");
  }

  function actualizarCantidad($id, $cantidad) {
    $precio_unitario = $this->obtenerPrecioUnitario($id);
    $precio_total = $cantidad * $precio_unitario;
    $this->db->query("UPDATE articulos SET cantidad=$cantidad, precio_total=$precio_total WHERE id=$id");
  }

  function eliminarArticulo($id) {
    $this->db->query("DELETE FROM articulos WHERE id=$id");
  }

  function obtenerPrecioUnitario($id) {
    $result = $this->db->query("SELECT precio_unitario FROM articulos WHERE id=$id");
    $fila = $result->fetch_assoc();
    return $fila['precio_unitario'];
  }

  function obtenerTotal() {
    $result = $this->db->query("SELECT SUM(precio_total) as total FROM articulos");
    $fila = $result->fetch_assoc();
    return $fila['total'];
  }
}
