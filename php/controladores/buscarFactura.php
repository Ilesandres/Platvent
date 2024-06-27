<?php 

require_once './config.php';

$con=conectarDB();

if(!empty($_POST['searchFactura'])){
    $searchFactura = $_POST['searchFactura'];
    $sql = "SELECT  venta.*, cliente.id as idCliente,cliente.nombre, cliente.ciNit,
            cliente.apellido,cliente.estado
            FROM venta 
            inner join cliente on venta.idCliente=cliente.id where cliente.nombre like '%$searchFactura%' 
            or cliente.ciNit like '$searchFactura' or venta.id like '$searchFactura' order by 1";
    
    $result=$con->query($sql);
    
    $facturas=array();
    
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $facturas[]=$row;
        }
        
        $response=array( 
            'status' => 'success',
            'facturas' => $facturas
        );
    }else{
        $response=array(
        'status' => 'error',
        'message' => 'No se encontraron resultados'
        );
    }
    echo json_encode($response);

}