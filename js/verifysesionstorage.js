function sesionStorage() {
    const user = sessionStorage.getItem("user");
    const currentPath = window.location.pathname;
  
    // Verifica si el usuario está autenticado
    if (user !== null) {
        // Verifica si la ruta actual es diferente de la ruta protegida
<<<<<<< HEAD
        if (currentPath !== '/php/pantallas/user.php' && currentPath !=='/php/pantallas/modifyProduct.php' && currentPath!='/php/pantallas/buscarProduct.php'
        && currentPath !='/php/pantallas/vender.php' && currentPath !=='/php/pantallas/perfil.php'
        ) {
=======
        if (currentPath !== '/php/pantallas/user.php' && currentPath !=='/php/pantallas/modifyProduct.php' && currentPath!='/php/pantallas/buscarProduct.php') {
>>>>>>> 8fcd0467dfe06f5dc9e912f2b0b319c3bc238a67
            window.location.href = "/php/pantallas/user.php";
        }
    } else {
        // Si el usuario no está autenticado, muestra una alerta y redirige al inicio de sesión
        Swal.fire({
            icon: 'error',
            title: 'No has iniciado sesión',
            text: 'Por favor, inicia sesión.',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/php/pantallas/login.php";
            }
        });
    }
  }
  
  // Ejecuta la función
  sesionStorage();
<<<<<<< HEAD
  
  
  function cerrarSesion() {
    sessionStorage.removeItem("user");
    sessionStorage.removeItem("super");
    sessionStorage.removeItem("usuario");
    sessionStorage.removeItem("userclasId");
    sessionStorage.removeItem('xuclmt');
    Swal.fire({
      icon: "success",
      title: "Sesión cerrada",
      text: "Has cerrado sesión correctamente.",
      confirmButtonText: "Aceptar",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/php/pantallas/login.php";
      }
    });
  }
=======
  
>>>>>>> 8fcd0467dfe06f5dc9e912f2b0b319c3bc238a67
