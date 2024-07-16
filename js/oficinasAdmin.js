document.getElementById('home').addEventListener('click',function(e){
    window.location.href='/php/pantallas/admin.php';
})

//cargar nueva navbar 

document.addEventListener('DOMContentLoaded',function(e){
    let Texcontent=document.getElementById('contentExtra');
    Texcontent.style.display='block';
    
    const container=document.createElement('div');
    container.classList.add('container');
    container.classList.add('container-fluid');
    
    const option1=document.createElement('a');
    option1.classList.add('btn');
    option1.classList.add('navbar-brand');
    option1.type='button';
    option1.textContent='agregar';
    option1.id='agregarOficnaId';
    container.appendChild(option1);
    
    let option2=document.createElement('a');
    option2.classList.add('btn');
    option2.classList.add('navbar-brand');
    option2.type='button';
    option2.textContent='transferir usuario';
    option2.id='transferirUsuarioId';
    container.appendChild(option2);
    
    Texcontent.appendChild(container);
    
    document.getElementById('agregarOficnaId').addEventListener('click', function(e){
    agregarOficina();
    })
    document.getElementById('transferirUsuarioId').addEventListener('click', function(e){
        transferirUsuario();
    })


    
})

function transferirUsuario(){
    let modalShow=document.getElementById('MoveUser');
    let modal= new bootstrap.Modal(modalShow);
    modal.show();
}


function agregarOficina(){
    console.log('cargando oficina');
    let modalSearch=document.getElementById('modalOficina');
    let button=document.getElementById('btnSave');
    let modal= new bootstrap.Modal(modalSearch);
    modal.show();
    button.onclick=function(){
        enviarOficina();
    };
}

//agrega una nueva oficina
function enviarOficina(){
    console.log('enviando oficina');
    let nombre =document.getElementById('nombreOficina').value;
    let direccion =document.getElementById('direccion').value;
    let municipio =document.getElementById('municipioOficina').value;
    let encargado =document.getElementById('idEncargado').value;
    let modalSearch=document.getElementById('modalOficina');
    
    let formdata=new FormData();
    if(nombre && direccion && municipio && encargado){
        formdata.append('nombre',nombre);
        formdata.append('direccion',direccion);
        formdata.append('municipio',municipio);
        formdata.append('encargado',encargado);
        
        for (let [key, value] of formdata.entries()) {
            console.log(key, value);
        }
        fetch('/php/controladores/agregarOficina.php',{
            method:'POST',
            body:formdata,
            mode: 'cors'
        }).then(response=>response.json())
        .then((data)=>{
            console.log(data)
            let modal=bootstrap.Modal.getInstance(modalSearch);
            
            Swal.fire({
                icon: data.status,
                title: data.status,
                text: data.message,
                showConfirmButton: false,
                timer: 2500
            }).then(() => {
                if(data.status=='success'){
                     window.location.reload();
                     modal.hide();
                }
                
            });
        })
        .catch((err)=>{
            console.log(err);
        })
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Faltan datos',
            
        })
    }

    
}

//funcion activar y desactivar la oficina ys sus usuarios
function handleToggleChange(checkbox,idOficina) {
    
    let idPages=idOficina;
    let checkValue;
    let mostrar;
    
    if(checkbox.checked){
        checkValue=true;
        mostrar='activo';
    }else{
        checkValue=false;
        mostrar='desactivado';
    }
    let  check=document.getElementById('toggleSwitch'+idOficina);
    const switchValue = document.getElementById('switchValue'+idOficina);
    let img=document.getElementById('imgCard'+idOficina);
    let text1= switchValue.textContent=='activo'? 'deshabilitaras':'activaras';
    
    let textButton= switchValue.textContent=='activo'? 'Deshabilitar':'Activar';
    const state=document.getElementById('estado'+idOficina);

 
    Swal.fire({
        title: '¿Está seguro?',
        text: 'al hacer esto '+text1+' todos los usuarios vinculados a esta oficina',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#FF001EDC',
        confirmButtonText: 'Si, '+textButton,
        }).then((result) => {
        if (result.isConfirmed) {
        let formdata=new FormData();;
        formdata.append('idOficina',idOficina);
        formdata.append('estado',checkValue);
            fetch('/php/controladores/desactivarOficina.php',{
                method:'POST',
                body:formdata,
                mode:'cors'
            }).then(response=>response.json())
            .then((data)=>{
                Swal.fire({
                    title: 'Oficina '+mostrar,
                    text: 'Se ha '+mostrar+' la oficina correctamente',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3500
                })
                
                switchValue.textContent = checkbox.checked ? 'activo' : 'desactivado';
                state.textContent=switchValue.textContent=='activo' ? 'activado' : 'desactivado';
                img.src=switchValue.textContent=='activo'? '/icons/active-page.jpg': '/icons/oficinas-mapa.jpg';
            })
            .catch((err)=>{
                console.log(err);
                check.checked=switchValue.textContent=='activo' ?  true : false;
            })
            
            
        }else if(result.isDismissed){
            check.checked=switchValue.textContent=='activo' ?  true : false;

            
            console.log(check.checked);
        }

        })
        
   
    
}

function closeEditar(){
    let departamentoOficina=document.getElementById("departamentoOficina");
    let municipioOficina=document.getElementById('municipioOficina');
    let nombre= document.getElementById('nombreOficina'); 
    let direccion= document.getElementById('direccion'); 
    let encargado= document.getElementById('encargado');
    let idEncargado= document.getElementById('idEncargado');
    
    departamentoOficina.value='null';
    municipioOficina.innerhtml='<option value="null" selected>municipio</option>';
    municipioOficina.setAttribute('disabled','disabled');
    nombre.value='';
    direccion.value='';
    encargado.value='';
    idEncargado.value='';
  
  municipioOficina.removeChild(municipioOficina.lastChild);
}

document.getElementById("departamentoOficina").addEventListener('change',function(e){
    LoadMunicipios();
})



function LoadMunicipios() {
    return new Promise((resolve, reject) => {
        let departamentoOficina = document.getElementById("departamentoOficina").value;
        let municipioOficina = document.getElementById('municipioOficina');
        let formdata = new FormData();
        formdata.append('idDepartamento', departamentoOficina);

        if(departamentoOficina && departamentoOficina !== 'null') {
            fetch('/php/controladores/Buscarmuni.php', {
                method: 'POST',
                body: formdata,
                mode: 'cors'
            }).then(response => response.json())
            .then((data) => {
                municipioOficina.removeAttribute('disabled');
                municipioOficina.innerHTML = '';

                const valuenull = document.createElement('option');
                valuenull.value = 'null';
                valuenull.textContent = 'municipio';
                municipioOficina.appendChild(valuenull);    

                data.data.forEach((municipio) => {
                    const option1 = document.createElement('option');
                    option1.value = municipio.idMunicipio;
                    option1.id = 'muni';
                    option1.textContent = municipio.municipio;

                    municipioOficina.appendChild(option1);
                });

                resolve(); // Resuelve la promesa cuando se han cargado los municipios
            })
            .catch((err) => {
                console.log(err);
                reject(err); // Rechaza la promesa en caso de error
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Seleccione un departamento',
                icon: 'error',
            });
            reject('No se seleccionó un departamento'); // Rechaza la promesa si no se seleccionó un departamento
        }
    });
}





document.getElementById('buscarEmpleado').addEventListener('click',function(e){
let Empleado=document.getElementById('NitEmpleado').value;
    if(Empleado && Empleado.trim()!==''){
    const formdata=new FormData();
    formdata.append('idEmpleado',Empleado);
        fetch('/php/controladores/buscarEmpleadoIdCiNit.php',{
            method: 'POST',
            body: formdata,
            mode: 'cors'
        }).then(response=>response.json())
        .then((response)=>{
            let empleado=document.getElementById('encargado');
            empleado.value=response.data.ciNit+'-'+response.data.nombre;
            document.getElementById('idEncargado').value=response.data.idUsuario;
            closeEmpleadoSearch();
            Swal.fire({
                title: 'Empleado encontrado',
                text: 'El empleado seleccionado es: '+response.data.nombre+' ',
                icon: 'success',
                showConfirmButton: false,
                timer: 3500
                
            })
        })
        .catch((err) => {
            console.log(err)
        })
        
        console.log(Empleado);
    }else{
        Swal.fire({
        title: 'Error',
        text: 'Ingrese un NIT',
        icon: 'error',
        })
    }
    
})


function closeEmpleadoSearch(){
    document.getElementById('NitEmpleado').value='';
    
    let modalSearch=document.getElementById('BuscarEncargado');
    let modal= bootstrap.Modal.getInstance(modalSearch);
    modal.hide();
    

}

async function buscarEmpleadoID(ID){

            let Id =ID;
        let formdata=new FormData();
        formdata.append('idEmpleado',Id);
        try {
            const respuesta= await fetch('/php/controladores/buscarUserID.php',{
            method: 'POST',
            body: formdata,
            mode: 'cors'
            
        });
        const datos=await respuesta.json();
        return(datos);
        } catch (error) {
            
        }
      
   

    
}

//buscar departamento/estado
async function buscarmuni(idMunicipio) {
    let idMunicip = idMunicipio;
    let formdata = new FormData();
    formdata.append('idMuni', idMunicip);

    try {
        const response = await fetch('/php/controladores/buscarDepartamentoIdMuni.php', {
            method: 'POST',
            body: formdata,
            mode: 'cors'
        });
        const data = await response.json();
        return data;
    } catch (err) {
        console.log(err);
    }
}


async function cargarOficina(idOficina) {
showLoading();

    let button=document.getElementById('btnSave');
    let modalSearch=document.getElementById('modalOficina');
    let modal= new bootstrap.Modal(modalSearch);
    
    

    let idOficinas = idOficina;
    let formdata = new FormData();
    formdata.append('idOficina', idOficinas);

    try {
        let response = await fetch('/php/controladores/buscarOfinaId.php', {
            method: 'POST',
            body: formdata,
            mode: 'cors'
        });
        let data = await response.json();

        let oficina = data.oficina;
        let departamentoOficina = document.getElementById("departamentoOficina");
        let municipioOficina = document.getElementById('municipioOficina');
        let nombre = document.getElementById('nombreOficina'); 
        let direccion = document.getElementById('direccion'); 
        let encargado = document.getElementById('encargado');
        let idEncargado = document.getElementById('idEncargado');

        // Busco el departamento
        let depar = await buscarmuni(oficina.idMunicipio);

        departamentoOficina.value = depar.data.idDepartamento;

        municipioOficina.removeAttribute('disabled');
        await LoadMunicipios();

        nombre.value = oficina.nombre;
        direccion.value = oficina.direccion;
        
        
        idEncargado.value = oficina.idEncargado;
        
         municipioOficina.value=oficina.idMunicipio;
         //buscamos e insertamos el empleado
         let empleado= await buscarEmpleadoID(oficina.idEncargado)
         let emp=empleado.data;
         encargado.value = emp.ciNit+'-'+emp.usuario+'';
        
    } catch (err) {
        console.log(err);
    }finally{
        button.onclick=function(){
            editarOficina(idOficina);
        }
        hideLoading();
        modal.show();
    }
}


function editarOficina(idOficina){
//compracion en php o js con or
    let nombre =document.getElementById('nombreOficina').value;
    let direccion =document.getElementById('direccion').value;
    let municipio =document.getElementById('municipioOficina').value;
    let encargado =document.getElementById('idEncargado').value;
    let modalSearch=document.getElementById('modalOficina');
    let formdata=new FormData();
    formdata.append('nombre',nombre);
    formdata.append('direccion',direccion);
    formdata.append('idMunicipio',municipio);
    formdata.append('idEncargado',encargado);
    formdata.append('idOficina',idOficina);
    
    fetch('/php/controladores/editarOficinaID.php',{
    method:'POST',
    body: formdata,
    mode: 'cors'
    }).then(response=>response.json())
    .then((data)=>{
    let modal=bootstrap.Modal.getInstance(modalSearch);
        if(data.status!=='success'){
            Swal.fire({
                icon: data.status,
                title: data.status,
                text: data.message,
                showConfirmButton: false,
                timer: 2500
            })
        }else{
        modal.hide();
        closeEditar();
        Swal.fire({
            icon: data.status,
            title: data.status,
            text: data.message,
            showConfirmButton: false,
            timer: 1500
        })
        }
        
    })
    .catch((err)=>{
        console.log(err);
    })
    
}


function showLoading() {
    let load=document.getElementById('loading');
    load.style.display = 'flex';
    load.style.justifyContent='center';
    load.style.alignItems='center';
    document.getElementById('container1').style.display='none';
}

function hideLoading() {
    document.getElementById('loading').style.display = 'none';
    document.getElementById('container1').style.display= 'block'
}

function hideTransfer(){
    console.log('transfiriendo');
}

function transferirUser(){
    let NitEmpleado=document.getElementById('NitEmpleadoTransfer').value;
    let oficinaNueva=document.getElementById('oficinaNueva').value;
    console.log('id '+NitEmpleado+' ofic'+oficinaNueva);
    if(NitEmpleado.trim()!=='' && oficinaNueva!=='null' && NitEmpleado && oficinaNueva ){
        Swal.fire({
            
            title: '¿Estas seguro de transferir el usuario?',
            
            text: "No se podra revertir esta accion",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, transferirlo'
        }).then((response) => {
            if(response.isConfirmed){
            showLoading();
                let formdata=new FormData();
                formdata.append('NitEmpleado',NitEmpleado);
                formdata.append('IdOficina',oficinaNueva);
               
                fetch('/php/controladores/TransferirUsuarioOficina.php',{
                    method:'POST',
                    body:formdata,
                    mode:'cors'
                    
                }).then(response=>response.json())
                .then((data)=>{
                    console.log(data)
                    
                }).catch((err)=>{
                    console.log(err);
                }).finally(()=>{
                    hideTransfer();
                    hideLoading();
                })
            
                console.log('usuario transferido');
            }else{
                console.log('accion cancelada');
            }
        }
        )
    }else{
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Debes llenar todos los campos',
        footer: '<a href="">Why do I have this issue?</a>'
        })
    }
}