<?php
include 'database.php';

$obj = new Database();
$obj->insert('students',['name'=>'anita' , 'age'=> '21', 'city'=>'rpg']);	

 print_r($obj->getResult());
?>