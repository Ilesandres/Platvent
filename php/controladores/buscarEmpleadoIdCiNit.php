<?php 

require_once './config.php';

$conexion=conectarDB();

if(!Empty($_POST['idEmpleado'])){
    $idEmpleado = $_POST['idEmpleado'];
    $sql="select *from usuario where idUsuario= '$idEmpleado' or ciNit='$idEmpleado'";
    
    $sqlRes=$conexion->query($sql);
    
    $note=$sqlRes->fetch_assoc();
    if($sqlRes->num_rows==1){
        $data=array(
            'idUsuario'=>$note['idUsuario'],
            'ciNit'=>$note['CiNit'],
            'nombre'=>$note['nombre'],
            'usuario'=>$note['usuario'],
            'telefono'=>$note['telefono']
            
        );
        $message='usuario encontrado con exito';
    }else if($sqlRes->num_rows>1){
        $message='muchos usuarios con este id';
        $data=$sqlRes->num_rows;
    }else{
        $message='no se encontro el empleado';
        $data=0;
    }
    $response=array(
        'status'=>'ok',
        'message'=>$message,
        'data'=>$data
    );
    echo json_encode($response);
}

