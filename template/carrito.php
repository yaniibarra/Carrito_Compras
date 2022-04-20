<?php session_start();
    $mensaje = '';
    if (isset($_POST['btnAccion'])) {
        switch ($_POST['btnAccion']) {
            case 'Agregar':
                if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                    $id = openssl_decrypt($_POST['id'], COD, KEY);
                    $mensaje .= 'OK ID correcto.'. '<br/>';
                } else {
                    $mensaje .= 'Upsss... ID incorrecto.'.'<br/>';
                }
                if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                    $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
                    $mensaje .= 'OK NOMBRE correcto'. '<br/>';
                } else {
                    $mensaje .= 'Upsss... NOMBRE incorrecto.'.'<br/>';
                }
                if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
                    $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
                    $mensaje .= 'OK CANTIDAD correcto.'. '<br/>';
                } else {
                    $mensaje .= 'Upsss... CANTIDAD incorrecto.'.'<br/>';
                }
                if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                    $precio = openssl_decrypt($_POST['precio'], COD, KEY);
                    $mensaje .= 'OK PRECIO correcto.'. '<br/>';
                } else {
                    $mensaje .= 'Upsss... PRECIO incorrecto.'.'<br/>';
                }

                if (!isset($_SESSION['carrito'])) {
                    $producto = array(
                        'id' => $id,
                        'nombre' => $nombre,
                        'precio' => $precio,
                        'cantidad' => $cantidad
                    );
                    $_SESSION['carrito'][0] = $producto;
                    $mensaje = "Producto agregado al carrito";
                } else {
                    $idProductos = array_column($_SESSION['carrito'], 'id');
                    if (in_array($id, $idProductos)) {
                        echo '<script>console.log("El producto ya ha sido seleccionado");</script>';
                        $mensaje = "";
                    } else {
                        $numeroProductos = count($_SESSION['carrito']);
                        $producto = array(
                            'id' => $id,
                            'nombre' => $nombre,
                            'precio' => $precio,
                            'cantidad' => $cantidad
                        );
                        $_SESSION['carrito'][$numeroProductos] = $producto;
                        $mensaje = "Producto agregado al carrito";
                    }
                }
                // $mensaje = print_r($_SESSION, true);
            break;
            case "Eliminar":
                if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                    $id = openssl_decrypt($_POST['id'], COD, KEY);
                    foreach ($_SESSION['carrito'] as $indice => $producto) {
                        if ($producto['id'] == $id) {
                            unset($_SESSION['carrito'][$indice]);
                            echo '<script>console.log("Elemento eliminado...");</script>';
                        }
                    }
                } else {
                    $mensaje .= 'Upsss... ID incorrecto' . '<br/>';
                }
            break;
            default:
                # code...
                break;
        }
    }


?>