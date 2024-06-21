<?php
            
            require_once '/platvent_2/php/controladores/config.php';
            $conexion=conectarDB();      
        
        ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    <link rel="stylesheet" href="/css/user.css">
    <script src="https://kit.fontawesome.com/4a47433372.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/alerts/alert_SwalsuccesProduct.js"></script>
    <link rel="stylesheet" href="/css/vender.css">
    
</head>
<body>
<header class="text-center py-3">
        <h1 class="text-center text-secondary font-weight-bold ">Ventas</h1>
    </header>
    <nav class="text-center my-3">
        <button class="btn btn-primary mx-2" title="inicio" onclick="window.location='/index.php'"><i class="fa-solid fa-house"></i></button>
        <a class="btn btn-primary" data-bs-toggle="modal" title="buscar" href="#exampleModalToggle" role="button"><i class="fa-solid fa-magnifying-glass"></i></a>
        <buttom class="btn btn-primary mx-2 " title="perfil" onclick="perfil()"><i class="fa-solid fa-house-user"></i></buttom>
        <button class="btn btn-primary mx-2" title="seccion productos" onclick="window.location.href='/php/pantallas/user.php'"><i class="fa-solid fa-house-flag"></i></button>
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
            </div>
            <div class="modal-footer">
            
              </div>
            </div>
        </div>
        </div>

        
        
    </nav>
    
    <tbody>
    <div class="container-fluid row">
       
        <form method="POST" class="col-5 p-3 border rounded shadow-sm container-fluid row">
        
        <div class="col-5">
            <legend class="text-center">Compra</legend>
                <p>las facturas se agregan y editan automaticamente si tienes datos en ella, procura dar click en factura nueva para limpiar todos los valores</p>
            
                <div class="mb-3">
                    <label for="idFactura" class="form-label">id Factura </label>
                    <input type="text" name="idFactura" id="idfactura" class="form-control" readonly>  
                </div>
                <div class="mb-3">
                    <label for="idvendedor" class="form-label">id Vendedor </label>
                    <input type="text" name="idvendedor" id="idvendedor" class="form-control" readonly>  
                </div>
                <div class="mb-3">
                <label for="estadofactura" class="form-label">estado de la factura</label>
                <select class="form-select" name="estadofactura" id="estadofactura">
                <option value="null">estado factura</option>
                
                <?php 
                
                require_once '/platvent_2/php/controladores/config.php';
                $conn=conectarDB();
                    
                    $estadoF='select * from estadoventa';
                    $estadofactura=$conn->query($estadoF);
                    if($estadofactura->num_rows>0){
                      
                        while($datos= $estadofactura->fetch_assoc()){
                            if($datos['estado_venta']=='en proceso'){
                            ?>
                             <option value="<?=$datos['id']?>" selected><?=$datos['estado_venta']?></option>
                            
                            <?php
                            
                            }else{
                        ?>
                        
                        
                        <option value="<?=$datos['id']?>"><?=$datos['estado_venta']?></option>
                        
                        
                        
                        <?php
                            }
                        
                        }
                        
                        }
    
                    
                
                ?>
                
                    
                    
                </select>
                
                </div>
                
                <div class="mb-3">
                    <label for="IDcliente" class="form-label">ID Cliente</label>
                    <input type="number" id="IDcliente" name="IDcliente" class="form-control"
                        placeholder=" ID cliente" >
                        <table class="table table-striped">
                        <ul id="list" > </ul>
                        </table>
                        
                </div>
                <div class="mb-3">
                    <label for="nombrecliente" class="form-label"> Nombre</label>
                    <input type="text" id="nombrecliente" name="nombrecliente" class="form-control"
                        placeholder=" nombre cliente" readonly>
                        <br>
                        <label for="total" class="form-label"> total</label>
                    <input type="int" id="total" name="total" class="form-control"
                        placeholder=" total" value="0" step="any" readonly>
                </div>
                
                
                <div class="mb-3">
                <button type="button" onclick="limpiarFactura()" class="btn btn-success">nueva factura</button>
                 
                </div>
                

                
        </div>
        <div class="col-4  container container-fluid ">
        
             <legend class="text-center"> acciones</legend>
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                <div class="col m-4 p-2">
                <button class="btn btn-primary  m-1 ">ver facturas</button>
                </div>
                <div class="col m-4 p-2">
                <button class="btn btn-primary  m-1 ">eliminar facturas</button>
                </div>
                <div class="col m-4 p-2">
                    <a class="btn btn-primary" data-bs-toggle="modal" title="agregar cliente" href="#AgregarCliente" role="button"><i class="fa-regular fa-address-card"></i></a>

                
                </div>
                <div class="col m-4 p-2">
                     <button class="btn btn-primary">agregar Cliente</button>
                </div>
                <div class="col m-4 p-2">
                                 <button class="btn btn-primary" onclick="window.location.href='#AgregarCliente'">acciones</button>

                </div>
                
               
            </div>

           
        </div>
        <legend class="text-center">Productos añadidos</legend>
                
                <div class="scroll-bg">
                    <div class="scroll-div">
                        <div class="scroll-object">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="bg-primary text-white">
                            <tr>
                            <th scope="col">Imagen</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Unidad de Medida</th>
                            <th scope="col">cantidad</th>
                            <th scope="col">Precio Base</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                            <th scope="col">quitar</th>
                            </tr>
                                 
                            </thead>
                            <tbody id="table-productos-añadidos" >
                            
                                
                            </tbody>
                         </table>
                        
        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non quidem illo modi enim rerum maxime sequi eaque consectetur quo ipsum officia soluta culpa adipisci asperiores ullam ipsam ratione totam, molestiae nam minima expedita doloribus temporibus itaque quam? Suscipit pariatur a delectus ipsa, totam doloremque, voluptas nostrum excepturi odit ipsum modi repellat deserunt dolorum. Ad blanditiis excepturi voluptatum minus eos! Fugit, illo! Mollitia id temporibus beatae neque iusto incidunt corrupti officia tenetur labore consequatur dolor, asperiores accusamus, rem quas et, vel voluptate error ad unde nobis tempore vero esse! Deleniti ex illo praesentium rem itaque consectetur placeat blanditiis magnam veritatis perferendis impedit ea quis nulla ut voluptate laboriosam, nihil maiores animi a. Nesciunt eaque dignissimos, fuga excepturi ipsam itaque dolore in? Necessitatibus recusandae qui sed tempora quae illum ut assumenda deleniti, earum nostrum atque nemo? At voluptate assumenda, odio perferendis, nihil eligendi ducimus iure incidunt delectus, sit id quas sapiente! Laboriosam aspernatur eius maiores quasi necessitatibus quisquam quidem voluptate perspiciatis deleniti quod ipsa dolores hic unde repellendus, dignissimos in blanditiis tempora doloremque. Cum accusamus enim sapiente, animi eveniet pariatur molestias exercitationem voluptatibus amet ratione nihil eius a repudiandae odio aut unde cupiditate fuga quia! Veniam ipsam placeat delectus tempora, inventore quasi esse asperiores magni unde, dolores voluptatibus mollitia nobis, ullam animi temporibus? Laudantium odio incidunt ut necessitatibus aperiam molestiae quisquam ratione consectetur voluptates similique ipsam ab tempore, corporis vitae omnis deserunt! Temporibus voluptates rerum, animi obcaecati natus sunt consequatur ut consequuntur sint quae nulla perferendis, delectus error consectetur. Fuga, fugit non.
                        
                        </div>
                    </div>
                
                </div>
        
           
        </form>        
             <div class="col-7">
        <div class="scroll-products">
            <div class="products-scroll">
                <div class="products-object">
             
        <legend class="text-center">Productos disponibles</legend>
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
                        <th scope="col">Acciones</th>
                        <th scope="col">añadir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  

                    $sql = ' select producto.id, producto.img ,producto.descripcion,producto.unidadMedida,producto.stock,
                            producto.saldo ,producto.precioBase, estadoproducto.estado,producto.fechaRegistro,
                            producto.fechaActualizacion,producto.idUsuario,producto.descripcion_complete
                            from producto
                            inner join estadoproducto on producto.estado=estadoproducto.idestadoProducto  order by 1';
                    $result = $conexion->query($sql);

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
                                <td class="text-center">
                                    <a href="/php/pantallas/modifyProduct.php?id=<?=$datos['id']?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="/php/pantallas/user.php?id=<?=$datos['id']?>&&img=<?=$datos['img']?>&&page=user" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                                <td class="text-center">
                                    <button onclick="Modal(<?=$datos['id']?>)" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></button>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>0 resultados</td></tr>";
                    }

                    $conexion->close();
                    ?>
                </tbody>
            </table>
        
        </div>
                </div>
            </div>
        </div>
        
    
    </div>
    
    
    </tbody>

    <footer>
    
    </footer>
    <div class="modal fade" id="AgregarCliente" aria-hidden="true" aria-labelledby="AgregarClienteLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AgregarClienteLabel">agregar cliente</h5>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
            <div class="form">
            
            <form  method="POST" class="p-3 border rounded shadow-sm">
          
                
                
                 <div class="mb-3">
                    <label for="nombrecliente" class="form-label">Nombre</label>
                    <input type="text" id="nombrecliente" name="nombrecliente" class="form-control"
                        placeholder="nombre">
                </div>
                 <div class="mb-3">
                    <label for="apellido" class="form-label">apellido</label>
                    <input type="text" id="apellido" name="apellido" class="form-control"
                        placeholder="apellido">
                </div>
                <div class="mb-3">
                    <label for="identificacion" class="form-label">Identificacion</label>
                    <input type="number" id="identificacion" name="identificacion" class="form-control"
                        placeholder="identificacion">
                </div>
             
                <button type="button" value="ok" class="btn btn-success" onclick="registrarCliente()"  name="btnagregarcliente" >agregar</button>
               
            </form>
                
            
            </div>
                escribe los datos del nuevo cliente
               
            </div>
            <div class="modal-footer">
            
              </div>
              
              
              
              
            </div>
        </div>
        </div>
        
        
       

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/js/verifysesionstorage.js"></script>
<script src="/js/vender.js"> </script>
</body>
</html>