<?php 

require_once './config.php';

$conexion=conectarDB();

if(!empty($_POST['idOficina'])){
    $idOficina=$_POST['idOficina'];
    $sql="select *from oficina where oficina.id='$idOficina'";
    $consulta=$conexion->query($sql);
    
    if($consulta->num_rows>0 && $consulta->num_rows<2){
        $oficina=$consulta->fetch_assoc();
        $response=array(
            'status'=>'exito',
            'oficina'=>$oficina,
            'message'=>'oficina cargado con exito'
            
        );
    }else{
        $response=array(
        'status'=>'error',
        'message'=>'oficina no encontrado'
        );
    }
    
    echo json_encode($response);
}