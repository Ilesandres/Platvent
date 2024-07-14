<?php

require_once '../layouts/headerAdmin.php';

?>
<link rel="stylesheet" href="/css/checkboxActive.css">

<div class="container-sm">
    <div class="row">
        <?php
    require_once '../controladores/config.php';
    $conexion = conectarDB();

    $sql = 'select *from oficina';
    $Res = $conexion->query($sql);
    if ($Res->num_rows > 0) {
        while ($row = $Res->fetch_assoc()) {
            $estado='desactivado';
            $img='oficinas-mapa.jpg';
            
            if($row['estado']==1){
                $estado='activado';
                $img='active-page.jpg';
            }
            ?>
            <div class="p-3 mb-2 bg-warning text-dark m-auto" id="loading"  style="display: none;">
                <p>Cargando...</p>
            </div>

        <div class="card m-2" style="width: 18rem;">
            <img id="imgCard<?= $row['id'] ?>" src="/icons/active-page.jpg" class="card-img-top" alt="activa-img">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <div class="mb-3">
                    <div class="switch-container">
                        <label for="switch"> Oficina Activa</label>
                        <label class="switch">
                        <?php 
                        if($row['estado']==1){?>
                            <input name="switch" checked type="checkbox" id="toggleSwitch<?=$row['id']?>"
                                    onchange="handleToggleChange(this, <?= $row['id'] ?>)">
                                <span class="slider"></span>
                            </label>
                            <p id="switchValue<?= $row['id'] ?>" value="activo">activo</p>
                            <?php
                        }else{?>
                              <input name="switch"  type="checkbox" id="toggleSwitch"
                                    onchange="handleToggleChange(this, <?= $row['id'] ?>)">
                                <span class="slider"></span>
                            </label>
                            <p id="switchValue<?= $row['id'] ?>" value="desactivada">desactivado</p>
                        
                        <?php
                        
                        }
                        
                        ?>
                            
                    </div>
                </div>
                <div class="mb-3">
                    <h4><?= $row['nombre'] ?></h4>
                </div>
                <div class="mb-3">
                    <h5 id="estado<?=$row[ 'id' ]?>"><?= $estado ?></h5>

                </div>
                <div class="mb-3">
                    <p><?=$row['direccion']?></p>
                </div>
                <button class="btn btn-success"  onclick="cargarOficina(<?=$row['id']?>)" >editar</button>
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


<div class="modal fade" id="modalOficina" tabindex="-1" aria-labelledby="modalOficinaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalOficinaLabel">editar Oficina</h5>
                <button onclick="closeEditar()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="" class="form-label">nombre</label>
                    <input type="text" name="" id="nombreOficina" class="form-control" placeholder="nombre Oficina" aria-describedby="helpId" />
                    <small id="helpId" class="text-muted">nombre de oficina</small>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">direccion</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="direccion" aria-describedby="helpId" />
                    <small id="helpId" class="text-muted">direccion</small>
                </div>
                <label for="" class="form-label">departamento</label>
                <select class="form-select" id="departamentoOficina" aria-label="Default select example">
                <option value="null">departamento</option>
                <?php 
                    require_once '../controladores/config.php';
                    
                    $conn=conectarDB();
                    
                    $departamento='select *from departamento';
                    $departamentoRes=$conn->query($departamento);
                    
                    if($departamentoRes->num_rows>0){
                    
                        while($row=$departamentoRes->fetch_assoc()){
                        echo '<option value="'.$row['idDepartamento'].'">'.$row['departamento'].'</option>';
                        }
                    }
                    
                ?>
                 
                 </select>
                 <label for="" class="form-label">municipio</label>
                 <select id="municipioOficina" class="form-select" disabled >
                    <option value="null" selected>municipio</option>
                 </select>
                 <div class="mb-3">
                    <label for="" class="form-label">encargado</label>
                    <div class="container-fluid m-0">
                        <div class="row">
                            <div class="col-5">
                                <input type="text" name="encargado" id="encargado" class="form-control" placeholder="encargado" readonly aria-describedby="helpId" />
                            </div>
                            <div class="col-3">
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#BuscarEncargado">Search</button>
                            </div>
                            <div class="col-3">
                                <input type="text" name="encargado" id="idEncargado" class="form-control" placeholder="id" readonly  />
                            </div>
                       
                    </div>
                    <br>
                    </div>
                    
                    
                    <small id="helpId" class="text-muted">encargado id o nombre</small>
                </div>

            </div>
            
            <div class="modal-footer">
                <button type="button" onclick="closeEditar()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="BuscarEncargado" tabindex="-1" aria-labelledby="BuscarEncargadoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content" style="background-color: #8F8F8F">
      <div class="modal-header">
        <h5 class="modal-title" id="BuscarEncargadoLabel">Busca Encargado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closeEmpleadoSearch()" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mb-3">
        <input type="search" placeholder="Nit o id encargado" id="NitEmpleado" class="form-control" >
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeBuscarEncargado" onclick="closeEmpleadoSearch()" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning"  id="buscarEmpleado">buscar</button>
      </div>
    </div>
  </div>
</div>



<script src="/js/oficinasAdmin.js"></script>

</body>