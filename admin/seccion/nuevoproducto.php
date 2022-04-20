<?php include("../template/cabecera.php");?>

<?php 
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");
/* echo $txtID."</br>";
echo $txtNombre."</br>";
echo $txtImagen."</br>";
echo $accion."</br>"; */

switch($accion){
    case "Agregar":
        
     // $sentenciaSQL= $conexion->prepare("INSERT INTO `muebles` (`id`, `nombre`, `imagen`) VALUES (NULL, 'cocina integral', 'imagen.jpg');");
    $sentenciaSQL=$conexion->prepare("INSERT INTO muebles (nombre,imagen,precio) VALUES (:nombre,:imagen,:precio);");
        $sentenciaSQL->bindParam(":nombre",$txtNombre);
        $sentenciaSQL->bindParam(":precio",$txtPrecio);

     // pondremos una fecha para diferenciar imgenes que pudieran subirse con el mismo nombre
     $fecha= new DateTime();
     $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
     //vamos ma utilizar una imagen temporal
     $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

     //validaremos si el temporal name contiene algo
     if($tmpImagen!=""){
        //  si es diferente de entonces vamos a mover la imagen a la carpeta + el nvo nom del archivo
        move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);

     }
        $sentenciaSQL->bindParam(":imagen",$nombreArchivo);
        $sentenciaSQL->execute();
        echo "";

        header("Location:nuevoproducto.php");

        break;
    case "Modificar":
        echo "";
        $sentenciaSQL=$conexion->prepare("UPDATE muebles SET nombre=:nombre, precio=:precio WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute(); 
// vamos a validar si hay algo en txtImagen nosotros alteramos los libros moviendo la imagen mientras sea el ID adecuado
   if($txtImagen!=""){

    // esta parte es para poder modificar la imagen
    $fecha= new DateTime();
    $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
    $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

    // se inserta en la carpeta de imagen
    move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);

// ESTO ES LO QUE PASA CON LA VIEJA IMAGEN PONEMOS ESTA INSTRUCCION PARA QUE LA ELIMINE
$sentenciaSQL=$conexion->prepare("SELECT imagen FROM muebles WHERE id=:id");
$sentenciaSQL->bindParam(":id",$txtID);
$sentenciaSQL->execute(); 
//   "LAZY" va hacer posible que yo pueda cargar los datos y rellenarlos 
$mueble=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
 

if(isset($mueble["imagen"]) &&($mueble["imagen"]!="imagen.jpg")){
   if (file_exists("../../img/".$mueble["imagen"])){
       unlink("../../img/".$mueble["imagen"]);
   }
}
// TERMINA INSTRUCCION DE BORRADO
//comienza instruccion de imagen nueva
    $sentenciaSQL=$conexion->prepare("UPDATE muebles SET imagen=:imagen WHERE id=:id");
    $sentenciaSQL->bindParam(':imagen',$nombreArchivo); //ponemos el nombre del archivo
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    header("Location:nuevoproducto.php");

   }

        break;
    case "Cancelar":
        echo "";
header("Location:nuevoproducto.php");

        break;
    case "Seleccionar":
            // echo "Haz presionado Seleccionar";
            // Haremos un consulta
          $sentenciaSQL=$conexion->prepare("SELECT * FROM muebles WHERE id=:id");
          $sentenciaSQL->bindParam(":id",$txtID);
          $sentenciaSQL->execute(); 
        //   esto va hacer posible que yo pueda cargar los datos y rellenarlos "LAZY"
          $mueble=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
          //nos va asignar los valores que se recuperaron de esa seleccion de la bd
          $txtNombre=$mueble['nombre'];
          $txtPrecio=$mueble['precio'];
          $txtImagen=$mueble['imagen'];

            break;
    case "Borrar":
        // vamos a leer el registro que tiene el valor de imagen
        $sentenciaSQL=$conexion->prepare("SELECT imagen FROM muebles WHERE id=:id");
        $sentenciaSQL->bindParam(":id",$txtID);
        $sentenciaSQL->execute(); 
      //   esto va hacer posible que yo pueda cargar los datos y rellenarlos "LAZY"
        $mueble=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
         
       
       if(isset($mueble["imagen"]) &&($mueble["imagen"]!="imagen.jpg")){
           if (file_exists("../../img/".$mueble["imagen"])){
               unlink("../../img/".$mueble["imagen"]);
           }
       }
         // echo "Haz presionado Borrar";
              $sentenciaSQL=$conexion->prepare("DELETE FROM muebles WHERE id=:id");
              $sentenciaSQL->bindParam(":id",$txtID);
              $sentenciaSQL->execute();
// me redireccione y me limpie los campos
              header("Location:nuevoproducto.php");
                break;

}
// seleccioname todos los muebles que estan en la tabla
$sentenciaSQL=$conexion->prepare("SELECT * FROM muebles");
// ejecutame esta instruccion sql
$sentenciaSQL->execute();
// recupera todos los registros para que yo lo pueda mostrar "fetch" la lista de muebles genera una asociacion entre los registros de la tabla 
$Listamuebles=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">
   

   <div class="card">
       <div class="card-header">
           Datos de muebles
       </div>
       <div class="card-body">
           

<!-- formulario de agregar muebles -->
           
               <form method="POST" enctype="multipart/form-data"> <!--pusimos enctype para que nos acepte fotos etc-->

        <!-- INICIA NUESTRO FORMULARIO -->
               <div class="form-group">        
      <label >ID:</label>
      <input type="text" required readonly class="form-control" name="txtID" value="<?php echo $txtID;?>" placeholder="id"> <!-- el id no es necesario pero el name sí -->
               </div>

               <div class="form-group">        
      <label >Nombre:</label>
      <input type="text" required class="form-control" name="txtNombre" value="<?php echo $txtNombre;?>" placeholder="nombre mueble">
               </div>

               <div class="form-group">        
      <label >Imagen:</label>

      <?php echo $txtImagen;?> <!--el valor de la imagen-->

      <?php if($txtImagen!=""){?>
        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen;?>" width="80" alt="" srcset="">
        <?php }?>

      <input type="file" required class="form-control" name="txtImagen" placeholder="imagen"> 
               </div>

               <div class="form-group">        
      <label >Precio $:</label>
      <input type="text" required class="form-control" name="txtPrecio" value="<?php echo $txtPrecio;?>" placeholder="nombre mueble">
               </div>

      <div class="btn-group" role="group" aria-label="Button group">
      <button type="submit" name="accion" value="Agregar" class="btn btn-dark">Agregar</button>
      <button type="submit" name="accion" value="Modificar" class="btn btn-dark">Modificar</button>
      <button type="submit" name="accion" value="Cancelar" class="btn btn-dark">Cancelar</button>
               </div>
    
</div>
</form>     
       
   </div>
</div>


<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del mueble</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
                      <!-- se abre llave for each dentro de un php-->
            <?php foreach($Listamuebles as $mueble){ ?> 
            <tr>
                <td> <?php echo $mueble['id'];?> </td>
                <td><?php echo $mueble['nombre'];?></td>

                <!-- crearemos una etiqueta sencilla para nosotros mostrarle donde esta la ruta -->
                
                <td>
                    <img class="img-thumbnail rounded" src="../../img/<?php echo $mueble['imagen'];?>" width="80" alt="" srcset="">
                 
                </td>

                <td>
               <form method="POST">
                   <input type="hidden" name="txtID" id="txtID" value="<?php echo $mueble['id'];?>"/>
                   <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />
                   <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />

               </form>

                </td>
            </tr>
            <!-- se cierra llave foreach dentro de un php -->
          <?php } ?>  
        </tbody>
    </table>
</div>

<?php include("../template/pie.php");?>