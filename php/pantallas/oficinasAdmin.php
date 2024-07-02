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
            
            if($row['estado']==1){
                $estado='activado';
            }
            ?>

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
                            <input name="switch" checked type="checkbox" id="toggleSwitch"
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
                    <h5><?=$estado?></h5>
                </div>
                <div class="mb-3">
                    <p><?=$row['direccion']?></p>
                </div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalOficina">editar</button>
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
                <h5 class="modal-title" id="modalOficinaLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId" />
                    <small id="helpId" class="text-muted">Help text</small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script src="/js/oficinasAdmin.js"></script>

</body>