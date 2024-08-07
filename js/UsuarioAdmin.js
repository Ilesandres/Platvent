
document.getElementById('home').addEventListener('click',function(e){
    window.location.href='/php/pantallas/admin.php';
    e.preventDefault();
    
})

function VerUsuario(idUsuario){
    
    let nombre=document.getElementById('nombre');
    let idUser1=document.getElementById('idUser');
    let usuario=document.getElementById('usuario');
    let rol=document.getElementById('rol');
    let descripcion=document.getElementById('descripcion');
    let correo = document.getElementById('correo');
    let contraseña=document.getElementById('contraseña');
    let Cinit=document.getElementById('CiNit');
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
        //console.log(data)
        if(data.status=='succes'){
            let user=data.data;
            //console.log(user)
            nombre.value = user.nombre;
            idUser1.value = user.idUsuario;
            rol.value=user.idRol;
            usuario.value=  user.usuario;
            descripcion.value= user.descripcion;
            Cinit.value=user.CiNit;
            
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
        //console.log(err)
    })
    
}

function closeModaleditarUsuario(){
    let nombre=document.getElementById('nombre');
    let idUser=document.getElementById('idUser');
    let usuario=document.getElementById('usuario');
    let descripcion=document.getElementById('descripcion');
    let correo = document.getElementById('correo');
    let rol=document.getElementById('rol');
    let Cinit=document.getElementById('CiNit');
    let contraseña=document.getElementById('contraseña');
    let isActive=document.getElementById('toggleSwitch');
    const switchValue = document.getElementById('switchValue');
    
    nombre.value='';
    idUser.value='';
    usuario.value='';
    descripcion.value='';
    correo.value='';
    rol.value='';
    Cinit.value='';
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
    let rol=document.getElementById('rol').value;
    let nombre=document.getElementById('nombre').value;
    let usuario=document.getElementById('usuario').value;
    let descripcion=document.getElementById('descripcion').value;
    let correo = document.getElementById('correo').value;
    let contrasena=document.getElementById('contraseña').value;
    let CiNit=document.getElementById('CiNit').value;
    
    if(idUser && nombre && usuario && descripcion && correo && rol!=='null'&& CiNit ){
        let formdata=new FormData();
        formdata.append('idUser',idUser);
        formdata.append('nombre',nombre);
        formdata.append('usuario',usuario);
        formdata.append('descripcion',descripcion);
        formdata.append('correo',correo);
        formdata.append('rol',rol);
        formdata.append('CiNit',CiNit);
        if(contrasena && contrasena.trim()!==''){
            formdata.append('contrasena',contrasena);
        }
          
        formdata.append('estado',estado);
        
        fetch('/php/controladores/editarUsuario.php',{
            method: 'POST',
            body: formdata,
            mode:'cors'
        }).then(response=>response.json())
        .then((data)=>{
            //console.log(data)
            Swal.fire({
                icon: data.status,
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
        
        //console.log(idUser+' '+estado)
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

