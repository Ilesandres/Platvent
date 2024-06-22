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
    <nav class="text-center my-3 no-print">
        <button class="btn btn-primary mx-2" title="inicio" onclick="window.location='/index.php'"><i class="fa-solid fa-house"></i></button>
        <buttom class="btn btn-primary mx-2 " title="perfil" onclick="perfil()"><i class="fa-solid fa-house-user"></i></buttom>
        <button class="btn btn-primary mx-2" title="seccion productos" onclick="window.location.href='/php/pantallas/user.php'"><i class="fa-solid fa-house-flag"></i></button>
        <buttom class="btn btn-primary mx-2 " ></buttom>
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
                    <label for="searchInput" class="form-label">Descripción o Nombre</label>
                    <input type="text" id="searchInput" name="searchInput" class="form-control"
                        placeholder="Descripción o nombre">
                </div>
                <div class="scroll-bg">
                    <div class="scroll-div">
                        <div class="scroll-object">
                        <table class="table table-striped">
                        <ul id="listProducts" > </ul>
                        </table>
                        
                        </div></div></div>
                
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
            <legend class="text-center">Factura</legend>
                <p class="no-print">las facturas se agregan y editan automaticamente si tienes datos en ella, procura dar click en factura nueva para limpiar todos los valores</p>
            
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
                <button type="button" onclick="limpiarFactura()" class="btn btn-success no-print">nueva factura</button>
                 
                </div>
                

                
        </div>
        <div class="container col-12 col-md-8 col-lg-6 mt-4 no-print">
    <legend class="text-center mb-4">Acciones</legend>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
        <div class="col">
        <a class="btn btn-primary custom-btn w-100" data-bs-toggle="modal" title="ver_Facturas" href="#VerFacturas" role="button">
        <i></i>ver facturas </a>
        </div>
        <div class="col">
            <button type="button" class="btn btn-danger custom-btn w-100">Eliminar Facturas</button>
        </div>
        <div class="col">
            <a class="btn btn-primary custom-btn w-100" data-bs-toggle="modal" title="Agregar Cliente" href="#AgregarCliente" role="button">
                <i class="fa-regular fa-address-card"></i> Agregar Cliente
            </a>
        </div>
        
        <div class="col">
            <button class="btn btn-info custom-btn w-100" href="#VerFacturas">Acciones</button>
        </div>
        <div class="col" id="editarFacturaAct">
            
        </div>
        <div class="col" id="imprimirFactura">
        </div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
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
                        
        
                        
                        </div>
                    </div>
                
                </div>
        
           
        </form>        
             <div class="col-7 no-print">
        <div class="scroll-products">
            <div class="products-scroll">
                <div class="products-object">
             
        <legend class="text-center">Productos disponibles</legend>
        <a class="btn btn-light d-flex justify-content-center" data-bs-toggle="modal" title="buscar" href="#exampleModalToggle" role="button"><i class="fa-solid fa-magnifying-glass"></i></a>

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
                    <label for="nameCliente" class="form-label">Nombre</label>
                    <input type="text" id="nameCliente" name="nameCliente" class="form-control"
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
        
        
        <div class="modal fade containerModal" id="VerFacturas" aria-hidden="true" aria-labelledby="verFacturaLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl subcontainerModal">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verFacturaLabel">Ver facturas</h5>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
            <div class="ShowFacturasdiv">
                <div class="Facturs">
                    <div class="Facturas">
                    <table class="table table-striped table-hover table-bordered">
                    
                    <thead class="bg-primary text-white">
                    <tr>
                      <th scope="col">ID</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Total</th>
                    <th scope="col">fecha de compra</th>
                    <th scope="col">editar</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once '/platvent_2/php/controladores/config.php';
                            
                            $conn=conectarDB();
                            $sql="SELECT * FROM venta";
                            $resultFact=$conn->query($sql);
                            if($resultFact->num_rows>0){
                                while($factura=$resultFact->fetch_assoc()){
                                
                                ?>
                                
                                    <tr>
                                        <td><?=$factura['id']?></td>
                                        <td><?=$factura['idCliente']?></td>
                                        <td><?=$factura['total']?></td>
                                        <td><?=$factura['fechaRegistro']?></td>
                                        <td><button  class="btn btn-warning" onclick="verFactura(<?=$factura['id']?>)"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                        
                                    </tr>
                                
                                <?php
                                
                                }
                            }
                        
                        ?>
                        
                        
                    </tbody>
                    
                    
                  
                    </table>
                    
                    </div>
                </div>
            
            
                
            
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