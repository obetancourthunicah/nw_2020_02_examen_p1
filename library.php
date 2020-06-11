<?php
session_start();

function emptyCart(){
  if(isset($_SESSION["cart"])){
    /*
    1) Setear la carretilla en la sesión como un elemento vacio
   */
    

  }
  
}

function changeCartDays($habitacionCod, $cantidad){
  $arrCart = array();
  if (isset($_SESSION["cart"])) {
    $arrCart = $_SESSION["cart"];
  }
  $newCart = array();
  foreach ($arrCart as $cart) {
    if ($cart["crtcod"] == $habitacionCod) {
      $cart["dias"] = $cantidad;
    }
    if ($cart["dias"] <=0 ) {
      
    }else {
      $newCart[] = $cart;
    }
  }
  $_SESSION["cart"] = $newCart;
}

function removeFromCart($habitacionCod)
{
  $arrCart = array();
  if (isset($_SESSION["cart"])) {
    $arrCart = $_SESSION["cart"];
  }
  $newCart = array();
  foreach ($arrCart as $cart) {
    /*
    2) Si la la llave del diccionario crtcod es igual a $habitacionCod Eliminar de la carretila
    3) Si no agregar al arreglo  $newCart para mantener en la carretilla
     */
    



    
  }
  $_SESSION["cart"] = $newCart;
}


function addToCart($habitacionCod, $dias){
  /* Trabajar Aqui */
  /*
    4) Iniciar variable de tipo arreglo (lista) vacia;
    5) Revisar si exista en sesión una copia del arreglo, si existe asignarla a la lista (1)
    6) Obtener la lista de los cuartos de la Base de Datos
    7) Obtener el diccionario donde el valor de la llave crtcod de la lista de cuartos es igual a habitacionCod
    8) Buscar si existe la reserva en la carretilla actual
    9) Si existe actualizar el valor de días y modificar la carretilla
   */

  $arrCart = ????? ;
  
  if(isset( ???? ){
    $arrCart = ?????;
  }
  $cuarto = array();
  $arrCuartos = getCurrentDB()[?????];
  foreach($arrCuartos as $icuarto){
    if($icuarto["crtcod"] == $habitacionCod){
      ????;
      break;
    }
  }
  $existOnCart = false;
  $newCart = array();
  foreach($arrCart as $cart) {
    if ($cart["crtcod"] == $habitacionCod){
      ?????
      ?????
    }
    $newCart[] = $cart;
  }
  if(!$existOnCart){
    $cuarto["dias"] = $dias;
    $newCart[] = $cuarto;
  }

  $_SESSION["cart"] = $newCart;
}

function getCartItems(){
  $arrCart = array();
  if (isset($_SESSION["cart"])) {
    $arrCart = $_SESSION["cart"];
  }
  return $arrCart;
}


function addOrder($arrReserva){
  $arrExamen = getCurrentDB();
  $arrExamen["reservas"][] = $arrReserva;
  saveDB($arrExamen);
  emptyCart();
}

function arrayToCombo($arreglo, $valueField, $textField, $selectedValue){
  $htmlBuffer = "";
  foreach ($arreglo as $item) {
    $htmlBuffer .= '<option value="'.$item[$valueField].'" '.(($selectedValue == $item[$valueField])? "selected" : "" ).'>'.$item[$textField].'</option>';
  }
  return $htmlBuffer;
}

function getCurrentDB(){
  $arrExamen = array();
  if(isset($_SESSION['arrExamen'])){
    $arrExamen = $_SESSION['arrExamen'];
    return $arrExamen;
  }
  if(file_exists("examen.json")) {
    $rawjson = file_get_contents("examen.json");
    $arrExamen = json_decode($rawjson , true);
    $_SESSION["arrExamen"] = $arrExamen;
    return $arrExamen;
  }
  $arrExamen = initCurrentDB();
  $_SESSION["arrExamen"] = $arrExamen;
  return $arrExamen;
}

function initCurrentDB(){
  $arrExamen = array();
  $arrExamen["cuartos"] = array();
  $arrExamen["categorias"] = array();
  $arrExamen["reservas"] = array();

  $categorias = array();
  $categorias[] = array("catecod"=>"001", "catenom"=>"Sencillas");
  $categorias[] = array("catecod" => "002", "catenom" => "Dobles");
  $categorias[] = array("catecod" => "003", "catenom" => "Triples");
  $arrExamen['categorias'] = $categorias;

  $cuartos = array();
  $cuartos[] = array("crtcod" => "CRT01", "crtnom" => "Económico en Edificio", "catecod" => "001", "crtval" => 500.00);
  $cuartos[] = array("crtcod" => "CRT02", "crtnom" => "Vista al Mar", "catecod" => "001", "crtval" => 600.00);
  $cuartos[] = array("crtcod" => "CRT03", "crtnom" => "Area Piscina", "catecod" => "001", "crtval" => 700.00);

  $cuartos[] = array("crtcod" => "CRT04", "crtnom" => "Edificio", "catecod" => "002", "crtval" => 1000.00);
  $cuartos[] = array("crtcod" => "CRT05", "crtnom" => "Vista al Mar", "catecod" => "002", "crtval" => 1100.00);
  $cuartos[] = array("crtcod" => "CRT06", "crtnom" => "Area Piscina", "catecod" => "002", "crtval" => 1300.00);

  $cuartos[] = array("crtcod" => "CRT07", "crtnom" => "Edificio", "catecod" => "003", "crtval" => 1400.00);
  $cuartos[] = array("crtcod" => "CRT08", "crtnom" => "Vista al Mar", "catecod" => "003", "crtval" => 1700.00);
  $cuartos[] = array("crtcod" => "CRT09", "crtnom" => "Area Piscina", "catecod" => "003", "crtval" => 2000.00);

  $arrExamen["cuartos"] = $cuartos;

  $_SESSION["arrExamen"] = $arrExamen;

  $rawjson = json_encode($arrExamen);
  file_put_contents("examen.json", $rawjson);

  return $arrExamen;
}

function saveDB($arrExamen){
  $_SESSION["arrExamen"] = $arrExamen;
  $rawjson = json_encode($arrExamen);
  file_put_contents("examen.json", $rawjson);
}




?>
