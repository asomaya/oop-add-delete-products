<?php 
header("Access-Control-Allow-Origin: *"); 
   abstract class Main{
   abstract  public function __construct();
   abstract  public function fetch();
   abstract public function delete($ii);
   abstract public function insert( );
   }
 Class Model extends Main{
 
        private $server = "localhost";
        private  $username = "root";
        private  $password;
        private $db = "product";
       protected $conn;
       public function __construct()
        {
            try {
                $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

       
        public function fetch(){
            $data = null;
 
            $stmt = $this->conn->prepare  ("SELECT product_data.sku, product_data.Name, product_data.price,product_data.id,dvd.DS,furniture.fh,furniture.fw,furniture.fl,book.BW FROM `product_data`LEFT JOIN `furniture`ON product_data.SKU=furniture.SKU
            LEFT JOIN `dvd`ON product_data.SKU=dvd.SKU
            LEFT JOIN `book`ON product_data.SKU =book.SKU
            ORDER BY product_data.SKU");
           if ($stmt->execute()) {
            $data = $stmt->fetchAll();
        }
            return $data;
        }
        public function delete($ii){
            
            $stmt = $this->conn->prepare ("DELETE FROM product_data where id = '$ii'");
            if ($stmt->execute()) {
                return true;
            } else {
                return;
            }
        }


        public   function setSku($sku){
            $this->sku = $sku;
        }
    
        public function getSku(){
            return $this->sku;
        }
    
        public   function setName($name){
            $this->name = $name;
        }
    
        public  function getName(){
            return $this->name;
        }
    
        public  function setPrice($price){
            $this->price = $price;
        }
    
        public  function getPrice(){
            return $this->price;
        }
        public  function setSize($size){
            $this->size = $size;
        }
        public  function getSize(){
            return $this->size;
        }
    

        public function insert( ){
           
            $stmt = $this->conn->prepare ("insert into product_data (sku, name , price) VALUES ('". $this->getSku() . "','" . $this->getName(). "','" . $this->getPrice(). "') ");
            if ($stmt->execute()) {
               return true;
            } else {
                return;
            }
        }
       
       

        }

        abstract class pType extends Model{
           abstract public function in( );
        }

        class D extends pType{
            public $sku ;
            public $size;
            public   function setSku($sku){
                $this->sku = $sku;
            }
        
            public function getSku(){
                return $this->sku;
            }
        
          
            public  function setSize($size){
                $this->size = $size;
            }
            public  function getSize(){
                return $this->size;
            }
            public function in( ){
             
                $stmt = $this->conn->prepare ("insert into dvd (sku , DS) VALUES ('". $this->getSku() . "','" . $this->getSize(). "') ");
               
                if ($stmt->execute()) {
                    return true;
                } else {
                    return;
                }    
               }}
               class B extends pType{
              
                public   function setSku($sku){
                    $this->sku = $sku;
                }
            
                public function getSku(){
                    return $this->sku;
                }
            
              
                public  function setWeight($weight){
                    $this->weight = $weight;
                }
                public  function getWeight(){
                    return $this->weight;
                }
                public function in( ){
                 
                    $stmt = $this->conn->prepare ("insert into book (sku , BW) VALUES ('". $this->getSku() . "','" . $this->getWeight(). "') ");
                   
                    if ($stmt->execute()) {
                        return true;
                    } else {
                        return;
                    }    
                   }}
                   class F extends pType{
                  
                     public   function setSku($sku){
                         $this->sku = $sku;
                     }
                 
                     public function getSku(){
                         return $this->sku;
                     }
                 
                     public  function setHeight($height){
                         $this->height = $height;
                     }
                     public  function getHeight(){
                         return $this->height;
                     }
                     public  function setWidth($width){
                        $this->width = $width;
                    }
                    public  function getWidth(){
                        return $this->width;
                    }
                    public  function setLength($length){
                        $this->length = $length;
                    }
                    public  function getLength(){
                        return $this->length;
                    }
                     public function in( ){
                      
                         $stmt = $this->conn->prepare ("insert into furniture (sku , fh ,fw ,fl) VALUES ('". $this->getSku() . "','" . $this->getHeight(). "','" . $this->getWidth(). "','" . $this->getLength(). "') ");
                        
                         if ($stmt->execute()) {
                             return true;
                         } else {
                             return;
                         }    
                        }}

              
              
       

    ?>
