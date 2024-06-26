<?php

require_once './config.php';

$con=conectarDB();

if(!empty($_POST['idFactura'])){
    $idFactura=$_POST['idFactura'];
    
        $sql="SELECT producto.*
                FROM producto
                LEFT JOIN detalles ON producto.id = detalles.idProducto AND detalles.idVenta = '$idFactura'
                WHERE detalles.idProducto IS NULL
                ORDER BY producto.id";
        
        $sqlRes=$con->query($sql);
        $productos= array();
        
        if($sqlRes->num_rows>0){
            while($row=$sqlRes->fetch_assoc()){
                $productos[]=$row;
            }
            $response=array(
                'status'=>'success',
                'productos'=>$productos
            );
            
        }else{
            $response=array(
                'status'=>'error',
                'message'=>'No hay productos disponibles'
            );
        }
    
    
    echo json_encode($response);
}
