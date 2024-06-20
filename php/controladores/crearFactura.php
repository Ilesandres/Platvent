<?php 

date_default_timezone_set('America/Bogota');

require_once '/platvent_2/php/controladores/config.php';
$conn=conectarDB();


if(!empty($_POST['coID']) && !empty($_POST['id_cliente']) && !empty($_POST['idVendedor'])){

    $IDCliente=$_POST['coID'];
    $NitCliente=$_POST['id_cliente'];
    $IdVendedor=$_POST['idVendedor'];
    $estadofactura=$_POST['estadofactura'];
    $Total=0;
    
    $sql="insert into venta (idCliente, idUsuario,idestado,total) values('$IDCliente','$IdVendedor','$estadofactura','$Total')";
    
    $result=$conn->query($sql);
    $resultID=mysqli_insert_id($conn);
    
    if($result){
    
        $response = array(
        'message'=> 'hola',
        'idvendedor'=> $IdVendedor,
        'idCliente'=> $IDCliente,
        'NitCliente'=> $NitCliente,
        'estadofactura'=>$estadofactura,
        'idFactura'=>$resultID,
        );
        
        
        echo json_encode($response);
    }
    
    
#code
}else{
    $response = array(
    'message'=>'faltan campos  verifica la informcaion de envio',
    );
    
    echo json_encode($response);
}