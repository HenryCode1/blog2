<?php
include_once("db/connection.php");


$check=new  UserREpository ();
$t=$check->selectSingle('comment',
['id'=>$_GET["id"]

]);
if(!$_GET['id']){
   echo "wrong parameter";                                     
   exit();
}
$r=json_encode($check,true);
echo '<pre>';
print_r($r);
echo '</pre>';

?>