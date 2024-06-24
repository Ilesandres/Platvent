<?php
  require_once '../controladores/config.php';

  $conn = conectarDB();
  $valorGet=$_GET['search'];

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
 

</head>
<body>
    <header class="text-center py-3">
        <h1 class="text-center text-secondary font-weight-bold ">Sección Personal</h1>
    </header>
    <nav class="text-center my-3">
        <button class="btn btn-primary mx-2" title="inicio" onclick="window.location='/index.php'"><i class="fa-solid fa-house"></i></button>
        <a class="btn btn-primary" data-bs-toggle="modal" title="buscar" href="#exampleModalToggle" role="button"><i class="fa-solid fa-magnifying-glass"></i></a>
        <button class="btn btn-primary mx-2" title="seccion productos" onclick="window.location.href='/php/pantallas/user.php'"><i class="fa-solid fa-house-flag"></i></button>
        <button class="btn btn-danger mx-2" title="cerrar sesion" onclick="cerrarSesion()">Cerrar Sesión</button>
        
        
                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Buscar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                Show a second modal and hide this one with the button below.
            </div>
            <div class="modal-footer">
                  
            </div>
            </div>
        </div>
        </div>
       
                
        
        
        
        
    </nav>
    <div class="container-fluid row m-auto">
        <div class="col-8 p-4 m-auto ">
        <?php
            require_once '../controladores/eliminarProducto.php'
        ?>
            <table class="table table-striped table-hover table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Descripción</th>
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
                  

                    $sql = " select producto.id, producto.img ,producto.descripcion,producto.unidadMedida,producto.stock,
                            producto.saldo ,producto.precioBase, estadoproducto.estado,producto.fechaRegistro,
                            producto.fechaActualizacion,producto.idUsuario
                            from producto
                            inner join estadoproducto on producto.estado=estadoproducto.idestadoProducto  where producto.descripcion like '%$valorGet%'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($datos = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $datos['id'] ?></td>
                                <td><img src="/img/<?= $datos['img'] ?>" alt="img" class="img-thumbnail" width="60"></td>
                                <td><?= $datos['descripcion'] ?></td>
                                <td><?= $datos['unidadMedida'] ?></td>
                                <td><?= $datos['stock']?></td>
                                <td><?= $datos['saldo'] ?></td>
                                <td><?= $datos['precioBase'] ?></td>
                                <td><?= $datos['estado'] ?></td>
                                <td><?= $datos['fechaRegistro'] ?></td>
                                <td><?= $datos['fechaActualizacion'] ?></td>
                                <td class="text-center">
                                    <a href="/php/pantallas/modifyProduct.php?id=<?=$datos['id']?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="/php/pantallas/user.php?id=<?=$datos['id']?>&&img=<?=$datos['img']?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
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
    <script src="/alerts/alert_SwalsuccesProduct.js"></script>
</body>
</html>
