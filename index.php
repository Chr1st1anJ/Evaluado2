<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Registro de compras</title>
  </head>
  <body>
    <h1>Registro de compras</h1>
    <form action="agregar.php" method="post">
      <label for="nombre">Nombre del artículo:</label>
      <input type="text" id="nombre" name="nombre" required><br>
      <label for="cantidad">Cantidad:</label>
      <input type="number" id="cantidad" name="cantidad" required><br>
      <label for="precio_unitario">Precio unitario:</label>
      <input type="number" id="precio_unitario" name="precio_unitario" required><br>
      <input type="submit" value="Agregar al carrito">
      <input type="reset" value="Reiniciar lista">
    </form>
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Cantidad</th>
          <th>Precio unitario</th>
          <th>Precio total</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include "CarritoController.php";
        $carrito = new CarritoController();
        $articulos = $carrito->obtenerArticulos();
        while ($fila = $articulos->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $fila['nombre'] . "</td>";
          echo "<td><input type='number' value='" . $fila['cantidad'] . "' min='1' onchange='actualizarCantidad(" . $fila['id'] . ", this.value)'></td>";
          echo "<td>" . $fila['precio_unitario'] . "</td>";
          echo "<td>" . $fila['precio_total'] . "</td>";
          echo "<td><button onclick='eliminarArticulo(" . $fila['id'] . ")'>Eliminar</button></td>";
          echo "</tr>";
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3">Total:</td>
          <td><?php echo $carrito->obtenerTotal(); ?></td>
          <td></td>
        </tr>
      </tfoot>
    </table>
    <script>
      function actualizarCantidad(id, cantidad) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            location.reload();
          }
        };
        xhttp.open("GET", "actualizar.php?id=" + id + "&cantidad=" + cantidad, true);
        xhttp.send();
      }

      function eliminarArticulo(id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            location.reload();
          }
        };
        xhttp.open("GET", "eliminar.php?id=" + id, true);
        xhttp.send();
      }
    </script>
  </body>
</html>
