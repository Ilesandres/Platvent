<?php 

require_once '/platvent_2/php/controladores/config.php';
$conexionFactura = conectarDB();

if (!empty($_POST['idFactura'])) {
    $idFacturain = $_POST['idFactura'];

    $sql = "SELECT 
                    detalles.iddetalles, 
                    producto.img, 
                    producto.descripcion, 
                    producto.precioBase, 
                    detalles.cantidad, 
                    producto.unidadMedida, 
                    venta.total, estadoproducto.estado
                FROM 
                    producto
                INNER JOIN 
                    detalles ON detalles.idProducto = producto.id
                INNER JOIN 
                    venta ON venta.id = detalles.idVenta
                INNER JOIN 
                    estadoproducto ON estadoproducto.idestadoProducto = producto.estado
                WHERE 
                    detalles.idventa = ?";


    if ($stmt = $conexionFactura->prepare($sql)) {

        $stmt->bind_param('i', $idFacturain);


        $stmt->execute();


        $result = $stmt->get_result();

        if ($result) {
            if ($result->num_rows > 0) {
                $productsArray = array();
                while ($products = $result->fetch_assoc()) {
                    $productsArray[] = $products;
                }
                $response = array(
                    'mensaje' => 'respuesta del servidor',
                    'idFactura' => $idFacturain,
                    'productos' => $productsArray,
                );
                echo json_encode($response);
            } else {
                echo json_encode(array('mensaje' => 'No products found for this invoice ID'));
            }
        } else {
            echo json_encode(array('mensaje' => 'Error in executing query'));
        }
        
       
        $stmt->close();
    } else {
        echo json_encode(array('mensaje' => 'Error in preparing statement'));
    }
} else {
    echo json_encode(array('mensaje' => 'Invoice ID not provided'));
}

