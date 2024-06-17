

<?php

require_once '/platvent_2/php/controladores/config.php';

$idGet = $_GET['id'];
echo '<div class="alert alert-danger m-auto col-3">producto a modificar con id : ' . $idGet . '</div>';

$con = conectarDB();

$sql = $con->query('select *from producto where id=' . $idGet . ' ');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/modifyProduct.css">
    <script src="https://kit.fontawesome.com/4a47433372.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<header class="text-center py-3">
        <h1 class="text-center text-secondary font-weight-bold ">modificar producto</h1>
    </header>
    <nav class="text-center my-3">
        <button class="btn btn-primary mx-2" onclick="window.location='/index.php'">Inicio</button>
        <button class="btn btn-danger mx-2" onclick="window.location.href='/php/pantallas/user.php'">Mis productos</button>
    </nav>
    <div class="container-fluid row ">
        <form class="col-6 p-3 border rounded shadow-sm m-auto" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend class="text-center">editar Producto</legend>
                <input class="form-control" type="hidden" name="idProduct" value="<?=$idGet?>"  readonly>
                <?php
                
                require_once '/platvent_2/php/controladores/editarProducto.php';

                while ($producto = $sql->fetch_object()) {

                    ?>
                                <div class="mb-3">
                                <label for="nombre" class="form-label">Descripción o Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Descripción o nombre" value="<?= $producto->descripcion ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad" value="<?= $producto->stock ?>">
                            </div>
                            <div class="mb-3">
                                <label for="medida" class="form-label">Unidad de Medida</label>
                                <input type="text" id="medida" name="medida" class="form-control" placeholder="Unidad de medida" value="<?= $producto->unidadMedida ?>">
                            </div>
                            <div class="mb-3">
                                <label for="estadoSelect" class="form-label">Estado</label>
                                <select id="estadoSelect" name="estado" class="form-select">
                                <option value="null">estado</option>
                                <?php

                                $est = $con->query('select *from estadoproducto order by 1');

                                if ($est->num_rows > 0) {
                                    while ($estado = $est->fetch_assoc()) {
                                        if ($estado['idestadoProducto'] == $producto->estado) {

                                            ?>
                                                        <option value="<?= $estado['idestadoProducto'] ?>" selected ><?= $estado['estado'] ?></option>
                                                        <?php

                                        } else {

                                            ?>
                                                         <option value="<?= $estado['idestadoProducto'] ?>"><?= $estado['estado'] ?></option>
                            
                                                        <?php
                                        }

                                    }

                                }

                                ?>
                        
                           
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="precioBase" class="form-label">Precio Base</label>
                                <input type="number" step="any" name="precioBase" id="precioBase" class="form-control" placeholder="Precio Base" value="<?= $producto->precioBase ?>">
                            </div>
                            <div class="mb-3">
                                <label for="imgAfter" class="form-label">img</label>
                                <input type="text" name="imgAfter" id="imgAfter"  class="form-control" placeholder="imgAfter" readonly value="<?= $producto->img ?>">
                            </div>
                            <div class="mb-3">
                                <img id="previewImage" src="/img/<?=$producto->img?>" alt="Previsualización de la imagen" alt="vistaimg" style="max-width: 100px; display: none; margin:auto;">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label" id="imgProduct">Imagen del Producto (JPG o PNG)</label>
                                <input class="form-control" id="img" type="file" value="" name="img">
                            </div>
                            <button type="buttom" name="btnmodificar" value="ok" class="btn btn-success w-100">modificar</button>

                
                            <?php


                }

                ?>
            
            </fieldset>
        </form>
        
        
    </div>
    
    
    <script src="/js/modifyProduct.js"></script>
    <script ></script>
</body>
</html>