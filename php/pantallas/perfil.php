<?php
require_once '../controladores/config.php';
$conn=conectarDB();

$idUserGet=$_GET['user'];


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/css/user.css">
    <script src="https://kit.fontawesome.com/4a47433372.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/css/perfil.css">


</head>
  
<?php require_once '../layouts/loaderEspiral.php'; ?>

<body class="hidden">

<header class="text-center py-3">
        <h1 class="text-center text-secondary font-weight-bold ">Sección Personal</h1>
    </header>
    <nav class="text-center my-3">
         <button class="btn btn-primary mx-2" onclick="Back()" title="regresar" ><i class="fa-solid fa-arrow-left"></i></button>
         <button class="btn btn-primary mx-2" title="inicio" onclick="window.location='/index.php'"><i class="fa-solid fa-house"></i></button>
        <buttom class="btn btn-primary mx-2 " ></buttom>
        <buttom class="btn btn-primary mx-2 " ></buttom>
        <button class="btn btn-danger mx-2" title="cerrar sesion" onclick="cerrarSesion()">Cerrar Sesión</button>
        
    </nav>
    <tbody>
    <?php
    
    $sql="select usuario.nombre, usuario.usuario, usuario.correo, rol.Rol,usuario.descripcion,usuario.telefono,
            usuario.fecha_nacimiento, municipio.municipio, departamento.departamento
            from rol 
            inner join usuario on usuario.idRol=rol.idRol
            inner join municipio on municipio.idMunicipio=usuario.idMunicipio
            inner join departamento on departamento.idDepartamento=municipio.idDepartamento

            where usuario.idUsuario='$idUserGet'";
            
    
    $result=$conn->query($sql);
    
    if($result->num_rows>0){
    
    while($usuario=$result->fetch_assoc()){
    
    ?>
    
    <main role="main" class="container">
      <div class="mt-5"></div>
      <div class="row">
        <div class="col-sm-6">
          <div class="row">
            <div class="col-md-4">
              <img
                src="/img/default.png"
                alt="..."
                class="rounded-circle profile-image"
              />
            </div>
            <div class="col-md-8 top-col">
              <h1 class=""><?=$usuario['usuario']?></h1>
              <p class="lead">nombre: <?=$usuario['nombre']?></p>
              <p class="lead">Rol : <?=$usuario['Rol']?></p>
              <p>
                <a><span class="badge badge-primary">Skill 1</span></a>
                <a><span class="badge badge-primary">Skill 2</span></a>
                <a><span class="badge badge-primary">Skill 3</span></a>
                <a><span class="badge badge-primary">Skill 4</span></a>
                <a><span class="badge badge-primary">Skill 5</span></a>
              </p>

              <ul class="social-icons">
                  <li class="linkedin">
                    <a href="https://www.linkedin.com/in/"><i class="fa fa-fw fa-linkedin"></i></a>
                  </li>
                  <li class="github">
                      <a href="https://github.com/"><i class="fa fa-fw fa-github"></i></a>
                    </li>
                  <li class="medium">
                    <a href="https://medium.com/_"><i class="fa fa-fw fa-medium"></i></a>
                  </li>
                  <li class="mail">
                      <a href="mailto:name@email.com"><i class="fa fa-fw fa-envelope"></i></a>
                    </li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      <hr class="divider" />
      <h5>Descripcion personal</h5>
      <p class="personal-statement">
        <?=$usuario['descripcion']?>
      </p>
      <hr class="divider" />
      <h5>Datos ubicacion y contacto</h5>
      <p>
        datos generales de ubicacion y contacto del usuario
      </p>
      <strong><p>Datos:</p></strong>
      <div class="row">
        <div class="col-sm-6">
          <ul>
            <li><?=$usuario['correo']?></li>
            <li><?=$usuario['telefono']?></li>
            <li>municipio : <?=$usuario['municipio']?></li>
          </ul>
        </div>
        <div class="col-sm-6">
          <ul>
            <li>departamento : <?=$usuario['departamento']?> </li>
            <li>Module 5</li>
            <li>Module 6</li>
          </ul>
        </div>
      </div>
      <hr class="divider" />
      <h5>Work Experience</h5>
      <p>Company · Role · Start Date - End Date</p>
      <p class="description-text">
       A few lines about what you did during that job, what you learned and achieved.
      </p>
      <hr class="divider" />
      <h5>Personal Projects</h5>
      <strong><p>Project 1</p></strong>
      <p class="description-text">
        Include a description about your project, mentioning any specific technologies that you used.
      </p>
    
    </main>
    
    
    
    <?php
    
    }
    
    }
    
    ?>
            <!-- Begin page content -->

    </tbody>

<script src="/js/perfil.js"></script>
<script src="/js/verifysesionstorage.js"></script>
</body>

</html>