
<?php 

require_once './config.php';

$conexion=conectarDB();
require_once './verifySelectRol.php';

/*
formdata.append('nombre',nombre);
        formdata.append('direccion',direccion);
        formdata.append('municipio',municipio);
        formdata.append('encargado',encargado);*/
        
if(!empty($_POST['nombre']) && !empty($_POST['direccion']) && !empty($_POST['municipio']) && !empty($_POST['encargado']) ){
    $nombre=$_POST['nombre'];
    $direccion=$_POST['direccion'];
    $municipio=$_POST['municipio'];
    $encargado=$_POST['encargado'];
    
    $estado=true;
    $accept=verifyrolUserID($encargado);
    if($accept){
    $sql="insert into oficina(nombre, direccion, estado, idMunicipio, idEncargado) values('$nombre', '$direccion', '$estado', '$municipio', '$encargado' ) ";
    $sqlRes=$conexion->query($sql);
    
    if($sqlRes){
        
        
            $response=array(
            'status' => 'success',
            'message' => 'Datos guardados'
            );
        }else{
        $response=array(
        'status' => 'error',
        'message' => 'Error al guardar los datos'
        );
    }
        
        
    }else{
            $response=array(
            'status' => 'error',
            'message' => 'el empleado no Tiene el Rol Suficiente'
            );
        }
    
    
    
    
    
    
}else{
    $response=array(
        'status'=>'error',
        'message'=>'Faltan datos'
        
    );
}
echo json_encode($response);