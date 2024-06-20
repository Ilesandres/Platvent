
<?php 

require_once '/platvent_2/php/controladores/config.php';

$conexion=conectarDB();

$campo=$_POST['IDcliente'];

if($campo){
    $sql="select cliente.ciNit, cliente.nombre, cliente.apellido from cliente where cliente.cinit like '%$campo%' order by  cliente.nombre asc";

    $consulta=$conexion->query($sql);

    $html='';

    $Lista=array();
    if($consulta){
        if($consulta->num_rows > 0 ){
            while($row = $consulta->fetch_assoc()){
            
            
            $html.='<li>'.$row['ciNit'].'-'.$row['nombre'].'-'.$row['apellido'].'</li><button type="button" onclick="añadirID('.$row['ciNit'].')">add</button>';
            
            
            }
        
        }else{
        $html.= "<li>no hay datos</li>";
    }

        echo json_encode($html, JSON_UNESCAPED_UNICODE );
    }

}







