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
      $sql = "select * from product_data"; 
      break;
    case 'POST':
      $sku = $_POST["sku"];
      $name = $_POST["name"];
      $price = $_POST["price"];
      $size = $_POST["size"];
      $weight= $_POST["weight"];
      $height= $_POST["height"];
      $width= $_POST["width"];
      $length= $_POST["length"];
     
      if (!empty($_POST["size"]))   {
          $sql1=" insert into product_data (sku, name , price) VALUES ('$sku', '$name' , '$price')";
          $query  ="  insert into dvd (sku , DS) VALUES ('$sku','$size') ";
          $data1=mysqli_query($con,$sql1);
          $data=mysqli_query($con,$query);
      }else   if (!empty($_POST["weight"]))   {
        $sql1=" insert into product_data (sku, name , price) VALUES ('$sku', '$name' , '$price')";
        $query ="  insert into book (sku , BW) VALUES ('$sku','$weight') ";
        $data1=mysqli_query($con,$sql1);
        $data=mysqli_query($con,$query);
   
     } else   if (!empty($_POST["height"]))   {
       $sql1=" insert into product_data (sku, name , price) VALUES ('$sku', '$name' , '$price')";
        $query ="  insert into furniture (sku , fh ,fw ,fl) VALUES ('$sku','$height','$width', '$length') ";
        $data1=mysqli_query($con,$sql1);
        $data=mysqli_query($con,$query);
    
    }
    
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