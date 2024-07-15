<?php 

require_once './config.php';

function verifyrolUserID($Id){
    $conexion=conectarDB();
    $idUser=$Id;
    
    $consulta="select Rol from usuario inner join rol on usuario.idRol=rol.idRol where usuario.idUsuario=$idUser";
    $consultaRes=$conexion->query($consulta);
    if($consultaRes){
        $result=$consultaRes->fetch_assoc();
        if($result['Rol']=='Admin' || $result['Rol']=='Encargado'){
            return true;
        }else{
            return false;
        }
        
    }else{
        return false;
    }
    
}