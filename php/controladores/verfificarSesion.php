<?php 


    
try{
session_start();
    $user=$_SESSION['usuario'];
        $idUser=$_SESSION['user_id'];
        
    if($user && $idUser){
            $response=array(
                'status' => 'success',
                'message' => 'Bienvenido '.$user,
                'user' => $user,
                'idUser' => $idUser
            );
            echo json_encode($response);
    }

}catch(Exception $e){

    $response=array(
                'status' => 'error',
                'message' => 'No estas logueado'
                );
                echo json_encode($response);
}

   
   
   
