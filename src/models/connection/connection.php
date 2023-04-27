<?php

namespace App\models\connection;

use App\exceptions\connection\PdoException ;
use Medoo\Medoo;

abstract class connection implements I_connection{


     protected $connection;
     protected static $table;
     
     public function __construct(){

          try {
               global $dbh;
               $this->connection = $dbh ;
             } catch(PDOException $e) {
               throw new PdoException();
               die();
             }
     }

     public function create($values){
         
         return  $this->connection->insert( static::$table , $values ); 
     }

     public function read($columns, $where=[]){
          return $this->connection->select( static::$table , $columns , $where); 
     }

     public function update($data, $where){

          return $this->connection->update(static::$table,$data,$where);  
     }
     public function last_query(){

          return $this->connection->last();  
     }
     public function log_info(){

          return $this->connection->log();  
     }

     public function delete($where){

          return $this->connection->delete(static::$table,$where); 
     }

     public function findBy($data){ //medoo get 

          return $this->connection->delete(static::$table,$data); 

     }

     public function count($where){

          return $this->connection->count(static::$table,$where); 

     }

     public function sum($column, $where){

          return $this->connection->sum(static::$table,$column, $where); 

     }

     public function action($callback){

          return $this->connection->action(static::$table,$callback); 

     }

     public function query($sql){
          
          return $this->connection->query($sql); 

     }
}

?>