<?php
// registerUser.php

require_once '../controladores/config.php';
$con = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnregisteruser']) && $_POST['btnregisteruser'] == 'ok') {
    $nombre = $con->real_escape_string($_POST['nombre']);
    $departamento = intval($_POST['departamento']);
    $municipio = intval($_POST['municipio']);
    $username = $con->real_escape_string($_POST['username']);
    $nacimiento = date('Y-m-d', strtotime($_POST['nacimiento']));
    $email = filter_var($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo 'Invalid email format';
        echo '<script>
        //console.log("error de email");
         await Swal.fire({
           title:" verifica tu direccion email",
           text:" verifica que tu cuenta de correo electronico sea valida",
           icon:"error",
       });
       
       //window.location.href="/php/pantallas/register.php";
     </script>';
        exit();
    }

    // Prepare and bind
    $registrar = $con->query("INSERT INTO usuario (nombre, idMunicipio, usuario, fecha_nacimiento, correo, contraseña) VALUES ('$nombre','$municipio','$username','$nacimiento','$email','$password')");

    if ($registrar) {
        echo 'usuario creado con exito, redireccionando por favor espera';
        echo '<script>
                //console.log("usuario creado con exito");
                Swal.fire({
                    title: "Creación de cuenta exitosa",
                    text: "Redireccionando a inicio de sesión",
                    icon: "success",
                });
                setTimeout(function() {
                    window.location.href = "/php/pantallas/login.php";
                }, 8000); // 8 segundos
              </script>';
        exit();
    } else {
        echo '<script>
                //console.log("No se ha podido crear el usuario");
                Swal.fire({
                    title: "Error al crear la cuenta",
                    text: "Verifica que todos tus datos sean válidos",
                    icon: "error",
                });
                setTimeout(function() {
                    window.location.href = "/php/pantallas/register.php";
                }, 8000); // 8 segundos
              </script>';
        throw new Exception('Error al agregar el usuario a la base de datos');
    }

}
?>
