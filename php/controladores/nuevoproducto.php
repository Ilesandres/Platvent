<?php

require_once '../controladores/config.php';
$con = conectarDB();



if (!empty($_POST['btnregistrar'])) {
    if (
        !empty($_POST['nombre']) && !empty($_POST['cantidad']) && !empty($_POST['medida'])
        && !empty($_POST['estado']) && !empty($_POST['precioBase']) && (!empty($_POST['usuario']) && !empty($_POST['descripcion']))
    ) {
        $nombre = $con->real_escape_string($_POST['nombre']);
        $descripcion= $con->real_escape_string ($_POST['descripcion']);
        $cantidad = intval($_POST['cantidad']);
        $medida = $con->real_escape_string($_POST['medida']);
        $estadoValue = intval($_POST['estado']);
        $precioBase = floatval($_POST['precioBase']);
        $saldo = $precioBase * $cantidad;
        $estado = ($estadoValue);
        $iduser= intval($_POST['usuario']);

        $imgPath = 'default.png'; //imagen que se va a cargar por default

        if (!empty($_FILES['img']['tmp_name'])) {
            $ruta = '../../img/';
            $imagen = $_FILES['img']['tmp_name'];
            $nombreImagen = $_FILES['img']['name'];
            $tipoImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));

            if (in_array($tipoImagen, ['jpg', 'jpeg', 'png'])) {
                $idRegistro = null;

                $con->begin_transaction(); // Start transaction

                try {
                    $registro = $con->query("INSERT INTO producto(descripcion,descripcion_complete, stock, unidadMedida, saldo, estado, PrecioBase, idUsuario, img) VALUES ('$nombre','$descripcion', '$cantidad', '$medida', '$saldo', '$estado', '$precioBase','$iduser', '')");

                    if ($registro) {
                        $idRegistro = $con->insert_id;
                        $cam = $idRegistro . "-." . $tipoImagen;
                        $actualizarImg = $con->query("UPDATE producto SET img='$cam' WHERE id='$idRegistro'");

                        if ($actualizarImg) {
                            if (!is_dir($ruta)) {
                                mkdir($ruta, 0777, true);
                            }

                            if (move_uploaded_file($imagen, $ruta . $cam)) {
                                $con->commit(); // Commit transaction
                                echo '<div class="alert alert-info">Imagen guardada exitosamente</div>';
                                header("Location: " . $_SERVER['PHP_SELF'] . "?status=success&message=Producto creado con éxito");
                                exit();
                                
                            } else {
                                throw new Exception('No se pudo guardar tu imagen, vuelve a intentarlo');
                            }
                        } else {
                            throw new Exception('Error al actualizar la imagen en la base de datos');
                        }
                    } else {
                        throw new Exception('Error al registrar el producto: ' . $con->error);
                    }
                } catch (Exception $e) {
                    $con->rollback(); // Rollback transaction on error
                    echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
                    header("Location: " . $_SERVER['PHP_SELF'] . "?status=error&message=" . urlencode($e->getMessage()));
                    exit();
                }
            } else {
                echo '<div class="alert alert-info">Formato de imagen no aceptado</div>';
                header("Location: " . $_SERVER['PHP_SELF'] . "?status=error&message=Formato de imagen no aceptado");
                exit();
            }
        } else {
            $registro = $con->query("INSERT INTO producto(descripcion, stock, unidadMedida, saldo, estado, PrecioBase, img) VALUES ('$nombre', '$cantidad', '$medida', '$saldo', '$estado', '$precioBase', '$imgPath')");
            if ($registro) {
                echo '<div class="alert alert-info">Producto registrado sin imagen</div>';
                header("Location: " . $_SERVER['PHP_SELF'] . "?status=success&message=Producto registrado sin imagen");
                exit();
            } else {
                echo '<div class="alert alert-danger">Error al registrar el producto: ' . $con->error . '</div>';
                header("Location: " . $_SERVER['PHP_SELF'] . "?status=error&message=Error al registrar el producto: " . urlencode($con->error));
                exit();
            }
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        
        echo '<div class="alert alert-danger">Algunos campos están vacíos</div>';
        header("Location: " . $_SERVER['PHP_SELF'] . "?status=error&message=Algunos campos están vacíos");
        exit();
    }
}

?>
