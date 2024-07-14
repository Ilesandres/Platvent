<?php





function isActiva($names){


        
        $name = strtolower($names);
        if($name!=='inicio'){
            require_once '../controladores/config.php';
        }else{
            require_once 'php/controladores/config.php';
        }
        $conn=conectarDB();
        
        $sql="select *from windows
            inner join windowsActiva on windows.id=windowsActiva.idWindow
            where windows.pestana='$name'";
            
            $sqlRes=$conn->query($sql);
            if($sqlRes){
                $active=$sqlRes->fetch_assoc();
                $isActive=$active['Activa'];
                
                if($isActive!=1){
                    header('location: ../../php/pantallas/mantenimiento.php');
                }
            }
    
}