<?php

namespace App\models\connection;

use App\exceptions\connection\PdoException ;
use I_connection;
use Medoo\Medoo;

abstract class  connection implements I_connection{


     protected $connection;
     
     public function __construct($medoo){
          try {
               global $dbh;
               $this->connection = $medoo ;
             } catch(PDOException $e) {
               throw new PdoException();
               die();
             }
     }

     public function create($values){
        return $this->connection->insert(static::class,$values); 
     }

     public function read($columns, $where, $join){
          return $this->connection->select(static::class,$columns,$where,$join); 
     }
     public function update($data, $where){
          return $this->connection->update(static::class,$data,$where);  
     }
     public function delete($where){
          return $this->connection->delete(static::class,$where); 
     }
     public function findBy($data){ //medoo get 
          return $this->connection->delete(static::class,$data); 

     }
     public function count($where){
          return $this->connection->count(static::class,$where); 

     }
     public function sum($column, $where){
          return $this->connection->sum(static::class,$column, $where); 

     }
     public function action($callback){
          return $this->connection->action(static::class,$callback); 

     }
     public function query($sql){
          return $this->connection->query($sql); 

     }
}

?>