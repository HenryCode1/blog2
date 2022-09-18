<?php
include_once("db/connection.php");


$check=new  UserREpository ();
$t=$check->Update('comment',
[
 "id"=>1,  
"title"=>"jav Programming",
"post"=>"java programming is a oop langauge.."
]
);

//$t=$check-> Update("comment");
//$r=json_encode($check,true);
echo '<pre>';
print_r($t);
echo '</pre>';

?>