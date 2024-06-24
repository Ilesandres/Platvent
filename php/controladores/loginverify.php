<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../controladores/config.php';
$con = conectarDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = json_decode(file_get_contents('php://input'), true);

    $usuario = $datos['user'];
    $contraseña = $datos['password'];

    // Escapar las variables para evitar la inyección SQL
    $usuario_escapado = mysqli_real_escape_string($con, $usuario);

    // Consulta SQL para seleccionar todos los usuarios con el nombre de usuario correspondiente
    $sql = "SELECT * FROM usuario WHERE usuario='$usuario_escapado'";
    $result = $con->query($sql);

    $login_success = false;

    if ($result->num_rows > 0) {
        // Si se encuentran usuarios con el nombre de usuario correspondiente
        while ($row = $result->fetch_assoc()) {
            $contraseña_hash = $row['contraseña'];

            // Verificar si la contraseña ingresada coincide con el hash almacenado
            if (password_verify($contraseña, $contraseña_hash)) {
                // Si la contraseña coincide para al menos un usuario
                $login_success = true;
                $response = array(
                    'status' => 'success',
                    'message' => 'Inicio de sesión exitoso',
                    'iduser' => $row['idUsuario'],
                    'usuario' => $usuario
                );
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
