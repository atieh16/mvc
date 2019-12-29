<?php

 class Database{

   private $host = 'localhost';
   private $userName = 'atieh';
   private $password = '@13751375@';
   private $dbName = 'mysite';
   private $databasType = 'mysql';
   public $connection;//$connection ra public kardim chon mikhahim dar class Model be on dastrasi dashte bashim
   private $stmt;

   public function __construct()
   {
       $this->connectDb();
     
   }
   
   public function connectDb()
   {
   	 

   	  $dsn = $this->databasType . ":host=" . $this->host . ";dbname=" .$this->dbName . ";charset=utf8";
   	  $this->connection = new PDO($dsn , $this->userName , $this->password);
   	  $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
   	  $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES , false);

   }

   public function query($query){

   	 $this->stmt = $this->connection->prepare($query);     
   }

   public function execute($data = [])
   {   

       return $this->stmt->execute($data);
   }

 
    
   public function fetch($query , $data = [] , $single = false)
   {
   	  $this->query($query);
      $this->execute($data);
      if(!$single)
            return $this->stmt->fetchAll();

   	  return $this->stmt->fetch();
   }

  


   public function insertQueryBuilder($table,$data){
     
        $query = "INSERT INTO `" .$table . "` ( `" . implode('`,`' , array_keys($data)) . '`)' . "VALUES ( :" .
        implode(', :' , array_keys($data)) . ")";
        return $query;  
   }




   public function updateQueryBuilder($table , $data , $condition){
       
        $query = "UPDATE `" . $table . "` SET " ;

        foreach ($data as $key => $value) {
          if($key != 'id'){
             $query .= "".$key ." = " . ":" . $key ." ,";
           }
        }

        $query = rtrim($query , ',');
        $query .="WHERE " . $condition;
        return $query;
   }

   public function rowcount()
   {
      
      return $this->stmt->rowCount();
   }

  

  
 }