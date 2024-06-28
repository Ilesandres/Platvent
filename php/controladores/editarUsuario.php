<?php 

require_once './config.php';

$con = conectarDB();


if(!empty($_POST['idUser']) && !empty($_POST['nombre'])  && !empty($_POST['usuario'])  && !empty($_POST['descripcion']) 
&& !empty($_POST['correo'])){
        $idUser = $_POST['idUser'];
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $descripcion = $_POST['descripcion'];
        $correo = $_POST['correo'];
        $estado = $_POST['estado'];
        
         if(!empty($_POST['contrasena'])){
             $contrasena=$_POST['contrasena'];
             $contraseña_hash=password_hash($contrasena, PASSWORD_BCRYPT);
            
            
            $sql="update usuario set usuario='$usuario', correo='$correo', contraseña='$contraseña_hash', nombre='$nombre', descripcion='$descripcion', isActivo=$estado where idUsuario='$idUser'";
            
            $sqlRes=$con->query($sql);
            
            if($sqlRes){
                $response=array(
                    'status' => 'success',
                    'message' => 'Usuario actualizado con una nueva contraseña'
                );
                echo json_encode($response);
            }else{
                $response=array(
                'status' => 'error',
                'message' => 'Error al actualizar usuario con una nueva contraseña'
                );
                echo json_encode($response);
            }
        }else{
            
            $sql1="update usuario set usuario='$usuario', correo='$correo', nombre='$nombre', descripcion='$descripcion', isActivo=$estado where idUsuario='$idUser'";
            $sqlRes1=$con->query($sql1);
            
            if($sqlRes1){
                $response=array(
                'status' => 'success',
                'message' => 'Usuario actualizado sin contraseña nueva'
                );
                echo json_encode($response);
            }else{
                $response=array(
                'status' => 'error',
                'message' => 'Error al actualizar usuario sin contraseña'
                );
                 echo json_encode($response);
            }
            
        }
       
      

}else{
    $response=array(
    'status' => 'error',
    'message' => 'Error al actualizar usuario'
    );
    echo json_encode($response);
}


