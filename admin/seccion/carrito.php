<?php 

$mensaje="";

if(isset($_POST['btnAccion'])){

    switch($_POST['btnAccion']){

        case "Agregar":

            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
                $mensaje=" id : " . $ID."</br>";
            }else{
                $mensaje="no es el id";
                break; 
            }
            if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
                $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
                $mensaje="nombre : ".$NOMBRE."</br>";
            }else{
                $mensaje="no es el nombre";
                break;
            }
            if(is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))){
                $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
                $mensaje="precio : ".$PRECIO;
            }else{
                $mensaje="no es el precio";
            break;
            }
           
           if(is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))){
               $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
               $mensaje ="cantidad : ".$CANTIDAD;
           }else{
               $mensaje="no hay cantidad";
           break;
        }
        // estamos validando una variable de sesion que tendra el nombrre de carrito
         if(!isset($_SESSION['CARRITO'])){
// si no tiene nada 
          $producto=array(
           'ID'=>$ID,
           'NOMBRE'=>$NOMBRE,
           'PRECIO'=>$PRECIO,
           'CANTIDAD'=>$CANTIDAD
          );
          $_SESSION['CARRITO'][0]=$producto;
         }else{
            //  funcion que nos sirve para contabilizar
             $NumeroProducto=count($_SESSION['CARRITO']);
            //  recuperar los datos del producto seleccionado
            $producto=array(
                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
                'PRECIO'=>$PRECIO,
                'CANTIDAD'=>$CANTIDAD
               );
               $_SESSION['CARRITO']['NumeroProducto']=$producto;
         }
         $mensaje=print_r($_SESSION,true);

         break;
    }
}
?>