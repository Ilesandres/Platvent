<?php

require_once './config.php';

$con=conectarDB();

if(!empty($_POST['idFactura']) && !empty($_POST['idProducto'])){
    $idFactura=$_POST['idFactura'];
    $idProducto=$_POST['idProducto'];
    
    $sql="delete from detalles where detalles.idProducto='$idProducto' and detalles.idVenta='$idFactura'";
    
    $sqlRes=$con->query($sql);
    
    if($sqlRes){
        $response=array(
        'status' => 'success',
        'message' => 'se elimino el producto de la factura'
    );
    }else{
        $response=array(
            'status'=>'error',
            'message'=>'no se elimino el producto de la factura'
        );
    }
    
    
    
    echo json_encode($response);

}
