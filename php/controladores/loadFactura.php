<?php 

require_once '/platvent_2/php/controladores/config.php';
$conn=conectarDB();

if(!empty($_POST['idFactura'])){
    
    $idfactura=$_POST['idFactura'];    
    $sql="select estadoventa.id as estado,estadoventa.estado_venta, venta.id,venta.idCliente, venta.total,
            cliente.ciNit, cliente.nombre, cliente.apellido
            from venta 
            inner join estadoventa on venta.idestado=estadoventa.id
            inner join cliente on cliente.id=venta.idCliente
            where venta.id='$idfactura'";
            
        $sqlRes=$conn->query($sql);
        if($sqlRes->num_rows>0){
            $facturaArray=array();
            while($row=$sqlRes->fetch_assoc()){
                $facturaArray[]=$row;
            }
            
        
            $response=array(
                'statuss'=>'succes',
                'factura'=>$facturaArray
            );
            echo json_encode($response);
        }
    
}

