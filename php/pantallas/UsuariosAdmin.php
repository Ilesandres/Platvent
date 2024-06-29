<?php 
require_once '../layouts/headerAdmin.php';

?>

<link rel="stylesheet" href="/css/usuariosAdmin.css">

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
                <?php 
                if($row['isActivo']==true){
                
                ?>
                        <h6>estado : activo</h6>
                        <p class="card-text"><?=$row['descripcion']?></p>
                    
                
                <?php 
                }else{
                    
                    ?>
                    <h6>estado : desactivado</h6>
                    <p class="card-text"><?=$row['descripcion']?></p>
                    
                    
                    <?php
                    
                }
                ?>
                
                </div>
                <div class="card-footer">
                    <button type="button" data-bs-toggle="modal" href="#editarUser" onclick="VerUsuario(<?=$row['idUsuario']?>)" class="btn btn-success">VER</button>
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
<div id="modales">

</div>

<!-- Modal -->
<div class="modal fade" id="EditarUsuario" tabindex="-1" aria-labelledby="EditarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditarUsuarioLabel">editar usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Woohoo, you're reading this text in a modal!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="editarUser" aria-hidden="true" aria-labelledby="editarUserLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUserLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" onclick="closeModaleditarUsuario()" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="p-3 border rounded shadow-sm">
                <div class="mb-3">
                
                    <div class="switch-container">
                    <label for="switch"> Usuario Activo</label>
                        <label  class="switch">
                            <input name="switch" type="checkbox" id="toggleSwitch" onchange="handleToggleChange(this)">
                            <span class="slider"></span>
                        </label>
                        <p id="switchValue" value="false">false</p>
                    </div>

                    </div>
                <div class="mb-3">
                        <label for="idUser" class="form-label">idUser</label>
                        <input type="text" id="idUser" readonly name="idUser" class="form-control" placeholder="idUser">

                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
                    </div>
                    <label for="rol">Rol</label>
                    <select name="rol" class="form-select" id="rol" aria-label="Default select example">
                        <option value="null" selected>selecciona una opcion</option>
                        <?php
                            
                            require_once '../controladores/config.php';
                            $conexion=conectarDB();
                            $sqlCon="select *from rol";
                            $sqlConRes=$conexion->query($sqlCon);
                            if($sqlConRes->num_rows>0){
                                while($row=$sqlConRes->fetch_assoc()){
                                
                                ?>
                                
                                <option value="<?=$row['idRol']?>"><?=$row['Rol']?></option>
                                
                                <?php 
                                
                                }
                            }
                            
                        ?>
                    </select>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripción"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo">
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <span>
                            <h5>por seguridad no se muestra la contraseña, si deseas puedes escribir una nueva</h5>
                        </span>
                        <input type="text" id="contraseña" name="contraseña" class="form-control" placeholder="Contraseña">
                    </div>
                    <button type="button" value="ok" class="btn btn-success" onclick="editarUsuario()" name="btnagregarcliente">editar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModaleditarUsuario()" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script src="/js/UsuarioAdmin.js"></script>

</body>