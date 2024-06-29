document.getElementById('home').addEventListener('click',function(e){
    e.preventDefault();
    window.location.href = "/php/pantallas/admin.php";
})

document.addEventListener('DOMContentLoaded',function(e){
    e.preventDefault();
    console.log(1235)
})

function handleToggleChange(checkbox,idPage) {
    
    let idPages=idPage;
    let checkValue;
    let mostrar;
    
    if(checkbox.checked){
        checkValue=true;
        mostrar='activo';
    }else{
        checkValue=false;
        mostrar='desactivado';
    }
    let formdata=new FormData();
    formdata.append('idPage',idPage);
    formdata.append('checkValue',checkValue);
     console.log(idPage+' '+checkValue);
     
     
    if(idPages){
        fetch('/php/controladores/activarPage.php',{
            method:'POST',
            body:formdata,
            mode:'cors'
        }).then(response=>response.json())
        .then((response)=>{
            console.log(response)
            Swal.fire({
                title:response.status, 
                text:response.message,
                icon: response.status,
                showConfirmButton:false,
                timer: 1500
            })
                const switchValue = document.getElementById('switchValue'+idPage);
                switchValue.textContent = checkbox.checked ? 'activo' : 'desactivado';
        })
        .catch((err)=>{
            console.log(err);
        })
    }
    


   
}
