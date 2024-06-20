<?php

date_default_timezone_set('America/Bogota');

require_once '/platvent_2/php/controladores/config.php';

$conn=conectarDB();


if(!empty($_POST['btnmodificar'])){

if(!empty($_POST['nombre']) &&!empty($_POST['cantidad']) &&!empty($_POST['medida']) &&!empty($_POST['estado']) && $_POST['estado']!=='null'  
&& !empty($_POST['precioBase']) && !empty($_POST['descripcion']) ){

    
    $nombre=$conn->real_escape_string($_POST['nombre']);
    $descripcionPro=$conn->real_escape_string($_POST['descripcion']);
    $cantidad=intval($_POST['cantidad']);
    $medida=$conn->real_escape_string($_POST['medida']);
    $estado=intval($_POST['estado']);
    $precioBase=floatval($_POST['precioBase']);
    $saldo=$precioBase*$cantidad;
    $idProduct=intval($_POST['idProduct']);
    $fecha_actualizacion = date("Y-m-d H:i:s");
    $imgAfter=$conn->real_escape_string($_POST['imgAfter']);
    
    $sql=$conn->query("update producto set descripcion='$nombre',descripcion_complete='$descripcionPro', stock='$cantidad', unidadMedida='$medida', precioBase='$precioBase', saldo='$saldo',
      fechaActualizacion='$fecha_actualizacion', estado='$estado' where id='$idProduct'
    ");
      
      if($sql){
      
      if (!empty($_FILES['img']['tmp_name'])) {
      $ruta = '/platvent_2/img/';
      $imagen = $_FILES['img']['tmp_name'];
      $nombreImagen = $_FILES['img']['name'];
      $tipoImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
      
      $cam = $idProduct . "-." . $tipoImagen;
      
      if($tipoImagen=='jpg' || $tipoImagen=='jpeg' || $tipoImagen=='png' ){
      
      if($imgAfter!=='default.png'){
        try{
        
          unlink($ruta.$imgAfter);
        }catch(\Throwable $th){
        ##code
        }
      }
      
      if (move_uploaded_file($imagen, $ruta.$cam)) {
        $mody=$conn->query("update producto set img='$cam' where id='$idProduct'");
        
        if($mody){
          header('location: /php/pantallas/user.php?status=success&message=Producto editado con éxito, con imagen');
        }else{
          echo'<div class="alert alert-info">error al insertar la imagen al servidor</div>';
        }
        
      } else {
        echo'<div class="alert alert-info">error al subir la imagen al servidor</div>';
      }
      
      
      
        
      
      }else{
        echo'<div class="alert alert-info">no se acepta este formato, solo se aceptan jpg, jpeg y png </div>';
      
      }
      
      
      
        }else{
          header('location: /php/pantallas/user.php?status=warning&message=Producto editado con éxito, sin imagen');
        }
    
    }else{
     echo '<div class="alert alert-danger">error al actualizar el  producto</div>';
    }
    
      
  
    
    
    

}else{
    echo '<div class="alert alert-danger">verifica que toodos los datos se encuentren llenos</div>';
}
   
    
    
    
}

