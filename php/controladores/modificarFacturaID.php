
<?php

require_once '/platvent_2/php/controladores/config.php';

$con=conectarDB();



if(!empty($_POST['idFactura']) && !empty($_POST['idVendedor']) && !empty($_POST['id_cliente']) && !empty($_POST['estadofactura']) ){

    $idFactura=$_POST['idFactura'];
    $idVendedor=$_POST['idVendedor'];
    $id_cliente=$_POST['id_cliente'];
    $estadofactura=$_POST['estadofactura'];
    $ciNit=$_POST['ciNIt'];
    $total=0;
    
    
   $sql="update venta set idUsuario='$idVendedor', idCliente='$id_cliente', total='$total', idestado='$estadofactura' where id='$idFactura' ";
    
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