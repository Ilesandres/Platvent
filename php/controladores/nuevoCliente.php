<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('America/Bogota');

require_once '../controladores/config.php';

$conexion = conectarDB();

$response = array('status' => 'error', 'message' => 'Invalid request'); // Default response

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = json_decode(file_get_contents('php://input'), true);
    if ($datos) {
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        $identificacion = $datos['identificacion'];

        if (!empty($nombre) && !empty($identificacion)) {
            
            $sql="insert into cliente (ciNit, Nombre, Apellido) values('$identificacion', '$nombre', '$apellido') ";
            
            $stmt = $conexion->query($sql);

            if ($stmt) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Cliente agregado correctamente',
                    'cliente' => array(
                        'nombre' => $nombre,
                        'apellido' => $apellido,
                        'identificacion' => $identificacion
                    )
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Error al agregar el cliente'
                );
            }
            
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Verifique que los datos se encuentren llenos'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'No se pudo decodificar el JSON enviado'
        );
    }
}

echo json_encode($response);
$conexion->close();
