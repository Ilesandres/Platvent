<?php 

require_once '../controladores/config.php';
$conn=conectarDB();

if(!empty($_POST['idFactura']) && !empty($_POST['total']) ){

    $idFactura=$_POST['idFactura'];
    $total=$_POST['total'];
    
    $sql="update venta set total='$total' where id='$idFactura'";
    $sqlRes=$conn->query($sql);
    
    if($sqlRes){
        $response=array(
         'status'=>'success',
         'message'=>'Se ha actualizado el total de la factura con éxito',
         'total'=>$total,
         'idFactura'=>$idFactura,
        
        );
        echo json_encode($response);
    
    }else{
        $response=array(
        'status'=>'error',
        'message'=>'Error al actualizar el total de la factura',
        );
        
        echo json_encode($response);
    
    }
    
}