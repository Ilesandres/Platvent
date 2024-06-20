
function perfil(){
    let user=sessionStorage.getItem("userclasId");
    window.location.href='/php/pantallas/perfil.php?user='+user;
    }
    
    
function cerrarBuscar(){
    window.location.href = window.location.pathname;
}

function registrarCliente() {
    let nombre = document.getElementById('nombrecliente').value;
    let apellido = document.getElementById('apellido').value;
    let identificacion = document.getElementById('identificacion').value;

    if (nombre && identificacion) {
        const datos = { nombre, apellido, identificacion };
        console.log(datos)

        fetch('/php/controladores/nuevoCliente.php', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(datos)
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then((data) => {
            console.log("Respuesta del servidor", data);
            if (data.status === 'success') {
                Swal.fire({
                    title: 'Success',
                    text: 'Cliente agregado correctamente',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al intentar agregar el cliente',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    } else {
        Swal.fire({
            title: 'Error',
            text: 'Verifique que los datos se encuentren llenos',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
}
