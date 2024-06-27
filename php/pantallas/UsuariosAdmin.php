<?php 
require_once '../layouts/headerAdmin.php';

?>
<div class="container-fluid">
<div class="row">
<?php
    require_once '../controladores/config.php';
    $con=conectarDB();
    
    $sql="select *from usuario";
    $sqlRes=$con->query($sql);
    if($sqlRes->num_rows>0){
        while($row=$sqlRes->fetch_assoc()){
        
        ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card" style="width: 50%;">
                <img src="../../icons/support.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                <h1><?=$row['usuario']?></h1>
                <h4><?=$row['nombre']?></h4>
                    <p class="card-text"><?=$row['descripcion']?></p>
                </div>
                <div class="card-footer">
                    <button onclick="window.location.href='#'" class="btn btn-success">VER</button>
                </div>
            </div>
        </div>
        
        
        
        <?php
        }
    }

?>
         




</div>

</div>


<footer class="text-center">
    footer
</footer>

</body>