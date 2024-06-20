
<?php

require_once '/platvent_2/php/controladores/config.php';

$con=conectarDB();



if(!empty($_POST['idFactura']) && !empty($_POST['idVendedor']) && !empty($_POST['id_cliente']) && !empty($_POST['estadofactura']) ){

    $idFactura=$_POST['idFactura'];
    $idVendedor=$_POST['idVendedor'];
    $id_cliente=$_POST['id_cliente'];
    $estadofactura=$_POST['estadofactura'];
    
    $response =array(
        'status' => 'success',
        'message' => 'Factura actualizada con éxito',
        'idFactura' => $idFactura,
        'idVendedor' => $idVendedor,
        'id_cliente' => $id_cliente,
        'estadofactura' => $estadofactura,
        
        
    );
    echo json_encode($response);
#code
}