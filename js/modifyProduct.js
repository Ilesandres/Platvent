

Swal.fire({
title:'Bienvenido',
text: 'ten cuidado al editar los poducto',
icon: 'warning',
})

function previewImg() {
  let img = document.getElementById("inputimg").value;
  console.log(img);
  
  let impre=document.getElementById('previewImage');
  impre.src='/img/'+img;
  impre.style.display='block';
}

document.addEventListener("DOMContentLoaded", (event) => {
  previewImg();
});



document.getElementById('img').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewImage = document.getElementById('previewImage');
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});


function sesionStorage() {
  const user = sessionStorage.getItem("user");
  const currentPath = window.location.pathname;

  // Verifica si el usuario está autenticado
  if (user !== null) {
   
      
      
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

function Back(){
history.back();
}