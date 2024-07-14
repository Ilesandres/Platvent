<?php 

require_once './config.php';

$conexion=conectarDB();

if(!empty($_POST['idEmpleado'])){
    $idEmpleado=$_POST['idEmpleado'];
    $sql="select *from usuario where usuario.idUsuario='$idEmpleado'";
    $sqlRes=$conexion->query($sql);
    
    if($sqlRes->num_rows>0 && $sqlRes->num_rows<2){
        $row=$sqlRes->fetch_assoc();
        $data=array(
            'ciNit'=>$row['CiNit'],
            'nombre'=>$row['nombre'],
            'usuario'=>$row['usuario']
        );
        $response =array(
                'status'=>true,
                'message'=>'Usuario encontrado',
                'data'=>$data
        );
        
    }else{
        $response=array(
        'status'=>false,
        'message'=>'Usuario no encontrado'
        );
    }
    echo json_encode($response);
}