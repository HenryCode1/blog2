<?php


class configuration {

        protected static  $host='localhost';
        protected static  $user='root';
        protected static  $pass='';
        protected static  $db='little_blog';
        protected static  $con=null;
 
       public static function GetConnection(){ 
        try{
                 $host=self::$host;
                 $user=self::$user;
                 $pass=self::$pass;
                 $db=self::$db;  
                return  (self::$con=new mysqli($host,$user,$pass,$db));  
            }catch(Exception $e){
               throw new Exception($e->getMessage());
            } 
   }                             
}

?>