<?php 
    
    session_start();
    session_unset();
    session_destroy();
    
    $response=array(
        'status' => 'success',
        'message' => 'You have successfully logged out'
        );
        
    echo json_encode($response);