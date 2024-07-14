<?php 

require_once './config.php';

$conexion=conectarDB();

if(!empty($_POST['idMuni'])){
    $idMuni = $_POST['idMuni'];
    $sql = "select *from municipio inner join
        departamento on municipio.idDepartamento=departamento.idDepartamento 
        where idMunicipio='$idMuni'
    ";
    $sqlRes=$conexion->query($sql);
    
    if($sqlRes->num_rows>0 && $sqlRes->num_rows<2){
        $row=$sqlRes->fetch_assoc();
        $idDepa=$row['idDepartamento'];
        $response=array(
            'idMunicipio'=>$row['idMunicipio'],
            'data'=>$row,
            'status'=>'datos municipio'
        );
       
    }
    
     echo json_encode($response);
}