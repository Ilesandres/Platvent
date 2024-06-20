

document.getElementById("departamento").addEventListener("change", function (event) {
    
    let departamento = document.getElementById("departamento").value;
    let municipio = document.getElementById("municipio");
    if (departamento !== "null" && departamento!==null ) {
      municipio.disabled=false;
      loadMuni(departamento);
    }else{
    municipio.disabled=true;
    }
    
  });
  
  function show() {
    var password = document.getElementById("password");
    var icon = document.querySelector(".fas");
    if (password.type === "password") {
      password.type = "text";
    } else {
      password.type = "password";
    }
  }
  


function loadMuni(departamentoId){
console.log('depa ID '+departamentoId);
  
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/php/controladores/BuscarMuniPorDep.php?idDepartamento=" + departamentoId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("municipio").innerHTML = xhr.responseText;
            document.getElementById("municipio").disabled = false;
        }
    };
    xhr.send();
}

