
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

function crearFactura(idCliente, colcId){
let factura=document.getElementById('idfactura');
let vendedor=document.getElementById('idvendedor');
let estadoFactura=document.getElementById('estadofactura').value;
let idVendedor=sessionStorage.getItem('userclasId');
vendedor.value=idVendedor;
let EFactura=factura.value;
if(!estadoFactura || estadoFactura!=='null'){
    if(!EFactura){
            let IDCliente=idCliente;
            let colID=colcId;

        let formdata= new FormData();
        formdata.append("id_cliente", IDCliente);
        formdata.append('coID', colID);
        formdata.append('idVendedor',idVendedor)
        formdata.append('estadofactura',estadoFactura)

        console.log(IDCliente,  colID);
        if(IDCliente && colID){
            fetch('/php/controladores/crearFactura.php',{
                method: 'POST',
                body: formdata,
                mode: 'cors',

            }).then(response=>response.json())
            .then((data)=>{
            factura.value=data.idFactura;

            })
            .catch((err)=>{console.log('error '+err)})
        }
    
    }else{
     modificarFactura();
    }
    }




}

function modificarFactura(){

let estadoFactura=document.getElementById('estadofactura').value;
let IDFactura=document.getElementById('idfactura').value;
let IdVendedor=document.getElementById('idvendedor').value;
let IDCliente= document.getElementById('IDcliente').value;
let formdata= new FormData();


if(estadoFactura && IDFactura && IdVendedor && IDCliente){
    formdata.append("idFactura", IDFactura);
    formdata.append('idVendedor',IdVendedor);
    formdata.append('id_cliente', IDCliente);
    formdata.append('estadofactura',estadoFactura)

    
    fetch('/php/controladores/modificarFacturaID.php',{
     method: 'POST',
    body: formdata,
    mode:'cors'
    
    })
    .then(response=>response.json())
    .then((data)=>{
        console.log(data);
    })
    .catch((err)=>{
    console.log('ERROR : ',err);
    })
}

}


function añadirID(id){
    let userId=document.getElementById('IDcliente');
    let valorData=document.getElementById('nombrecliente');
    let IdCliente=id;
    
    
    let lista=document.getElementById('list');
    lista.style.display='none';
    let formdata=new FormData();
    let estadoFactura=document.getElementById('estadofactura').value;
    formdata.append('cliente', IdCliente);
    
    if(!estadoFactura || estadoFactura!=='null'){
        
    
    
        if(IdCliente){
            userId.value=IdCliente;
            fetch('/php/controladores/buscarclienteporId2.php',{
            method:'POST',
            body:formdata,
            mode: 'cors'
            }).then(response=>response.json())
            .then((data) => {
                valorData.value=data.nombre+' '+data.apellido+' -- '+data.ciNit;
                crearFactura(data.ciNit, data.colCid);
            })
            .catch((err)=>{console.log('error : '+err)})
        
        }
    }else{
        Swal.fire({
        title:'error',
        text: 'procura llenar primero el estado de la factura',
        icon:'warning',
        })
    
    
    }
    
    
    

}




document.getElementById('IDcliente').addEventListener('keyup', function(e){

    let userId=document.getElementById('IDcliente');
    let userIdinput=userId.value;
    let lista=document.getElementById('list');
   
    
    let formdata= new FormData();
    formdata.append('IDcliente',userIdinput);
    
    if(userIdinput){
    
        fetch('/php/controladores/buscarClienteporId.php',{
            
            method:'POST',
            body:formdata,
            mode:'cors'
        }).then(response=>response.json())
        .then((data) => {
            lista.style.display='block';
            lista.innerHTML=data;
            
        })
        .catch((err)=>{console.log('ERROR',err)});
    
    }
    


});

/*document.getElementById('IDcliente').addEventListener('blur',function(e){
    
    let lista=document.getElementById('list');
    lista.style.display='none';
});


*/


function limpiarFactura(){
    let estadoFactura=document.getElementById('estadofactura');
    let IDFactura=document.getElementById('idfactura');
    let IdVendedor=document.getElementById('idvendedor');
    let IDCliente= document.getElementById('IDcliente');
    let NombreCliente=document.getElementById('nombrecliente');
    
    estadoFactura.value='null';
    IDFactura.value='';
    IdVendedor.value='';
    IDCliente.value='';
    NombreCliente.value='';

}