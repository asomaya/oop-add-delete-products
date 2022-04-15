<?php 
 header("Access-Control-Allow-Origin: *");
    include 'main.php';
 
   
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method) {
        case 'GET':
          
            $model = new Model();
            $rows = $model->fetch();
            $data = array('rows' => $rows);
         
            echo json_encode($data);
          
          break;
         
          case 'POST':
       
            $id=$_POST['id'];
            foreach($id as $ii){
           
       $model = new Model();
        
       $delete=$model->delete($ii);
    }
 
           
                
           
              
              
              
              
             
            //  echo json_encode($data);
              
              break;
         
       
          }
    ?>