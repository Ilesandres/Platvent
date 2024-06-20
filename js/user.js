function clasidhome() {
  let isurres = document.getElementById("usuario");
  isurres.value = sessionStorage.getItem("userclasId");
}

document
  .getElementById("formFile")
  .addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const previewImage = document.getElementById("previewImage");
        previewImage.src = e.target.result;
        previewImage.style.display = "block";
      };
      reader.readAsDataURL(file);
    }
  });



function acercaDe() {
  Swal.fire({
    title: "Acerca de",
    text: "Este es un ejemplo de un sistema de gestión personal.",
    icon: "info",
    confirmButtonText: "Aceptar",
  });
}

document.addEventListener("DOMContentLoaded", (event) => {
  clasidhome();
});

function cerrarBuscar() {
  window.location.href = "/php/pantallas/user.php";
}

function SearchProduct() {
  let valor = document.getElementById("search").value;
  if (valor) {
    window.location.href = "/php/pantallas/buscarProduct.php?search=" + valor;
  } else {
    Swal.fire({
    title:'error',
    text: 'ingresa el valor a buscar ',
    icon:'error'
    });
  }
}


function perfil(){
let user=sessionStorage.getItem("userclasId");
window.location.href='/php/pantallas/perfil.php?user='+user;
}