<?php
header("Access-Control-Allow-Origin: *"); //add this CORS header to enable any domain to send HTTP requests to these endpoints:
$host = "localhost"; 
$user = "root"; 
$password = ""; 
$dbname = "product"; 
$id = '';
 
$con = mysqli_connect($host, $user, $password,$dbname);
 
$method = $_SERVER['REQUEST_METHOD'];
 
 
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
 
 
switch ($method) {
    case 'GET':
     //$sql = "select * from product_data"; 
     $sql="SELECT product_data.sku, product_data.Name, product_data.price,product_data.id,dvd.DS,furniture.fh,furniture.fw,furniture.fl,book.BW FROM `product_data`LEFT JOIN `furniture`ON product_data.SKU=furniture.SKU
     LEFT JOIN `dvd`ON product_data.SKU=dvd.SKU
     LEFT JOIN `book`ON product_data.SKU =book.SKU
     ORDER BY product_data.SKU";
      break;
      case 'POST':
       
       $id=$_POST['id'];
       foreach($id as $ii){
      //cascade delete
       $sql = "DELETE FROM product_data WHERE id = $ii";
       $data=mysqli_query($con,$sql);}
          
      break;
   
      }





    // run SQL statement
$result = mysqli_query($con,$sql);

// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error($con));
}
 
if ($method == 'GET') {
    if (!$id) echo '[';
    for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
      echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    if (!$id) echo ']';
  } elseif ($method == 'POST') {
    echo json_encode($result);
  } else {
    echo mysqli_affected_rows($con);
  }
 
$con->close();