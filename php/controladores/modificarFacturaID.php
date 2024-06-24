
<?php

require_once '../controladores/config.php';

$con=conectarDB();



if(!empty($_POST['idFactura']) && !empty($_POST['idVendedor']) && !empty($_POST['id_cliente']) && !empty($_POST['estadofactura']) ){

    $idFactura=$_POST['idFactura'];
    $idVendedor=$_POST['idVendedor'];
    $id_cliente=$_POST['id_cliente'];
    $estadofactura=$_POST['estadofactura'];
    $ciNit=$_POST['ciNIt'];
    
    
   $sql="update venta set idUsuario='$idVendedor', idCliente='$id_cliente', idestado='$estadofactura' where id='$idFactura' ";
    
    $res=$con->query($sql);
    if($res){
    
        $response =array(
            'status' => 'success',
            'message' => 'Factura actualizada con éxito',
            'idFactura' => $idFactura,
            'idVendedor' => $idVendedor,
            'id_cliente' => $id_cliente,
            'estadofactura' => $estadofactura,
            'ciNit'=>$ciNit,
            
            
        );
        echo json_encode($response);
    }else{
        $response=array(
            'status'=>'ERROR',
            'message'=>'Error al actualizar la factura',
        );
    
    }
    
#code
}