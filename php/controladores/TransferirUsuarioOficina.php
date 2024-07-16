<?php 

require_once './config.php';

$conexion=conectarDB();

if(!empty($_POST['NitEmpleado']) && !empty($_POST['IdOficina'])){
    
    $nitEmpleado=$_POST['NitEmpleado'];
    $idOficina=$_POST['IdOficina'];
    $Activo="select usuario.idUsuario,usuario.idOficina, usuario.isActivo from usuario where usuario.CiNit='$nitEmpleado'";
    $ActivoRes=$conexion->query($Activo);
    if($ActivoRes->num_rows>0 && $ActivoRes->num_rows<2){
        $usuario=$ActivoRes->fetch_assoc();
        $idUsuario=$usuario['idUsuario'];
        $idOficinaAfter=$usuario['idOficina'];
        if($usuario['isActivo']!=='0'){
        if($idOficinaAfter!==$idOficina){
            $actualizar="update usuario set idOficina='$idOficina' where idUsuario='$idUsuario'";
            $actualizarRes=$conexion->query($actualizar);
            if($actualizarRes){
                $response=array(
                    'status' => 'success',
                    'message' => 'usuario transferido',
                    'idUser'=>$idUsuario
                    
                );
            }else{
                $response=array(
                'status' => 'error',
                'message' => 'Error al actualizar'
                );
            }
        }else{
            $response=array(
            'status' => 'error',
            'message' => 'El usuario ya se encuentra en la oficina'
            );
        }
        //
        
        }else{
            $response=array(
            'status' => 'error',
            'message' => 'El usuario no esta activo'
            );
        }
        
    }else{
        
        $response=array(
        'status' => 'error',
        'message' => 'Usuario no encontrado'
        );
    }
    
    
}else{
    $response=array(
    'status' => 'error',
    'message' => 'Datos incompletos'
    );
}
echo json_encode($response);