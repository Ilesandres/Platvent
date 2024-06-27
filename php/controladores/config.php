
<?php

define('DB_SERVER', 'monorail.proxy.rlwy.net');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'fDTAtMfwXWpMxkjktpnhhVDxwjjQcIHB');
define('DB_NAME', 'railway');
define('DB_PORT', '16085');


function conectarDB() {
   
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
    $conn->set_charset('utf8');
    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}



