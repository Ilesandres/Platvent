<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../controladores/config.php';
$con = conectarDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = json_decode(file_get_contents('php://input'), true);

    $usuario = $datos['user'];
    $contraseña = $datos['password'];


    $usuario_escapado = mysqli_real_escape_string($con, $usuario);

    $sql = "SELECT * FROM usuario WHERE usuario='$usuario_escapado'";
    $result = $con->query($sql);

    $login_success = false;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $contraseña_hash = $row['contraseña'];


            if (password_verify($contraseña, $contraseña_hash)) {
              
                $login_success = true;
                $response = array(
                    'status' => 'success',
                    'message' => 'Inicio de sesión exitoso',
                    'iduser' => $row['idUsuario'],
                    'usuario' => $usuario
                );
                session_start();
                $_SESSION['user_id']=$row['idUsuario'];
                $_SESSION['usuario']=$row['usuario'];
                echo json_encode($response);
                break; // Salir del bucle ya que hemos encontrado una coincidencia exitosa
            }
        }
    }

    if (!$login_success) {
        // Si no se encontró ningún usuario con el nombre de usuario y la contraseña correspondientes
        $response = array(
            'status' => 'error',
            'message' => 'Usuario o contraseña incorrectos'
        );
        echo json_encode($response);
    }
} else {
    // Si el método de solicitud no es POST, enviar un mensaje de error
    $response = array(
        'status' => 'error',
        'message' => 'Método de solicitud no permitido'
    );
    echo json_encode($response);
}
?>
