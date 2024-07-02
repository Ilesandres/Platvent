
<?php 

    require_once '../layouts/headerAdmin.php';
?>
<div class="container-fluid">
        <div class="row">

         
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card" style="width: 50%;">
                    <img src="/icons/support.jpg" class="card-img-top" alt="usuarios">
                    <div class="card-body">
                    <h1>Usuarios</h1>
                        <p class="card-text">aquí podras editar, eliminar y modificar usuarios, segun como se desee</p>
                    </div>
                    <div class="card-footer">
                        <button onclick="window.location.href='./UsuariosAdmin.php'" class="btn btn-success">Usuarios</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card" style="width: 50%;">
                    <img src="/icons/page-demo.png" class="card-img-top" alt="Paginas">
                    <div class="card-body">
                    <h1>Paginas</h1>
                        <p class="card-text">desde esta seccion podras editar las paginas habilitadas a los empleados de las diferentes oficinas</p>
                    </div>
                    <div class="card-footer">
                        <button onclick="window.location.href='./paginasAdmin.php'" class="btn btn-success">Paginas</button>
                    </div>
                </div>
            </div>
   
        <div class="col-md-6 col-lg-4 mb-4">
                <div class="card" style="width: 50%;">
                    <img src="/icons/oficinas-mundo.jpg" class="card-img-top" alt="oficinas">
                    <div class="card-body">
                    <h1>Oficinas</h1>
                        <p class="card-text">desde esta seccion podras editar, crear y eliminar oficinas, en este apartado se recomienda mucho cuidado</p>
                    </div>
                    <div class="card-footer">
                        <button onclick="window.location.href='./oficinasAdmin.php'" class="btn btn-success">Oficinas</button>
                    </div>
                </div>
               </div> 
                
                <div class="col-md-6 col-lg-4 mb-4">
                <div class="card" style="width: 50%;">
                    <img src="/icons/informes-chicoAnime.jpg" class="card-img-top" alt="informes">
                    <div class="card-body">
                    <h1>informes</h1>
                        <p class="card-text">Desde esta paginas podras visualizar informes generales de las oficinas y de la tienda en general</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success">informes</button>
                    </div>
                </div>     
        
                </div>
            
            
        </div>
        

    </div>
    <footer class="text-center mt-4">
        <h1>Footer</h1>
    </footer>
    
    <script src="/js/admin.js"></script>
</body>
</html>