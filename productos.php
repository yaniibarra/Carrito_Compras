<?php include("template/cabecera.php");?> 


<?php 
include('admin/config/bd.php');
include('template/carrito.php');

// seleccioname todos los muebles que estan en la tabla
$sentenciaSQL=$conexion->prepare("SELECT * FROM muebles");
// ejecutame esta instruccion sql
$sentenciaSQL->execute();
// recupera todos los registros para que yo lo pueda mostrar "fetch" la lista de muebles genera una asociacion entre los registros de la tabla 
$Listamuebles=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"   integrity="sha384-q8i/X       +965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2  +9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3  +MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <title>Compra tus muebles</title>
</head>
<body>

<?php if ($mensaje !=""){ ?>
  <div class="alert alert-success" >
  
    <?php  echo $mensaje; ?>
   
    <a href="MostrarCarrito.php" class="badge badge-success">Ver carrito</a>
  </div>
  <?php } ?>
 <!-- VA A GIRAR CADA VEZ QUE ENCUENTRE UN mueble Y SOLO VAMOS A PONER UN NOMBRE -->
<!-- este elemento contiene 3 tarjetas -->


<?php foreach($Listamuebles as $mueble){?>
        <div class="col-md-4">
        <div class="card">
   <img class="card-img-top" height="250" src="./img/<?php echo $mueble['imagen'];?>" alt="">
     <div class="card-body">
        <h4 class="card-title"><?php echo $mueble['nombre'];?></h4>
        <h4 class="card-title">$ <?php echo $mueble['precio'];?></h4>
 
<!-- el form hara que se envie la info del mueble que se esta seleccionando al carrito -->
      <form action="" method="post">
     <input type="hidden"  name="id" id="id" value="<?php echo openssl_encrypt($mueble['id'],COD,KEY) ;?>" >
        
     <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($mueble['nombre'],COD,KEY);?>">

    <input type="hidden" name="precio" id="precio" value="$ <?php echo openssl_encrypt($mueble['precio'],COD,KEY);?>">

    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
        <!-- agrego el boton detro del formulario -->
         <div>
      <button type="submit" name="btnAccion" value="Agregar" class="btn btn-primary">Agregar al carrito</button>
        </div>
     </form>
    </div>
  </div>
</div>

<!-- <div class="col-md-3">

    

</div> -->
<?php }?> 
</body>
</html>


<?php include("template/pie.php");?> 