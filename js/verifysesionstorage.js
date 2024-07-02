function sesionStorage() {
    const user = sessionStorage.getItem("user");
    const currentPath = window.location.pathname;
  

    if (user !== null) {


        if (currentPath !== '/php/pantallas/user.php' && currentPath !=='/php/pantallas/modifyProduct.php' && currentPath!='/php/pantallas/buscarProduct.php'
        && currentPath !='/php/pantallas/vender.php' && currentPath !=='/php/pantallas/perfil.php' && currentPath!=='/php/pantallas/admin.php'
        && currentPath !=='/php/pantallas/UsuariosAdmin.php' && currentPath !=='/php/pantallas/paginasAdmin.php' && currentPath!=='/php/pantallas/oficinasAdmin.php'
        
        ) {

       
            window.location.href = "/php/pantallas/user.php";

    } 
  }else {

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
  document.addEventListener('DOMContentLoaded',function(e){
    sesionStorage();
  })


  
  
  function cerrarSesion() {
    sessionStorage.removeItem("user");
    sessionStorage.removeItem("super");
    sessionStorage.removeItem("usuario");
    sessionStorage.removeItem("userclasId");
    sessionStorage.removeItem("xuclmt");
    Swal.fire({
      icon: "success",
      title: "Sesión cerrada",
      text: "Has cerrado sesión correctamente.",
      confirmButtonText: "Aceptar",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/php/pantallas/login.php";
        fetch('/php/controladores/eliminarsesion.php',{
          method: 'POST',
          mode: 'cors'
        }).the(response=>response.json())
        .then((data)=>{
          console.log(data)
        })
        .catch((err) => {
          console.log(err)
        })
      }
    });
  }
  

