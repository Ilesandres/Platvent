

<?php 
require_once '../layouts/headerAdmin.php';


?>
<link rel="stylesheet" href="/css/paginasAdmin.css">

<div class="container-sm">
<div class="row">
<?php 
require_once '../controladores/config.php';

$conexion=conectarDB();

$paginas="select *from windows inner join windowsActiva on windows.id=windowsActiva.idWindow";

$paginasRes=$conexion->query($paginas);

if($paginasRes->num_rows>0){
    while($row=$paginasRes->fetch_assoc()){
        
        ?>
        <div class="card m-2" style="width: 18rem;">
        <?php 
        
            if($row['Activa']==1){
            ?>
            <img src="/icons/active-page.jpg" class="card-img-top" alt="activa-img">
            
            <?php
            
            
            }else{
            ?>
            <img src="/icons/desactive-page.jpg" class="card-img-top" alt="desactive-img">
            
            <?php 
            
            }
        ?>
            
            <div class="card-body">
                <h5 class="card-title"><?=$row['pestana']?></h5>
                <p class="card-text"><?=$row['ruta']?></p>
                <div class="mb-3">
                
                <div class="switch-container">
                <label for="switch"> pagina Activa</label>
                    <label  class="switch">
                    <?php
                        if($row['Activa']==1){
                        ?>
                            <input name="switch" checked type="checkbox" id="toggleSwitch" onchange="handleToggleChange(this,<?=$row['id']?>)">
                            <span class="slider"></span>
                        </label>
                        <p id="switchValue<?=$row['id']?>" value="activo">activo</p>
                        
                        <?php
                        
                        }else{
                        ?>
                        <input name="switch"  type="checkbox" id="toggleSwitch" onchange="handleToggleChange(this,<?=$row['id']?>)">
                            <span class="slider"></span>
                        </label>
                        <p id="switchValue<?=$row['id']?>" value="desactivado">desactivado</p>
                        
                        <?php
                        
                        
                        }

                    ?>
                        
                </div>

                </div>
            </div>
         </div>
        
        <?php 
        
    }
}
?>



   </div>
</div>

<footer>
    footer
</footer>
<script src="/js/paginasAdmin.js"></script>
</body>