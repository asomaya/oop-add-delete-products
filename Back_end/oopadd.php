<?php 
header("Access-Control-Allow-Origin: *");
    include 'main.php';
 
            
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method) {
        case 'POST':
           
           
    
          $InsertData =new Model();
          $Dv= new D();
          $Bo= new B();
          $Fu= new F();
          $InsertData->setSku($_POST['sku']);
          $InsertData->setName($_POST['name']);
          $InsertData->setPrice($_POST['price']);
          $InsertData->setSize($_POST['size']);
         
          $InsertData->insert();
          $Dv->setSku($_POST['sku']);
          $Dv->setSize($_POST['size']);
          $Bo->setSku($_POST['sku']);
          $Bo->setWeight ($_POST["weight"]);
          $Fu->setSku($_POST['sku']);
          $Fu->setHeight ( $_POST["height"]);
          $Fu->setWidth ($_POST["width"]);
          $Fu->setLength ($_POST["length"]);
         
        
         $G=['D'=>$Dv,'B'=>$Bo ,'F'=>$Fu];
         $G[$_POST["type"]]->in();
      
       
      
        
         
      
            
           
      break;}

             
             
            
           //  echo json_encode($data);
             
             ?>