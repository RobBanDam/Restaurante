<?php

$servidor = "localhost";
$baseDatos = "restaurante";
$usuario = "root";
$contrasena = "root";

//Creamos la conexión a la base de datos.
try {
    $conexion = new PDO("mysql:host=$servidor; dbname=$baseDatos", $usuario, $contrasena);    
} catch (Exception $error) {
    echo $error->getMessage();
}
