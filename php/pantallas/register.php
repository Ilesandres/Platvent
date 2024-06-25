<!DOCTYPE html>
<html lang="en">
  <html>
    <head>
      <title>Sign Up</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="/css/register.css" />
      <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
      <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600" rel="stylesheet"  type="text/css" />
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    </head>
    
    <?php require_once '../layouts/loaderEspiral.php'; ?>
    <body class="body hidden">
     

      <div class="login-page">
        <div class="form">
          <form method="POST"> 
            <lottie-player
              src="https://assets4.lottiefiles.com/datafiles/XRVoUu3IX4sGWtiC3MPpFnJvZNq7lVWDCa8LSqgS/profile.json"
              background="transparent"
              speed="1"
              style="justify-content: center"
              loop
              autoplay
            ></lottie-player>
            <?php
            require_once '../controladores/config.php';
            require_once '../controladores/registerUser.php';

            ?>
            <input type="text" name="nombre" placeholder="nombre" />
            <select name="departamento" id="departamento" >
            <option value="null">departamento</option>
            <?php
            require_once '../controladores/config.php';

            $conn = conectarDB();
            $dep = 'select * from departamento order by 1 ';
            $result = $conn->query($dep);
            $idDepa = null;

            if ($result->num_rows > 0) {
              while ($datos = $result->fetch_assoc()) {


                ?>
                <option value="<?= $datos['idDepartamento'] ?>"><?= $datos['departamento'] ?></option>
            
        
                <?php

              }
            }
            ?>
            </select>
            
            <select name="municipio" id="municipio" disabled >
            
            <option value="null">municipio</option>
            
            </select>
            <input type="text" name="username" placeholder="username" />
            <label for="nacimiento" name="nacimiento" class="nacimiento">fecha de nacimiento</label>
            <input type="date" name="nacimiento" placeholder="fecha de nacimiento">
            <input type="email" name="email" placeholder="email address" />
            <input type="password" name="password" id="password" placeholder="set a password" />
            <i class="fas fa-eye" onclick="show()"></i>
            <br>
            <br>
            <button type="buttom" name="btnregisteruser" value="ok"> Registrar </button>
          </form>

          <form class="login-form">
            
            <button type="button" onclick="window.location.href='/php/pantallas/login.php'">
              iniciar sesion
            </button>
          </form>
        </div>
      </div>
    </body>
    
    <script src="/js/register.js"></script>
  </html>
</html>