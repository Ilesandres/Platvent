<?php

require_once 'config.php';



function isActiva($names){

        $conn=conectarDB();
        $name = strtolower($names);
        $sql="select *from windows
            inner join windowsActiva on windows.id=windowsActiva.idWindow
            where windows.pestana='$name'";
            
            $sqlRes=$conn->query($sql);
            if($sqlRes){
                $active=$sqlRes->fetch_assoc();
                $isActive=$active['Activa'];
                
                if($isActive!=true){
                    header('location: ../../php/pantallas/mantenimiento.php');
                }
            }
    
}