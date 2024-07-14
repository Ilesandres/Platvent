
<?php 
require_once './config.php';

$conexion=conectarDB();

if(!empty($_POST['idDepartamento'])){
    $idDepartamento = $_POST['idDepartamento'];
    $sql="select *from municipio inner join departamento on departamento.idDepartamento=municipio.idDepartamento 
    where departamento.idDepartamento='$idDepartamento'";
    
    $sqlRes=$conexion->query($sql);
    
    if($sqlRes->num_rows>0){
        $datos=array();
        while($row=$sqlRes->fetch_assoc()){
        $datos[]=$row;
        }
        $response=array(
            'status'=>true,
            'data'=>$datos
        );
        echo json_encode($response);
    }else{
        $response=array(
        'status'=>false,
        'data'=>'No se encontraron datos'
        );
        echo json_encode($response);
    }
    
}