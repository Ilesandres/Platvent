<?php 

require_once './config.php';
$conexion=conectarDB();


if(!empty($_POST['nombre']) && !empty($_POST['direccion']) && !empty($_POST['idMunicipio']) && !empty($_POST['idEncargado']) && !empty($_POST['idOficina'])  ){
    $nombre=$_POST['nombre'];
    $direccion=$_POST['direccion'];
    $idMunicipio=$_POST['idMunicipio'];
    $idEncargado=$_POST['idEncargado'];
    $idOficina=$_POST['idOficina'];
    
    $after="select *from oficina where oficina.id='$idOficina'";
    $afterRes=$conexion->query($after);
    
    if($afterRes){
        $ResultAfter=$afterRes->fetch_assoc();
        $nombreAfter=$ResultAfter['nombre'];
        $direccionAfter=$ResultAfter['direccion'];
        $municipioAfter=$ResultAfter['idMunicipio'];
        $encargadoAfter=$ResultAfter['idEncargado'];
        if($nombre !==$nombreAfter || $direccion!==$direccionAfter || $idMunicipio!==$municipioAfter || $idEncargado!==$encargadoAfter ){
            $sql="update oficina set nombre='$nombre',direccion='$direccion',idMunicipio=$idMunicipio, idEncargado='$idEncargado' where oficina.id='$idOficina'";
            $sqlRes=$conexion->query($sql);
            if($sqlRes){
                $response=array(
                'status' => 'success',
                'message' => 'Registro exitoso',
                'nombre' => $nombre,
            );
            }
            
        }else{
            $response=array(
                'status' => 'error',
                'message' => 'verifica que los datos no sean los mismos que ya estaban registrados',
                
            );
        }
        
    }else{
        $response=array(
        'status' => 'error',
        'message' => 'Error al registrar'
        );
    }
    
    
    
    
    echo json_encode($response);

}