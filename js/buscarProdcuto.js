

function buscar(){

let search =document.getElementById('search').value;

//console.log(search);

if(search!==null && search!==''){
    window.location.href ='/php/pantallas/busqueda.php?id='+search;
}else{
    Swal.fire({
    Title:'por favor digite el valor a buscar',
    text:'no puedes dejar el valor de busqueda vacio',
    icon:'error',
    })
}





}