<!-- nos conectaremos a una base datos -->
<?php
// vamos generar variables que van a tener algunos valores
define("KEY","IBARRA");
define("COD","AES-128-ECB");
$host="localhost";
$bd="sitio";
$usuario="root";
$contrasenia="";

try {
    // sin el PDO no permitira entrar a la BD
    $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
    // si la conexion se ejecuto imprimir
    // if($conexion){echo "conectado al sistema";  }
} 
// el exception lanza error en caso de que ocurra una falla
 catch (Exception $ex) {
    echo $ex->getMessage();
}
?>