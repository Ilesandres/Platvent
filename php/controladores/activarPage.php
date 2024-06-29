
<?php 

require_once './config.php';

$con=conectarDB();

if(!empty($_POST['idPage'])){
    $idPage=$_POST['idPage'];
    $checkValue=$_POST['checkValue'];
    $sql="update windowsActiva set Activa=$checkValue where idWindow='$idPage' ";
    $sqlRes=$con->query($sql);
    
    if($sqlRes){
        $response=array(
            'status' => 'success',
            'message' => 'Se actualizo correctamente'
        );
        echo json_encode($response);
    }else{
        $response=array(
        'status' => 'error',
        'message' => 'Error al actualizar'
        );
        echo json_encode($response);
    }
}