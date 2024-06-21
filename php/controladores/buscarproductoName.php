<?php 

require_once '/platvent_2/php/controladores/config.php';

$conn=conectarDB();

if(!empty($_POST['search'])){
    $search=$_POST['search'];
    $sql="SELECT * FROM producto WHERE descripcion LIKE '%$search%' OR descripcion_complete LIKE '%$search%'" ;
    $result=$conn->query($sql);
    if($result){
            if($result->num_rows>0){
                $productsArray= array();
                    while($row=$result->fetch_assoc()){
                        $productsArray[]= $row;
                    }
                    $response=array(
                    'message'=>'succes',
                    'products'=> $productsArray,
                    );
                    echo json_encode($response);
            }else{ 
                 $response=array(
                    'message'=>'no se encontraron productos'
                );
                echo json_encode($response);
            }
    
    
        
        
    }else{
        $response=array(
            'message'=>'error',
            $conn->error,
        );
        echo json_encode($response);
    }
    
}