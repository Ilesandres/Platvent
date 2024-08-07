<?php

require_once '../controladores/isActiva.php';

$name='admin';

session_start();
$Rol=$_SESSION['Rol'];
if($Rol!=='Admin'){
  

  $isActiva=isActiva($name);

}

  require_once '../controladores/config.php';

  $conn = conectarDB();


    require_once '../controladores/verifySession.php';
    
    if($_SESSION['Rol']!='Admin'){
        header('Location: ../../../../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    <link rel="stylesheet" href="/css/user.css">
    <script src="https://kit.fontawesome.com/4a47433372.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="/icons/favicon/admin.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/admin.css">
    <script src="/alerts/alert_SwalsuccesProduct.js"></script>
    <script src="/js/verifysesionstorage.js"></script>
</head>
<body>
    <header>
        <h1 class="text-center m-4 fs-1">Admin</h1>
    </header>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light f-1">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Opciones</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" id="home" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./user.php">Productos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            opciones
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="./perfil.php?user=<?=$_SESSION['user_id']?>">Perfil</a></li>
            <li><a class="dropdown-item" href="./vender.php">Ventas</a></li>
            <li><a class="dropdown-item" href="#">Alerta</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Selecciona</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
    </div>
    </nav>
    <div id="contentExtra" class="navbar navbar-expand-lg navbar-light bg-light f-1" style="display:none;"></div>
