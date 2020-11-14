<?php

$link = 'mysql:host=160.153.146.67;dbname=provehiculos';
$usuario = 'roudrobin';
$pass = 'Alfanet*01/';

try{

    $pdo = new PDO($link,$usuario,$pass);

   // echo 'Conectado';

}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
} 