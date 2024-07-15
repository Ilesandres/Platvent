document.getElementById('home').addEventListener('click',function(e){
    e.preventDefault();
    window.location.href = "/php/pantallas/admin.php";
})

document.addEventListener('DOMContentLoaded',function(e){
    e.preventDefault();
    //console.log(1235)
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
     //console.log(idPage+' '+checkValue);
     
     
    if(idPages){
    let imgCard=document.getElementById('imgCard'+idPage);
        fetch('/php/controladores/activarPage.php',{
            method:'POST',
            body:formdata,
            mode:'cors'
        }).then(response=>response.json())
        .then((response)=>{
            //console.log(response)
            if(response.status=='success'){
                Swal.fire({
                    title:response.status, 
                    text:response.message,
                    icon: response.status,
                    showConfirmButton:false,
                    timer: 1500
                })
                if(response.estado=='true'){
                    imgCard.src='/icons/active-page.jpg';
                    imgCard.style.transition = 'transform 1s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.5s ease-out';
                    imgCard.style.transform = 'scale(1.1) rotate(10deg)';
                    imgCard.style.opacity = '0';


                    setTimeout(function() {
                        imgCard.style.transform = 'scale(1) rotate(0deg)';
                        imgCard.style.opacity = '1';
                    }, 100);

                    imgCard.classList.add('epic-animation');


                    setTimeout(function() {
                        imgCard.classList.remove('epic-animation');
                    }, 1500);
                }else{
                    imgCard.src='/icons/desactive-page.jpg';
                    imgCard.style.transition = 'transform 1s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.5s ease-out';
                    imgCard.style.transform = 'scale(1.1) rotate(10deg)';
                    imgCard.style.opacity = '0';

                    setTimeout(function() {
                        imgCard.style.transform = 'scale(1) rotate(0deg)';
                        imgCard.style.opacity = '1';
                    }, 100);

                    imgCard.classList.add('epic-animation');
                    setTimeout(function() {
                        imgCard.classList.remove('epic-animation');
}, 1500);
                }
                
                    const switchValue = document.getElementById('switchValue'+idPage);
                    switchValue.textContent = checkbox.checked ? 'activo' : 'desactivado';
            
            }
            
        })
        .catch((err)=>{
            //console.log(err);
        })
    }
    


   
}
