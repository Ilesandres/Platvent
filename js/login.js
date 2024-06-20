const seS = sessionStorage.getItem("user");
console.log(seS);
if (seS) {
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
        sessionStorage.setItem("user", user);
        console.log("Datos introducidos correctamente");
        sessionStorage.setItem("usuario", user+data.usuario);
        sessionStorage.setItem("super", data.usuario);
        await Swal.fire({
          title: "Bienvenido " + user,
          text: "iniciando sesion",
          icon: "success",
        });
        sessionStorage.setItem('userclasId',idUserres) ;
<<<<<<< HEAD
        sessionStorage.setItem('xuclmt',idUserres,',',user,',',data.usuario);
=======
>>>>>>> 8fcd0467dfe06f5dc9e912f2b0b319c3bc238a67
        window.location.href = "/php/pantallas/user.php?numuser="+idUserres+"&user"+user;

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
