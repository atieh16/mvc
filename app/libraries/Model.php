<?php

class Model {

	protected $db;

    
	public function __construct()
	{
		$this->db = new Database;
	}

	public function delete($table , $condition = "" ,$data){
     
       $this->db->query("DELETE FROM `" . $table . "` WHERE " . $condition); 
       return $this->db->execute($data);

	}


     
  public function select($table , $condition = "" , $data = [] , $single = false){
      
   	   $query = "SELECT * FROM `{$table}` ";
   	   if(!empty($condition)){

   	   	  $query .= "WHERE ";
   	   	  $query .= $condition;
   	   }

   	   $result = $this->db->fetch($query , $data , $single);

   	   if($this->db->rowCount() <= 0)
   	   	return false;

   	   return $result;
 }


  public function update($table , $data , $condition = 'id = :id'){
         
           $data = array_filter($data , function($value , $key){
           	  if(!empty($value) OR $value === 0) return true;
           } , ARRAY_FILTER_USE_BOTH );

           $query = $this->db->updateQueryBuilder($table , $data , $condition);
           $this->db->query($query);
           return $this->db->execute($data);      
	}

	
	public function add($table , $data){
     
          $data = array_filter($data , function($value , $key){
          	 if(!empty($value) OR $value === 0) return true;
          } , ARRAY_FILTER_USE_BOTH );
       

          $query = $this->db->insertQueryBuilder($table, $data);
          $this->db->query($query);
          return $this->db->execute($data);

	}

   // ma lastId() ra dar Model avardim chon dar model ma az class Databse ers bari nakardim va faghat dar construct Model yek obj az class database sakhtim va ba on obj be method haye class database dastrasi darim  nmitavanestim be lastId() dar class database dastrasi dashte bashim va moshkel ijad mishod pas ma lastId() ra dar model() be insorat tarif kardim
   // noket:lastId() hatman bayad az $connection gerefte shavad 
   // $connection ra dar class database public kardim
   //agar Model az Database ers bari mikard(extends) mitavanestim lastId() ra dar database tarif karde va az on estefade konim
    public function lastId()
   {
       return $this->db->connection->lastInsertId();
   }







	
}