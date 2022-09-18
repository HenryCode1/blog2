<?php
include_once("db/connection.php");


$check=new  UserREpository ();
$t=$check->selectAll('comment');

$r=json_encode($check,true);
echo '<pre>';
print_r($r);
echo '</pre>';

?>