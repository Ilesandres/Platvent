
document.getElementById('home').addEventListener('click',function(e){
    window.location.href='/php/pantallas/admin.php';
    e.preventDefault();
    
})

function VerUsuario(idUsuario){
    
    let nombre=document.getElementById('nombre');
    let idUser1=document.getElementById('idUser');
    let usuario=document.getElementById('usuario');
    let descripcion=document.getElementById('descripcion');
    let correo = document.getElementById('correo');
    let contraseña=document.getElementById('contraseña');
    let isActive=document.getElementById('toggleSwitch');
    const switchValue = document.getElementById('switchValue');
    let activo;
    let idUser=idUsuario;
    let formdata= new FormData();
    formdata.append('idUSer', idUser);
    fetch('/php/controladores/buscarUsuarioId.php',{
         method : 'POST',
         body: formdata,
         mode: 'cors'
    }).then(response=>response.json())
    .then((data)=>{
        console.log(data)
        if(data.status=='succes'){
            let user=data.data;
            console.log(user)
            nombre.value = user.nombre;
            idUser1.value = user.idUsuario;
            usuario.value=  user.usuario;
            descripcion.value= user.descripcion;
            
            if(user.isActivo=='1'){
                activo=true;
            }else if(user.isActivo=='0'){
                activo=false;
            }
            correo.value= user.correo;
            isActive.checked=activo;
            switchValue.textContent=''+ activo+'';
        }
    })
    .catch((err)=>{
        console.log(err)
    })
    
}

function closeModaleditarUsuario(){
    let nombre=document.getElementById('nombre');
    let idUser=document.getElementById('idUser');
    let usuario=document.getElementById('usuario');
    let descripcion=document.getElementById('descripcion');
    let correo = document.getElementById('correo');
    let contraseña=document.getElementById('contraseña');
    let isActive=document.getElementById('toggleSwitch');
    const switchValue = document.getElementById('switchValue');
    
    nombre.value='';
    idUser.value='';
    usuario.value='';
    descripcion.value='';
    correo.value='';
    contraseña.value='';
    isActive.checked=false;
    switchValue.textContent='false';

    const modalElement = document.getElementById('editarUser');
    const bsModal = bootstrap.Modal.getInstance(modalElement);

    if (bsModal) {
        bsModal.hide();
    }

    
}

function editarUsuario(idUsuario){
    let idUser=document.getElementById('idUser').value;
    let estado=document.getElementById('toggleSwitch').checked;
    
    let nombre=document.getElementById('nombre').value;
    let usuario=document.getElementById('usuario').value;
    let descripcion=document.getElementById('descripcion').value;
    let correo = document.getElementById('correo').value;
    let contrasena=document.getElementById('contraseña').value;
    
    if(idUser && nombre && usuario && descripcion && correo ){
        let formdata=new FormData();
        formdata.append('idUser',idUser);
        formdata.append('nombre',nombre);
        formdata.append('usuario',usuario);
        formdata.append('descripcion',descripcion);
        formdata.append('correo',correo);
        if(contrasena){
            formdata.append('contrasena',contrasena);
        }
          
        formdata.append('estado',estado);
        
        fetch('/php/controladores/editarUsuario.php',{
            method: 'POST',
            body: formdata,
            mode:'cors'
        }).then(response=>response.json())
        .then((data)=>{
            console.log(data)
            Swal.fire({
                icon: 'success',
                title: 'Usuario editado',
                text: data.message
            }).then((result)=>{
                if(result.isConfirmed){
                    location.reload();
                }
            })
        })
        .catch((err)=>{
            console.log(err);
        })
        
        console.log(idUser+' '+estado)
    }else{
        Swal.fire({
            title: 'Error',
            text: 'Faltan datos por llenar',
            icon: 'error',
            
        })
    }
    
    
    
}


function handleToggleChange(checkbox) {
    const switchValue = document.getElementById('switchValue');
    switchValue.textContent = checkbox.checked ? 'true' : 'false';
}

