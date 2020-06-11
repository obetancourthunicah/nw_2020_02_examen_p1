<?php
/*
  10) incluir las funciones en library.php
 */

$arrExamen = getCurrentDB();
$categorias = $arrExamen["categorias"];
$cuartos = $arrExamen["cuartos"];
$selectvalue = "001";
if(isset($_SESSION["filter"])){
  $selectvalue = $_SESSION["filter"];
}

if(isset($_POST["btnDeleteSession"])){
  session_destroy();
  die("Sesión Eliminado");
}

if (isset($_POST["btnEmptyCart"])) {
  emptyCart();
}

if (isset($_POST["btnFiltrar"])) {
  $selectvalue = $_POST["cmbCategorias"];
  $_SESSION["filter"] = $selectvalue;
}

if (isset($_POST["btnAddToCart"])) {
  /*
    11) Obtener las variables del arreglo del formulario (post)
   */


  addToCart($habcod, $habctd);
}

$arrCart = getCartItems();

$getFilteredCuartos = array();

foreach ($cuartos as $cuarto) {
  if ($cuarto["catecod"] == $selectvalue) {
    $getFilteredCuartos[] = $cuarto;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reserva de Habitaciones Hotel ABC</title>
</head>

<body>
  <h1>Hotel ABC Sistema de Reservas</h1>
  <form action="catalogue.php" method="post">
    <label for="cmbCategorias">Categorías: </label>
    <select id="cmbCategorias" name="cmbCategorias">
      <?php
        /*
        12) usar la función arrayToCombo para obtener las opciones del combo de las categorias
        */
        
        
      ?>
    </select>
    <button type="submit" name="btnFiltrar">Filtrar</button>
  </form>
  <section>
    <ol>
      <?php foreach ($arrCart as $cart) { ?>
        <li><?php echo $cart["crtnom"]; ?> | <?php echo $cart["dias"] ?></li>
      <?php } ?>
    </ol>
    <a href="cart.php">Checkout</a>
  </section>
  <section>
    <?php
    foreach ($getFilteredCuartos as $cuarto) {
    ?>
      <h2><?php echo $cuarto["crtcod"];
          echo " | ";
          echo $cuarto["crtnom"]; ?></h2>
      <b>Precio Por Día: </b> <?php echo $cuarto["crtval"]; ?> <br />
      <form action="catalogue.php" method="post">
        <label for="cmbHabitaciones">Días de Reserva</label>
        <select name="cmbHabitaciones" id="cmbHabitaciones">
          <?php for ($i=1 ; $i<8 ; $i++) {
            ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?> Día(s)</option>
          <?php
            }
          ?>
        </select>
        <button type="submit" name="btnAddToCart" value="<?php echo $cuarto["crtcod"]; ?>">
          Reservar
        </button>
      </form>
    <?php
    }
    ?>
  </section>
  <section>
    <form action="catalogue.php" method="post">
      <button type="submit" name="btnEmptyCart">Delete Cart</button>
      <button type="submit" name="btnDeleteSession">Delete Sesión</button>
    </form>
  </section>
  <?php  print_r($arrCart); ?>
</body>

</html>
