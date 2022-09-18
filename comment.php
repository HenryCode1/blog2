<?php
include_once("db/connection.php");


$check=new  UserREpository ();
$t=$check->CreateTable('comment',
[
 "id"=>5,  
"title"=>"jav Programming",
"post"=>"java programming is a oop langauge.."
]
);

$r=json_encode($check,true);
echo '<pre>';
print_r($r);
echo '</pre>';

?>