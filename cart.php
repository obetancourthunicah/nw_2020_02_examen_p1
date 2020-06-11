<?php
require_once "library.php";
$txtNombre = "";
$txtEmail = "";


if (isset($_POST["btnEmptyCart"])) {
  emptyCart();
}

if (isset($_POST["btnChange"])) {
  $crtcod = $_POST["btnChange"];
  $crtdias = intval($_POST["cmbdias"]);
  changeCartDays($crtcod, $crtdias);
}

if (isset($_POST["btnRemoveAll"])) {
  $crtcod = $_POST["btnRemoveAll"];
  removeFromCart($crtcod);
}

$arrCart = getCartItems();
/*
  13) Verificar si realizó un clic en el botón btnOrder
 */

  $arrOrden = array();
  $txtNombre = $_POST["txtNombre"];
  $txtEmail = $_POST["txtEmail"];
  $arrOrden["Cliente"] = $txtNombre;
  $arrOrden["Email"] = $txtEmail;
  $arrOrden["Cuartos"] = $arrCart;
  $arrOrden["Total"] = 0;
  $arrOrden["Fecha"] = date('Y-m-d');
  /*
  14) Calcular el total acumulando el producto  entre crtval y dias de cada elemento en la carretilla
  */
  


  addOrder($arrOrden);
  echo '<script>alert("Orden Agregada Satisfactoriamente"); location.assign("catalogue.php");</script>';
  die();


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carretilla de Compras</title>
</head>

<body>
  <h1>Reserva Hotel ABC Confirmar Reserva</h1>
  <a href="catalogue.php">Ir a Cuartos</a>
  <section>
    <table style="width:100%; border:1 solid #333">
      <thead>
        <tr>
          <th>Linea</th>
          <th>SKU</th>
          <th>Cuarto</th>
          <th>Días</th>
          <th>Precio</th>
          <th>Sub Total</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $lines = 0;
        $total = 0;
        foreach ($arrCart as $cart) {
          $lines++;
        ?>
          <tr>
            <form action="cart.php" method="post">
              <td><?php echo $lines; ?></td>
              <td><?php echo $cart["crtcod"]; ?></td>
              <td><?php echo $cart["crtnom"]; ?></td>
              <td>
                <select name="cmbdias">
                  <?php
                    for($i = 0; $i < 8 ; $i++){
                      echo '<option value="'. $i .'" '. (($cart["dias"] == $i)?" selected":"") .'>'. $i .' Día(s)</option>';
                    }
                  ?>
              </select>
              </td>
              <td><?php echo $cart["crtval"]; ?></td>
              <td>
                <?php
                echo ($cart["dias"] * $cart["crtval"]);
                $total += $cart["dias"] * $cart["crtval"];
                ?>
              </td>
              <td>

                <button type="submit" name="btnChange" value="<?php echo $cart["crtcod"]; ?>">Cambiar Días</button><br />
                <button type="submit" name="btnRemoveAll" value="<?php echo $cart["crtcod"]; ?>">Eliminar</button>

              </td>
            </form>
          </tr>
        <?php } ?>
      <tbody>
      <tfoot>
        <tr>
          <td>Total</td>
          <td><?php echo $total; ?></td>
          <td>&nbsp;</td>
          <td colspan="4">
            <form action="cart.php" method="post">
              <label for="txtNombre">Nombre Completo</label>
              <input type="text" name="txtNombre" id="txtNombre" value="<?php echo $txtNombre; ?>" />
              <br />
              <label for="txtEmail">Correo Electrónico</label>
              <input type="text" name="txtEmail" id="txtEmail" value="<?php echo $txtEmail; ?>" />
              <br />
              <button type="submit" name="btnOrder">Crear Orden</button>
            </form>
          </td>
      </tfoot>
    </table>
  </section>
  <section>
    <form action="catalogue.php" method="post">
      <button type="submit" name="btnEmptyCart">Cancelar Reserva</button>
    </form>
  </section>
</body>

</html>
