document.getElementById('home').addEventListener('click',function(e){
    window.location.href='/php/pantallas/admin.php';
})

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
    const switchValue = document.getElementById('switchValue'+idOficina);
    switchValue.textContent = checkbox.checked ? 'activo' : 'desactivado';
}