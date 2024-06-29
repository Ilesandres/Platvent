const seS = sessionStorage.getItem("user");

if (seS) {
  console.log(seS);
  window.location.href = "/php/pantallas/user.php";
}

function iniciarSecion() {
  const user = document.getElementById("user").value;
  const password = document.getElementById("password").value;
  const datos = { user, password };

  console.log("user : " + user + " password " + password);
  fetch("/php/controladores/loginverify.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(datos),
  })
    .then((response) => response.json())
    .then(async (data) => {

      console.log("Respuesta del servidor", data);
      let idUserres=data.iduser;
      console.log(idUserres,'  user');
      const responseDiv = document.createElement("div");
      responseDiv.style.position = "absolute";
      responseDiv.style.fontSize = "10px";
      responseDiv.style.top = "69%";
      responseDiv.style.left = "50%";
      responseDiv.style.transform = "translate(-50%, -50%)";
      responseDiv.style.padding = "20px";
      responseDiv.style.backgroundColor = "#fff";
      responseDiv.style.borderRadius = "10px";
      responseDiv.style.boxShadow = "0 0 10px rgba(0, 0, 0, 0.1)";
      responseDiv.style.textAlign = "center";
      responseDiv.textContent =
        "Respuesta del servidor: " + JSON.stringify(data);
      document.body.appendChild(responseDiv);
      if (data.status == "success") {
            if(data.Activo==true){
               sessionStorage.setItem("user", user);
              console.log("Datos introducidos correctamente");
              sessionStorage.setItem("usuario", user+data.usuario);
              sessionStorage.setItem("super", data.usuario);
              
              const rememberMe = document.getElementById('rememberMe').checked;
              if (rememberMe) {
                    document.cookie = `username=${user}; path=/; max-age=${60 * 60 * 24 * 30}`; // Expira en 30 días
                } else {
                    document.cookie = 'username=; path=/; max-age=0'; // Eliminar cookie
                }
            
            
              await Swal.fire({
                title: "Bienvenido " + user,
                text: "iniciando sesion",
                icon: "success",
                
              });
              sessionStorage.setItem('userclasId',idUserres) ;

              sessionStorage.setItem('xuclmt',idUserres,',',user,',',data.usuario);
              window.location.href = "/php/pantallas/user.php?numuser="+idUserres+"&user"+user;

              
      }else{
        Swal.fire({
          title: "Error",
          text: "comunicate con tu administrador para reactivar tu usuario",
          icon: "error",
          confirmButtonText: 'Aceptar'
        
        })
      }
      
 


      } else {
        console.log("error " + data);
        Swal.fire({
          title: "Datos incorrectos",
          text: "verifica tus datos",
          icon: "error",
        });
      }
    })

    .catch((error) => {
      console.error("Error: " + error);
      Swal.fire({
        title: "Datos incorrectos",
        text: "verifica tus datos",
        icon: "error",
      });
    });
}

function registrarse() {
  console.log("registrandose");
}

 function revisarCookies() {
  const cookies = document.cookie.split(';');
  cookies.forEach(cookie => {
      const [name, value] = cookie.trim().split('=');
      if (name === 'username' && value) {
          document.getElementById('user').value = value;
          document.getElementById('rememberMe').checked = true;
      }
  });
};

function verifySesion(){
  fetch('/php/controladores/verfificarSesion.php',{
    method:'POST',
    mode:'cors'
  }).then(response=>response.json())
  .then(async (data)=>{
    console.log(data)
    sessionStorage.setItem("user", data.user);
    console.log("Datos introducidos correctamente");
    sessionStorage.setItem("usuario", data.user+data.user);
    sessionStorage.setItem("super", data.user);
    
    const rememberMe = document.getElementById('rememberMe').checked;
    if (rememberMe) {
          document.cookie = `username=${data.user}; path=/; max-age=${60 * 60 * 24 * 30}`; // Expira en 30 días
      } else {
          document.cookie = 'username=; path=/; max-age=0'; // Eliminar cookie
      }
  
  
    await Swal.fire({
      title: "Bienvenido " + data.user,
      text: "iniciando sesion",
      icon: "success",
      
    });
    sessionStorage.setItem('userclasId',data.id) ;

    sessionStorage.setItem('xuclmt',data.idUser,',',data.user,',',data.user);
    window.location.href = "/php/pantallas/user.php?numuser="+data.idUser+"&user"+data.user;

    
  })
  .catch((err)=>{
    console.log(err);
    Swal.fire({
      icon:'warning',
      title:'iniciar sesion',
      text:'iniciar sesion, por favor verifique bien sus datos, proporcionados por su administrados, si no puede acceder comuniquese con el mismo'
      
    })
  })

}

document.addEventListener('DOMContentLoaded',function(e){
  revisarCookies();
  verifySesion();
})

