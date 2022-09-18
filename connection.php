<?php
include_once('config.php');

class UserREpository {

protected  $connection=null;
protected $stmt;
public function __construct(){
     $this->connection=configuration::GetConnection();                                     
}

public   function param(array $param=[]):void {
    try{
       if($param){
         $values = array_values($param);
          $types = str_repeat('s', count($values));
          $this->stmt->bind_param($types, ...$values);
         }
          if($this->stmt == false){
            throw new Exception($this->connection->error);
          }
       } catch(Exception $e){
          throw new Exception($e->getMessage());
        }
   }
protected   function prepare($sql):void {
    try{
        $this->stmt = $this->connection->prepare($sql);  
        if($this->stmt == false){
         throw new Exception($this->prepare()->error);
        }
       } catch(Exception $e){
          throw new Exception($e->getMessage());
        }
   }
   
protected   function execute():void {
   try{
         $this->stmt->execute();  
       if($this->stmt == false){
        throw new Exception($this->execute()->error);
       }
      } catch(Exception $e){
         throw new Exception($e->getMessage());
       }
  }


 public function selectAll(string $table,array $param=[]){
      
        $sql=("SELECT * FROM ".$table);
        $i=0;
         if(empty($param)){
            $this->prepare($sql);
             $this->execute();
           return  $this->stmt->get_result()->fetch_all(MYSQLI_ASSOC);     
         }
         foreach($param as $key => $value){
               if($i===0){
                  $sql=$sql ." WHERE $key=?";
               }else{
                  $sql=$sql ." AND $key=?";
               }
               $i++;
         }
          $this->prepare($sql);  
         $this->param($param);
         $this->execute();
        
     return  $this->stmt->get_result()->fetch_all(MYSQLI_ASSOC);                             
  }

  public function CreateTable(string $table,array $param=[]){
   $sql=("INSERT INTO $table SET ");
   $i=0;
   foreach($param as $key => $value){
         if($i===0){
            $sql=$sql ." $key=?";
         }else{
            $sql=$sql .", $key=?";
         }
         $i++;
   }

   $this->prepare($sql);
   $this->param($param);
   $this->execute();
return  $this->stmt->insert_id;                             
} 
  public function selectSingle(string $table, array $param=[]){
         $sql=("SELECT * FROM ".$table);
         $i=0;
         foreach($param as $key => $value){
               if($i===0){
                  $sql=$sql ." WHERE $key=?";
               }else{
                  $sql=$sql ." AND $key=?";
               }
               $i++;
         }
         $sql=$sql." LIMIT 0,1";
         $this->prepare($sql);
         $this->param($param);
       $this->execute();
     return  $this->stmt->get_result()->fetch_assoc();                             
  } 

      public function Update(string $table,array $param=[],$id=0){
      $sql=("UPDATE $table SET ");
      $i=0;
      foreach($param as $key => $value){
            if($i===0){
               $sql=$sql ." $key=?";
            }else{
               $sql=$sql .", $key=?";
            }
            $i++;
      }
      $sql=$sql." WHERE $id=?";
      $this->prepare($sql);
      $this->param(["id"=>$id]);
      $this->execute();
      return  $this->stmt->affected_rows;// affected table row stmt where its being updated if 0 fails if 1 ok.      
    }
}
?>