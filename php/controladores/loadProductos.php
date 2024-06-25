<?php

require_once '../controladores/config.php';

$conn=conectarDB();

$sql=' select producto.id, producto.img ,producto.descripcion,producto.unidadMedida,producto.stock,
                            producto.saldo ,producto.precioBase, estadoproducto.estado,producto.fechaRegistro,
                            producto.fechaActualizacion,producto.idUsuario,producto.descripcion_complete
                            from producto
                            inner join estadoproducto on producto.estado=estadoproducto.idestadoProducto  order by 1';
                            
$resSql=$conn->query($sql);

if($resSql->num_rows>0){
    $products=array();
    while($row=$resSql->fetch_assoc()){
        $products[]=$row;
    }
    $response=array(
        'message'=>'success',
        'products'=>$products,
    );
    echo json_encode($response);
}else{
    $response=array(
    'message'=>'No hay productos',
    );
    echo json_encode($response);
}