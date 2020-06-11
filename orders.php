<?php

require_once "library.php";

$arrDB = getCurrentDB();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ordenes</title>
</head>

<body>
  <h1>Reservas Hotel ABC</h1>
  <?php
  /*
          15) Realizar un ciclo por todas las reservas, 
          recuerde cerrar el ciclo donde corresponde
  */
  
  ?>
    <section>
      <b>Cliente:</b> <?php echo $orden["Cliente"]; ?> <br />
      <b>Correo:</b> <?php echo $orden["Email"]; ?> <br />
      <b>Fecha:</b> <?php echo $orden["Fecha"]; ?> <br />
      <b>Cuartos</b> <br />
      <table style="width:100%;" border=1>
        <?php
        $linea =0 ;
        foreach ($orden["Cuartos"] as $crt) {
          $linea ++;
        ?>
          <tr>
            <td><?php echo $linea; ?></td>
            <td><?php echo $crt["crtcod"] . " " . $crt["crtnom"]; ?></td>
            <td><?php echo $crt["dias"]; ?> Día(s)</td>
            <td><?php echo $crt["dias"] * $crt["crtval"]; ?></td>
          </tr>
        <?php } //productos
        ?>
        <tr>
          <td></td>
          <td></td>
          <td>Total</td>
          <td><?php echo $orden["Total"]; ?></td>
        </tr>
      </table>
    </section>
    <hr/>
  <?php
    
  ?>
</body>

</html>
