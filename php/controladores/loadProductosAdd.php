<?php 

require_once '/platvent_2/php/controladores/config.php';
$conexionFactura=conectarDB();

if(!empty($_POST['idFactura'])){
    $idFacturain=$_POST['idFactura'];

    $sql="select detalles.iddetalles, producto.img , producto.descripcion, producto.precioBase, 
        detalles.cantidad,producto.unidadMedida,  estadoventa.estado_venta 
        from producto
        inner join detalles on detalles.idProducto=producto.id
        inner join venta on venta.id=detalles.idVenta
        inner join estadoventa on estadoventa.id=venta.idestado
        where detalles.idventa='$idFacturain'";
        
    $sqlRes=$conexionFactura->query($sql);

    if($sqlRes){
        if($sqlRes->num_rows>0){
        $productsArray=array();
            while($products=$sqlRes->fetch_assoc()){
               $productsArray[]=$products;
            }
            $response=array(
                'mensaje'=>'respuesta del servidor',
                'idFactura'=>$idFacturain,
                 'productos'=>    $productsArray,
                );
            echo json_encode($response);
        }
    }
}

