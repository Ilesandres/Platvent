<?php 

require_once './config.php';

$con = conectarDB();

if (!empty($_POST['idFactura']) && !empty($_POST['idProducto']) && !empty($_POST['cantidad'])) {
    $idFactura = $_POST['idFactura'];
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];
    
    $productoStock = $con->query("SELECT * FROM producto WHERE id='$idProducto'");
    
    if ($productoStock && $productoStock->num_rows > 0) {
        $productoData = $productoStock->fetch_assoc();
        $cantidadStock = $productoData['stock'];
        
        $updateProducto = $con->query("SELECT * FROM detalles WHERE idVenta='$idFactura' AND idProducto='$idProducto'");
        
        if ($updateProducto && $updateProducto->num_rows > 0) {
            $detalleData = $updateProducto->fetch_assoc();
            $cantidadAnterior = $detalleData['cantidad'];
             
            $cantidadFinal = $cantidadAnterior - $cantidad;
            $cantidadCompare = $cantidadStock + $cantidadFinal;
            
            $actualizarCantidad = $con->query("UPDATE producto SET stock='$cantidadCompare' WHERE id='$idProducto'");
            
            if ($actualizarCantidad) {
                $sql = $con->query("UPDATE detalles SET cantidad='$cantidad' WHERE idVenta='$idFactura' AND idProducto='$idProducto'");
                
                if ($sql) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Producto editado en la factura',
                    );
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Error al editar el producto',
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Error al actualizar el stock del producto',
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Detalles del producto no encontrados',
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Producto no encontrado',
        );
    }
    
    echo json_encode($response);
}

$con->close();
?>
