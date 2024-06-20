<?php 

require_once '/platvent_2/php/controladores/config.php';

$conexion=conectarDB();

$consultCliente=$_POST['cliente'];


if($consultCliente){

    $sql="select * from cliente where cliente.cinit ='$consultCliente'";

    $consulta=$conexion->query($sql);
    
    if($consulta->num_rows>0){
        while ($row = $consulta->fetch_assoc()) {
             $response=array(
                    'ciNit'=>$row['ciNit'],
                    'nombre'=>$row['nombre'],
                    'apellido'=>$row['apellido'],
                    'colCid'=>$row['id'],
                    'message'=>'no',
        );
        
        
        }
        echo json_encode($response);
      
    }
    
    
    
}