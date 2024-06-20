<?php
  require_once '/platvent_2/php/controladores/config.php';

  $conn = conectarDB();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sección Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    <link rel="stylesheet" href="/css/user.css">
    <script src="https://kit.fontawesome.com/4a47433372.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/alerts/alert_SwalsuccesProduct.js"></script>

</head>
<body>
    <header class="text-center py-3">
        <h1 class="text-center text-secondary font-weight-bold ">Sección Personal</h1>
    </header>
    <nav class="text-center my-3">
        <button class="btn btn-primary mx-2" title="inicio" onclick="window.location='/index.php'"><i class="fa-solid fa-house"></i></button>
        <a class="btn btn-primary" data-bs-toggle="modal" title="buscar" href="#exampleModalToggle" role="button"><i class="fa-solid fa-magnifying-glass"></i></a>
        <buttom class="btn btn-primary mx-2 " title="perfil" onclick="perfil()"><i class="fa-solid fa-house-user"></i></buttom>

        <buttom class="btn btn-primary mx-2 " title="vender" onclick="window.location.href='/php/pantallas/vender.php'"><i class="fa-solid fa-store"></i></buttom>

        <buttom class="btn btn-primary mx-2 " ></buttom>

        <buttom class="btn btn-primary mx-2 " ></buttom>
        <button class="btn btn-danger mx-2" title="cerrar sesion" onclick="cerrarSesion()">Cerrar Sesión</button>
        
        
                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Buscar producto</h5>
                <button type="button" class="btn-close" onclick="cerrarBuscar()" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
            <div class="form">
            
            <form  method="POST" class="p-3 border rounded shadow-sm">
                
                
                 <div class="mb-3">
                    <label for="search" class="form-label">Descripción o Nombre</label>
                    <input type="text" id="search" name="search" class="form-control"
                        placeholder="Descripción o nombre">
                </div>
                <button type="button" class="btn btn-primary" onclick="SearchProduct()" name="btnBuscar" >search</button>                
            </form>
                
            
            </div>

                escribe los valores para la busqueda

                Show a second modal and hide this one with the button below.

            </div>
            <div class="modal-footer">
            
              </div>
            </div>
        </div>
        </div>

       
                
        
        
        
        
    </nav>
    <div class="container-fluid row">
    <form class="col-3 p-3 border rounded shadow-sm" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend class="text-center">Nuevo Producto</legend>
                <?php
                require_once '/platvent_2/php/controladores/nuevoproducto.php';
                ?>
                <div class="mb-3">
                    <input type="hidden" id="usuario" readonly name="usuario"  class="form-control">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label"> Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control"
                        placeholder=" nombre">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label"> Descripcion </label>
                    <input type="text" id="descripcion" name="descripcion" class="form-control"
                        placeholder="Descripción ">
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad">
                </div>
                <div class="mb-3">
                    <label for="medida" class="form-label">Unidad de Medida</label>
                    <input type="text" id="medida" name="medida" class="form-control" placeholder="Unidad de medida">
                </div>
                <div class="mb-3">
                    <label for="estadoSelect" class="form-label">Estado</label>
                    <select id="estadoSelect" name="estado" class="form-select">
                        <?php
                        $es = $conn->query('select *from estadoproducto');

                        if ($es->num_rows > 0) {
                            while ($estado = $es->fetch_assoc()) {
                        ?>
                        <option value="<?= $estado['idestadoProducto'] ?>"><?= $estado['estado'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="precioBase" class="form-label" step="any">Precio Base</label>
                    <input type="decimal" name="precioBase" id="precioBase" class="form-control"
                        placeholder="Precio Base">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Imagen del Producto (JPG o PNG)</label>
                    <input class="form-control" type="file" name="img" id="formFile" >
                </div>
                <div>
                    <img id="previewImage" src="" alt="img"
                        style="max-width: 100px; display: none; margin:auto;">
                </div>
                <button type="buttom" name="btnregistrar" value="ok" class="btn btn-success w-100" >Agregar</button>
            </fieldset>
        </form>
        <div class="col-8 p-4">
        <?php
            require_once '/platvent_2/php/controladores/eliminarProducto.php'
        ?>
            <table class="table table-striped table-hover table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripciom</th>
                        <th scope="col">Unidad de Medida</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Precio Base</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha Registro</th>
                        <th scope="col">Fecha Actualización</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  

                    $sql = ' select producto.id, producto.img ,producto.descripcion,producto.unidadMedida,producto.stock,
                            producto.saldo ,producto.precioBase, estadoproducto.estado,producto.fechaRegistro,
                            producto.fechaActualizacion,producto.idUsuario,producto.descripcion_complete
                            from producto
                            inner join estadoproducto on producto.estado=estadoproducto.idestadoProducto  order by 1';
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($datos = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $datos['id'] ?></td>
                                <td><img src="/img/<?= $datos['img'] ?>" alt="img" class="img-thumbnail" width="60"></td>
                                <td><?= $datos['descripcion'] ?></td>
                                <td><?= $datos['descripcion_complete']?></td>
                                <td><?= $datos['unidadMedida'] ?></td>
                                <td><?= $datos['stock']?></td>
                                <td><?= $datos['saldo'] ?></td>
                                <td><?= $datos['precioBase'] ?></td>
                                <td><?= $datos['estado'] ?></td>
                                <td><?= $datos['fechaRegistro'] ?></td>
                                <td><?= $datos['fechaActualizacion'] ?></td>
                                <td class="text-center">
                                    <a href="/php/pantallas/modifyProduct.php?id=<?=$datos['id']?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="/php/pantallas/user.php?id=<?=$datos['id']?>&&img=<?=$datos['img']?>&&page=user" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>0 resultados</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer class="text-center py-3">
        <button class="btn btn-info">Acerca de</button>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="/js/verifysesionstorage.js"></script>
    <script src="/js/user.js"> </script>
    
</body>
</html>
