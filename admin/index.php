
<!-- abrimos php para almacenar datos de nuestro formulario en esta misma pagina -->
<?php
// le indicamos con una condicional que si ahí un envio de tipo POST nos redireccione a algun lugar

 if(isset($_POST["btnLogin"])){

    include("./config/bd.php");
    $txtuser=($_POST['txtuser']);
    $txtpass=($_POST['txtpass']);

$sentenciaSQL=$conexion->prepare("SELECT * FROM entrar WHERE nombre=:nombre AND passw=:passw");

$sentenciaSQL->bindParam("nombre",$txtuser, PDO::PARAM_STR);
$sentenciaSQL->bindParam("passw",$txtpass, PDO::PARAM_STR);
$sentenciaSQL->execute();

$numeroRegistros=$sentenciaSQL->rowCount();

// para recuperar informacion
$registro=$sentenciaSQL->fetch(PDO::FETCH_ASSOC);
//lo utilizo por que voy a poner variables de tipo session para poder acceder a las secciones siempre y cuando halla un session 
print_r($registro);

session_start();
$_SESSION['user']=$registro;

if($numeroRegistros>=1){

  echo "Bienvenido...";
  header("Location:inicioo.php");
}else{
   $mensaje="Usuario o contraseña incorrectos";
}

 }

/* if($_POST){
  if($sentenciaSQL=$conexion->prepare("SELECT * FROM entrar WHERE nombre=:user and passw=:pass"));{
    $sentenciaSQL->bindParam(":nombre",$user);
    $sentenciaSQL->bindParam(":passw",$pass);
    $sentenciaSQL->execute(); 
  //   esto va hacer posible que yo pueda cargar los datos y rellenarlos "LAZY"
    $mueble=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    //nos va asignar los valores que se recuperaron de esa seleccion de la bd
    $user=$mueble['nombre'];
    $pass=$mueble['passw'];
    $_SESSION['user']="ok";
    header('Location:inicioo.php');
  }
  
 
}else {
  $mensaje="Error: usuario o contraseña incorrectos";

}
 */

/* if($_POST){
  if(($_POST['user']=="yan")&&($_POST['pass']=="sistema")){ 

    
    $_SESSION['user']="ok";
    $_SESSION['nombreUsuario']="yan";
    header('Location:inicioo.php');
   
  } else {
      $mensaje="Error: usuario o contraseña incorrectos";

  }
 
} */
 
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login administrador</title>
    <!-- ponemos b4-$ para mostrar la integracion de bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
   <!-- estructura que nos va a mostrar el formulario b4 grid def -->
   <div class="container">
       <div class="row">

       <!-- este col grid de 4 es para que quede en medio nuestro login -->
   <div class="col-md-4">
  
   </div>
       <!-- ------- -->
           <div class="col-md-4"> <!-- agregamos un valor md y 12,estamos ocupando todo el espacio -->
           <!-- br para crear un salto de la cabecera al login  -->
         <br/><br/>

           <div class="card">
               <div class="card-header">
                   LOGIN
           </div> <!--cierra div class card-->
               <div class="card-body">


               <!-- mensaje de alerta  -->
               <?php if(isset($mensaje)){?>
           <div class="alert alert-danger" role="alert">
             <?php echo $mensaje;?>
           </div>
            <?php } ?>
          
          
<form method="POST">
        <!-- INICIA NUESTRO FORMULARIO -->
               <div class="form-group">        
      <label >Usuario</label>
      <input type="text" class="form-control" name="txtuser"  placeholder="ingrese su usuario"> <!-- el id no es necesario pero el name sí -->
      
               </div>
               <div class="form-group">
      <label>Contraseña</label>
      <input type="password" class="form-control" name="txtpass" placeholder="contraseña">
               </div>
     
               <button type="submit" name="btnLogin" class="btn btn-dark">Entrar</button>
</form>     
               </div>
               <div class="card-footer text-muted">
                   
               </div>
           </div>

           </div>
           
       </div>
   </div>
  </body>
</html>