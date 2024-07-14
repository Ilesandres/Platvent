document.getElementById('home').addEventListener('click',function(e){
    window.location.href='/php/pantallas/admin.php';
})


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
                console.log(data)
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
            console.log(check.checked)
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

        console.log(departamentoOficina)
        if(departamentoOficina && departamentoOficina !== 'null') {
            fetch('/php/controladores/Buscarmuni.php', {
                method: 'POST',
                body: formdata,
                mode: 'cors'
            }).then(response => response.json())
            .then((data) => {
                console.log(data);
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
            console.log(response);
            let empleado=document.getElementById('encargado');
            empleado.value=response.data.ciNit;
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
        console.log(datos);
        return(datos);
        } catch (error) {
            
        }
      
   

    
}

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
        console.log(data);
        return data;
    } catch (err) {
        console.log(err);
    }
}


async function cargarOficina(idOficina) {
showLoading();

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
        console.log(data);

        let oficina = data.oficina;
        let departamentoOficina = document.getElementById("departamentoOficina");
        let municipioOficina = document.getElementById('municipioOficina');
        let nombre = document.getElementById('nombreOficina'); 
        let direccion = document.getElementById('direccion'); 
        let encargado = document.getElementById('encargado');
        let idEncargado = document.getElementById('idEncargado');

        // Busco el departamento
        let depar = await buscarmuni(oficina.idMunicipio);
        console.log('idDepar');
        console.log(depar);

        departamentoOficina.value = depar.data.idDepartamento;

        municipioOficina.removeAttribute('disabled');
        await LoadMunicipios();

        nombre.value = oficina.nombre;
        direccion.value = oficina.direccion;
        
        
        idEncargado.value = oficina.idEncargado;
        
         municipioOficina.value=oficina.idMunicipio;
         //buscamos e insertamos el empleado
         let empleado= await buscarEmpleadoID(oficina.idEncargado)
         console.log('empleado');
         console.log(empleado)
         let emp=empleado.data;
         encargado.value = emp.ciNit+'-'+emp.usuario+'';
        
    } catch (err) {
        console.log(err);
    }finally{
        hideLoading();
        modal.show();
    }
}

function showLoading() {
    document.getElementById('loading').style.display = 'block';
}

function hideLoading() {
    document.getElementById('loading').style.display = 'none';
}