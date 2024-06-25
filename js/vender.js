
function perfil(){
    let user=sessionStorage.getItem("userclasId");
    window.location.href='/php/pantallas/perfil.php?user='+user;
    }
    
    

function productosDisponibles(){
    
    let contenedor=document.getElementById('productos_disponibles');
    
    fetch('/php/controladores/loadProductos.php',{
        method:'post',
    }).then(response=>response.json())
    .then((data)=>{
        console.log(data);
        products=data.products;
        contenedor.innerHTML='';
        products.forEach(producto => {
        
            const row = document.createElement('tr');

            const Id = document.createElement('td');
            Id.innerText = producto.id;
            row.appendChild(Id);
            
            const imageCell = document.createElement('td');
            const img = document.createElement('img');
            img.src = '/img/' + producto.img;
            img.alt = producto.descripcion;
            img.style.width = '50px';
            imageCell.appendChild(img);
            row.appendChild(imageCell);
        
            const nombreCell = document.createElement('td');
            nombreCell.innerText = producto.descripcion;
            row.appendChild(nombreCell);
            
            const descripcion = document.createElement('td');
            descripcion.innerText = producto.descripcion_complete;
            row.appendChild(descripcion);
        
            const unidadDeMedidaCell = document.createElement('td');
            unidadDeMedidaCell.innerText = producto.unidadMedida || 'N/A';
            row.appendChild(unidadDeMedidaCell);
            
        
            const stockCell = document.createElement('td');
            stockCell.innerText = producto.stock;
            row.appendChild(stockCell);
            
            const saldoCell = document.createElement('td');
            saldoCell.innerText = producto.saldo;
            row.appendChild(saldoCell);
        
            const precioBaseCell = document.createElement('td');
            precioBaseCell.innerText = producto.precioBase;
            row.appendChild(precioBaseCell);
        
            const estadoCell = document.createElement('td');
            estadoCell.innerText = producto.estado || 'N/A';
            row.appendChild(estadoCell);
        
            const accionesCell = document.createElement('td');
            accionesCell.innerHTML = '<button onclick="Modal('+producto.id+')" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></button>';
            row.appendChild(accionesCell);
        
         
        
            contenedor.appendChild(row);
            
        });
    }).catch((err)=>console.log(err));
}



function registrarCliente() {
    let nombre = document.getElementById('nameCliente').value;
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
let editarFacturaButtom=document.getElementById('editarFacturaAct');
let imprimirFacturaButtom=document.getElementById('imprimirFactura');
vendedor.value=idVendedor;
let EFactura=factura.value;
let IDCliente=idCliente;
    imprimirFacturaButtom.innerHTML='';
    editarFacturaButtom.innerHTML='';
 let colID=colcId;
 editarFacturaButtom.innerHTML='<button type="button" onclick="modificarFactura('+colcId+')" class="btn btn-success custom-btn w-100" >editar factura</button>';
 imprimirFacturaButtom.innerHTML+='<button type="button" onclick="imrpimirFactura()" class="btn btn-primary custom-btn w-100" >imprimir factura</button>';

if(!estadoFactura || estadoFactura!=='null'){
    if(!EFactura){
            

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
            Swal.fire({
                title:'factura creada con exito',
                text: 'añade productos o quita productos de esta factura si lo desesa',
                icon:'success',
                })

            })
            .catch((err)=>{console.log('error '+err)})
        }
    
    }else{
     modificarFactura(colcId);
    }
    }




}


function modificarFactura(ClienteID) {
    let estadoFactura = document.getElementById('estadofactura').value;
    let IDFactura = document.getElementById('idfactura').value;
    let IDCliente = ClienteID;
    let IdVendedor = document.getElementById('idvendedor').value;
    let ciNIt = document.getElementById('IDcliente').value;
    let total = document.getElementById('total').value;


    if (!estadoFactura || !IDFactura || !IdVendedor || !IDCliente) {
        Swal.fire({
            title: 'Error',
            text: 'Por favor, completa todos los campos requeridos.',
            icon: 'error',
            confirmButtonText: 'Ok',
        });
        return;
    }

    if (estadoFactura === 'null') {
        Swal.fire({
            title: 'Error',
            text: 'No se puede dejar el estado de la factura vacío.',
            icon: 'error',
            confirmButtonText: 'Ok',
        });
        return;
    }

    let formdata = new FormData();
    formdata.append("idFactura", IDFactura);
    formdata.append('idVendedor', IdVendedor);
    formdata.append('id_cliente', IDCliente);
    formdata.append('estadofactura', estadoFactura);
    formdata.append('ciNIt', ciNIt);
    formdata.append('total', total);


    fetch('/php/controladores/modificarFacturaID.php', {
        method: 'POST',
        body: formdata,
        mode: 'cors'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        Swal.fire({
            title: 'Factura editada con éxito',
            text: 'Añade productos o quita productos de esta factura si lo deseas.',
            icon: 'success',
        });
    })
    .catch(err => {
        Swal.fire({
            title: 'Error',
            text: 'Hubo un problema al editar la factura. Por favor, inténtalo nuevamente, puede que los valores de la factura sean iguales, recuerda que los productos al modificarlos se actualizan automaticamente',
            icon: 'error',
            confirmButtonText: 'Ok',
        });
    });
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
    let totalProducts=document.getElementById('total');
    const tableProducts=document.getElementById('table-productos-añadidos');
    let editarFacturaButtom=document.getElementById('editarFacturaAct');
    let imprimirFacturaButtom=document.getElementById('imprimirFactura');
    
    if(estadoFactura.value && IdVendedor.value && IDCliente.value && NombreCliente.value){
        Swal.fire({

            title:'Seguro',
            text: 'asegurate de haber acabado con esta factura antes de crear una nueva',
            icon: 'warning',
            confirmButtonText:'estoy seguro',
        }).then((resultado)=>{
            if(resultado.isConfirmed){
                estadoFactura.value='null';
                IDFactura.value='';
                IdVendedor.value='';
                IDCliente.value='';
                NombreCliente.value='';
                totalProducts.value=0;
                tableProducts.innerHTML='';
                editarFacturaButtom.innerHTML='';
                imprimirFacturaButtom.innerHTML='';
            }
        
        
        })
        
        
    }else{
        Swal.fire({

            title:'tranquil@',
            text: 'los campos estan vacios puedes crear una factura sin problema alguno',
            icon: 'info',
        })
    }
    
    
   

}

//modal para la cantidad
function Modal(id) {
let factura=document.getElementById('idfactura').value;
let Idproduct=id;
if(factura){
    const modalHTML1 = `
            <div class="modal fade" id="cantidadproduct" aria-hidden="true" aria-labelledby="AgregarCantidadProduct" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="AgregarCantidad">cantidad</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form">
                                <form method="POST" class="p-3 border rounded shadow-sm">
                                    <div class="mb-3">
                                        <label for="cantidad para el producto" class="form-label">Nombre</label>
                                        <input type="text" id="cantidadproducto" name="cantidadproducto" class="form-control" placeholder="cantidad">
                                    </div>
                                    <button type="button" value="ok" class="btn btn-success" onclick="agregarproducto(`+Idproduct+`)" name="btnagregarcliente">agregar</button>
                                </form>
                            </div>
                            escribe la cantidad que dese del producto
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHTML1);
        
    
        const modalElement = new bootstrap.Modal(document.getElementById('cantidadproduct'));
        modalElement.show();
}else{
    Swal.fire({
        title:'error',
        text:'primero debes crear o seleccionar una factura',
        icon:'error'
    })

}
    
}



function agregarproducto(IDproduct){
 
    
    let cantidad = document.getElementById('cantidadproducto').value;

    const modalElement = document.getElementById('cantidadproduct');
    const bsModal = bootstrap.Modal.getInstance(modalElement);

    if (bsModal) {
        bsModal.hide();
    }

    // Espera a que el modal se oculte antes de eliminarlo del DOM
    modalElement.addEventListener('hidden.bs.modal', function(event) {
        modalElement.remove();
    });



console.log('cantidad : '+cantidad);
let idFactura=document.getElementById('idfactura').value;
let productID=IDproduct;
console.log("agregando producto "+productID);

let formdata= new FormData();
formdata.append('idProduct',productID);
formdata.append('idFactura', idFactura);
formdata.append('cantidad',cantidad);


if(idFactura && cantidad){
    fetch('/php/controladores/agregarProductoFactura.php',{
    method:'POST',
    body: formdata,
    mode:'cors',
    }).then(response=>response.json())
    .then((data)=>{
    console.log(data);
    if(data.message=='sinStock'){
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: data.error,
        confirmButtonText: 'Aceptar',
        });
    }else{
        loadProductosAdd();
        productosDisponibles();
    }
        
    })
    .catch((err)=>{
        console.log(err);
    })
    
    
}else{
Swal.fire({
    title:'error',
    text:'primero debes crear o seleccionar una factura',
    icon:'error'
})
}



}


function agregarTotalFact(idFact,total){
let Idfactura=idFact;
let Total=total;
let formdata=new FormData();
formdata.append('idFactura',Idfactura);
formdata.append('total',Total);

    fetch('/php/controladores/agregarTotalFactID.php',{
        method:'POST',
        body:formdata,
        mode:'cors',
    }).then(response=>response.json())
    .then((factura)=>{
        console.log(factura);
    })
    .catch((err)=>{
        console.log(err);
    })

}


function loadProductosAdd(){
    let idFactura=document.getElementById('idfactura').value;
    if(idFactura){
        let formdata= new FormData();
        formdata.append('idFactura', idFactura);
        fetch('/php/controladores/loadProductosAdd.php',{
            method:'POST',
            body: formdata,
            mode:'cors',
        }).then(response=>response.json())
        .then((data)=>{
            console.log(data);
            let productos=data.productos;
            const tableProducts=document.getElementById('table-productos-añadidos');
            let totalProducts=document.getElementById('total');
            let total=0;
            tableProducts.innerHTML='';
            
           
            productos.forEach(producto => {
                 total+=producto.precioBase*producto.cantidad;
                const row = document.createElement('tr');

                const imageCell = document.createElement('td');
                const img = document.createElement('img');
                img.src = '/img/' + producto.img;
                img.alt = producto.descripcion;
                img.style.width = '50px';
                imageCell.appendChild(img);
                row.appendChild(imageCell);
            
                const nombreCell = document.createElement('td');
                nombreCell.innerText = producto.descripcion;
                row.appendChild(nombreCell);
            
                const unidadDeMedidaCell = document.createElement('td');
                unidadDeMedidaCell.innerText = producto.unidadMedida || 'N/A';
                row.appendChild(unidadDeMedidaCell);
            
                const cantidadCell = document.createElement('td');
                cantidadCell.innerText = producto.cantidad;
                row.appendChild(cantidadCell);
            
                const precioBaseCell = document.createElement('td');
                precioBaseCell.innerText = producto.precioBase;
                row.appendChild(precioBaseCell);
            
                const estadoCell = document.createElement('td');
                estadoCell.innerText = producto.estado || 'N/A';
                row.appendChild(estadoCell);
            
                const accionesCell = document.createElement('td');
                accionesCell.innerHTML = '<button type="button" class="btn btn-warning no-print"><i class="fa-solid fa-pen-to-square"></i></button>';
                row.appendChild(accionesCell);
            
                const quitarCell = document.createElement('td');
                quitarCell.innerHTML = '<button type="button" class="btn btn-danger no-print">Eliminar</button>';
                row.appendChild(quitarCell);
            
                tableProducts.appendChild(row);
                
            });
            totalProducts.value=total;
            agregarTotalFact(idFactura,total);
            
        })
        .catch((err)=>{
        console.log(err);
        })
    }
   
}

//buscar productos en ventas
document.getElementById('searchInput').addEventListener('keyup',function(e){
    let valorSearch=document.getElementById('searchInput').value;
    let showProducts=document.getElementById('listProducts');
    let formdata= new FormData();
    formdata.append('search',valorSearch);
    console.log(valorSearch);
    if(valorSearch){
        fetch('/php/controladores/buscarproductoName.php',{
            
            method:'POST',
            body:formdata,
            mode:'cors'
        }).then(response=>response.json())
        .then((data) => {
        console.log(data);
        showProducts.innerHTML='';
            data.products.forEach(producto => {
                 const row = document.createElement('tr');

                const imageCell = document.createElement('td');
                const img = document.createElement('img');
                img.src = '/img/' + producto.img;
                img.alt = producto.descripcion;
                img.style.width = '50px';
                imageCell.appendChild(img);
                row.appendChild(imageCell);
            
                const nombreCell = document.createElement('td');
                nombreCell.innerText = producto.descripcion;
                row.appendChild(nombreCell);
            
                const precioBaseCell = document.createElement('td');
                precioBaseCell.innerText = producto.precioBase;
                row.appendChild(precioBaseCell);
            
                const accionesCell = document.createElement('td');
                accionesCell.innerHTML = '<button type="button" onclick="Modal('+producto.id+')" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></button> ' ;
                row.appendChild(accionesCell);
            
            
                showProducts.appendChild(row);
                
            });
            
        })
        .catch((err)=>{console.log('ERROR'+err)});
        
    }
    
   

});

function imrpimirFactura(){
let factura=document.getElementById('idfactura').value;
console.log(factura);
if(factura){
    print();
}else{
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se ha seleccionado una factura',
    })
}

}

function verFactura(Id){
    let idVenta=Id;
    if(idVenta){
        let inputID=document.getElementById('idfactura');
        inputID.value=idVenta;
        let editarFacturaButtom=document.getElementById('editarFacturaAct');
        let imprimirFacturaButtom=document.getElementById('imprimirFactura');
        imprimirFacturaButtom.innerHTML='';
        editarFacturaButtom.innerHTML='';
        editarFacturaButtom.innerHTML='<button type="button" onclick="modificarFactura('+idVenta+')" class="btn btn-success custom-btn w-100" >editar factura</button>';
        imprimirFacturaButtom.innerHTML+='<button type="button" onclick="imrpimirFactura()" class="btn btn-primary custom-btn w-100" >imprimir factura</button>';
        
        cargarDatosFactura();
        


        const modalElement = document.getElementById('VerFacturas');
        const bsModal = bootstrap.Modal.getInstance(modalElement);
    
        if (bsModal) {
            bsModal.hide();
        }
        
        Swal.fire({
            title:'factura cargada',
            text:'puedes modificarla y añadirle mas productos',
            icon:'success',
            confirmButtonText:'bueno',
        })
    

    }
    
    
}

function cargarDatosFactura(){
    let idFactura=document.getElementById('idfactura').value;
    let idVendedor=sessionStorage.getItem('xuclmt');
    let vendedor=document.getElementById('idvendedor');
    let estadoFactura=document.getElementById('estadofactura');
    let totaltemp=document.getElementById('estadofactura');
    let cliente=document.getElementById('IDcliente');
    let clienteNombre=document.getElementById('nombrecliente');
    let formdata =new FormData();
    formdata.append('idFactura',idFactura);
    console.log(idFactura);
    
    fetch('/php/controladores/loadFactura.php',{
        method:'POST',
        body:formdata,
        mode:'cors',
        
        }).then(response=>response.json())
        .then((data)=>{
                let facturas=data.factura;
                
                facturas.forEach(factura => {
                    vendedor.value=idVendedor;
                    cliente.value=factura.ciNit;
                    clienteNombre.value=factura.ciNit+'-'+factura.nombre+' '+factura.apellido;
                    totaltemp.value=factura.total;
                    estadoFactura.selectedIndex  =factura.estado;
                    loadProductosAdd();
                });
        })
        .catch((err)=>{
            console.log(err);
        })
};


document.addEventListener('DOMContentLoaded',function(){
    
    productosDisponibles();
})