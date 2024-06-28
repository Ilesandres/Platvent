<?php 

require_once './config.php';

$con=conectarDB();

if(!empty($_POST['idUSer'])){
    $idUser=$_POST['idUSer'];
    $sql="select *from usuario where usuario.idUsuario='$idUser'";
    
    $sqlRes=$con->query($sql);
    
    if($sqlRes->num_rows>0){
        $row=$sqlRes->fetch_assoc();
        $response=array(
            'status'=>'succes',
            'message'=>'Usuario encontrado',
            'data'=>$row
        );
        echo json_encode($response);
    }
}