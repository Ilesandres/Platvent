<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, height=768">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="/css//index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4a47433372.js" crossorigin="anonymous"></script>
</head>
<?php 
    require_once './php/layouts/loaderEspiral.php';
?>

<body class="hidden">
    <div class="Title">
        <h1 class="title p-5">Lista de Productos</h1>
    </div>
    <nav>
        <ul>
            <li><a href="php/pantallas/login.php">login</a></li>
            <li><a href="">acerca de</a></li>
            <li><a href="">contactanos</a></li>
            <li><a href="php/pantallas/carrito.php">carrito</a></li>


            <li class="search"><input name="search" id="search" placeholder="product" type="search" required>
                <span for="search">
                    <button type="button" onclick="buscar()" name="btnsearch" title="buscar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </span>
            </li>


        </ul>
    </nav>

    <div class="colum-3 m-5 products">



        <?php
        require_once 'php/controladores/config.php';

        $conn = conectarDB();

        $sql = ' select producto.id, producto.img ,producto.descripcion,producto.unidadMedida,producto.stock,
                            producto.saldo ,producto.precioBase, estadoproducto.estado,producto.fechaRegistro,
                            producto.fechaActualizacion,producto.idUsuario
                            from producto
                            inner join estadoproducto on producto.estado=estadoproducto.idestadoProducto  order by 1';
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($datos = $result->fetch_assoc()) {
                ?>
        <div class="container">
            <div class="image p-3">
                <img src='/img/<?= $datos["img"] ?>' alt="">
            </div>
            <h2><?= $datos["descripcion"] ?></h2>
            <h4><b> precio: <?= $datos["precioBase"] ?></b></h4>


        </div>



        <?php
            }
        } else {
            echo "<tr><td colspan='10' class='text-center'>0 resultados</td></tr>";
        }

        $conn->close();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/buscarProdcuto.js"></script>


</body>

</html>