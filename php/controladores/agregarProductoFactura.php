
<?php

require_once '/platvent_2/php/controladores/config.php';

$conn =conectarDB();

if (!empty($_POST['idProduct']) && !empty($_POST['idFactura']) && !empty($_POST['cantidad'])) {
    $idProduct = $_POST['idProduct'];
    $idFactura = $_POST['idFactura'];
    $cantidadPro= $_POST['cantidad'];

    // Consulta para obtener detalles del producto
    $producto = "SELECT * FROM producto WHERE id='$idProduct'";
    $productoRes = $conn->query($producto);

    if ($productoRes && $productoRes->num_rows > 0) {
        $productoData = $productoRes->fetch_assoc();
        $precioBase = $productoData['precioBase'];

    
        $sql = "INSERT INTO detalles (idVenta, idProducto, cantidad, precioUnitario) VALUES ('$idFactura', '$idProduct', '$cantidadPro','$precioBase')";
      
        $sqlRes=$conn->query($sql);
        
        if ($sqlRes) {
            $response = array(
                'message' => 'producta añadido',
                'idProduct' => $idProduct,
                'precio' => $precioBase,
                'cantidad '=>$cantidadPro,
            );
        } else {
            $response = array(
                'message' => 'error',
                'error' => 'No se pudo insertar en la tabla detalles: ' . $conn->error,
            );
        }
    } else {
        $response = array(
            'message' => 'error',
            'error' => 'Producto no encontrado',
        );
    }

    echo json_encode($response);
} else {
    $response = array(
        'message' => 'error',
        'error' => 'ID del producto o de la factura no proporcionado',
    );
    echo json_encode($response);
}
