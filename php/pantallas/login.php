<!DOCTYPE HTML>
<html lang="en" >
<html>
<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>  
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'> 
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/4a47433372.js" crossorigin="anonymous"></script>
</head>

  <?php require_once '../layouts/loaderEspiral.php'; ?>

<body class="body hidden">
	
	
<div class="login-page">
  <div class="form">
  <a href="/index.php" title="inicio"><i class="fa-solid fa-house"></i></a>
    <form>
      <lottie-player src="https://assets4.lottiefiles.com/datafiles/XRVoUu3IX4sGWtiC3MPpFnJvZNq7lVWDCa8LSqgS/profile.json"  background="transparent"  speed="1"  style="justify-content: center;" loop  autoplay></lottie-player>
      <input type="text" id="user" placeholder="&#xf007;  username"/>
      <input type="password" id="password" placeholder="&#xf023;  password"/>
            <div class="rememberme">
                <input type="checkbox" id="rememberMe">
                <label for="rememberMe">Recuérdame</label>
            </div>
      <i class="fas fa-eye" onclick="show()"></i> 
      <br>
      <br>
      <button type="button" onclick="iniciarSecion()">LOGIN</button>
      <p class="message"> aun no tienes cuenta?</p>
    </form>

    <form class="login-form">
      <button type="button" onclick="window.location.href='/php/pantallas/register.php'">SIGN UP</button>
    </form>
  </div>
</div>



  <script>
    function show(){
      var password = document.getElementById("password");
      var icon = document.querySelector(".fas")
      if(password.type === "password"){
        password.type = "text";
      }
      else {
        password.type = "password";
      }
    };
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/js/login.js"></script>
  
</body>
</html>