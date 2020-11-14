<?php

//Cabeceras
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");


if($_GET['provehiculos']== 'vehiculos' ){
    
    include_once 'conexion.php';

    $sql = 'SELECT * FROM vehiculo';
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $datos = $sentencia->fetchAll();


}

if($_GET['provehiculos']== 'vehiculosactivos' ){
    
    include_once 'conexion.php';

    $sql = 'SELECT * FROM vehiculo WHERE estado= "ACTIVO"';
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $datos = $sentencia->fetchAll();


}

if($_GET['provehiculos']== 'vehiculosvendidos' ){
    
    include_once 'conexion.php';

    $sql = 'SELECT * FROM vehiculo WHERE estado= "VENDIDO"';
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $datos = $sentencia->fetchAll();


} 

if($_GET['provehiculos']== 'vehiculossinofertas' ){
    
    include_once 'conexion.php';

    $sql = 'SELECT * FROM vehiculo WHERE estado= "VENDIDO"';
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $datos = $sentencia->fetchAll();


} 




//else{    echo 'Solicitud no encontrada';}

echo json_encode($datos); 