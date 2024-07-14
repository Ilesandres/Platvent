<?php 

require_once './config.php';
$con = conectarDB();

if(!empty($_POST['idOficina'])){
    $idOfice = $_POST['idOficina'];
    $estado = $_POST['estado'];
    if($estado=='false'){
        $estado = 0;
    }else{
        $estado = 1;
    }
    
    $sqlUser = "UPDATE usuario SET isActivo='$estado' WHERE usuario.idOficina='$idOfice'";
    $sqlOficina = "UPDATE oficina SET estado='$estado' WHERE oficina.id='$idOfice'";
    
    $sqlUserRes = $con->query($sqlUser);
    $sqlOficinaRes = $con->query($sqlOficina);
    
    if($sqlUserRes){
        if($sqlOficinaRes){
            $response = array(
                'status' => true,
                'message' => 'Usuarios y oficina actualizados'
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'Error al actualizar oficina'
            );
        }
    } else {
        $response = array(
            'status' => false,
            'message' => 'Error al actualizar usuario'
        );
    }
    echo json_encode($response);
}

