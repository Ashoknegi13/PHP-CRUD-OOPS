<?php
include 'database.php';

$obj = new Database();

// $obj->insert('students',['name'=>'anita' , 'age'=> '21', 'city'=>'rpg']);	
//  print_r($obj->getResult());
 


// $obj->update('students',['name'=>'anita ashok', 'age'=>'21','city'=>'gwar'], 'id="35" ');
// print_r($obj->getResult());



// $obj->update('students',['city'=>'rudraprayag'], 'city="rpg" ');
//print_r($obj->getResult());


// $obj->delete('students','id="44"');
// echo "<pre>";
// print_r($obj->getResult());
// echo "</pre>";

// $obj->sql("SELECT * FROM students WHERE city = 'gurgaon' ");
//  echo "<pre>";
//  print_r($obj->getResult());
//  echo "</pre>";



// $obj->select('students','*',null,'city="gurgaon"',null,3);
//  echo "<pre>";
//  print_r($obj->getResult());
//  echo "</pre>";

?>