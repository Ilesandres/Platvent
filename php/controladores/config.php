<?php
// Configuración de la base de datos
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');//3227349082#Iles
define('DB_NAME', 'bdventa');//id21329892_tienda

// Conexión a la base de datos
function conectarDB() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $conn->set_charset('utf8');

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

