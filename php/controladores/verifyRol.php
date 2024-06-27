<?php 

require_once './config.php';

$conexion=conectarDB();

session_start();
$idUser=$_SESSION['user_id'];

if(!empty($idUser)){
    
    $sql="select usuario.idUsuario, rol.Rol from usuario
            inner join rol on usuario.idRol=rol.idRol where usuario.idUsuario='$idUser' ";
            
    $sqlRes=$conexion->query($sql);
    $row=$sqlRes->fetch_assoc();
    $Rol=$row['Rol'];
    
    if($sqlRes->num_rows>0){
        $response=array(
            'status'=>'succes',
            'message'=>'usuario encontrado',
            'data'=>$row,
            'Rol'=>$Rol
        );

        echo json_encode($response);
    }else{
        $response=array(
        'status'=>'error',
        'message'=>'no se encontro al usuario'
        );
        echo json_encode($response);
    }

    
}

