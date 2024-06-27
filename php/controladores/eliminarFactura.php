<?php

require_once './config.php';

$con =conectarDB();

if(!empty($_POST['idfactura'])){
    $idfactura = $_POST['idfactura'];
    $sql="delete from detalles where idVenta ='$idfactura'" ;
    
    $facturaeliminar="delete from venta where id='$idfactura'";
    
    $facturaeliminarRes=$con->query($facturaeliminar);
    $sqlRes=$con->query($sql);
    
    if($sqlRes && $facturaeliminarRes){
        $response =array(
            'status' => 'success',
            'message' => 'Registro eliminado'
            
        );
    }else{
        $response =array(
        'status' => 'error',
        'message' => 'Error al eliminar'
        );
    }
    echo json_encode($response);
}