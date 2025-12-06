<?php

$host = "localhost";
$db_name = "mtvawards";
$username = "root";
$password = "";
$conexion = null;

try {
    $dsn = "mysql:host=" . $host . ";dbname=" . $db_name. ";charset=utf8mb4";
    
    $conexion = new PDO(
        $dsn,
        $username,
        $password
    );

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $conexion->exec("set names utf8");

} catch (PDOException $exception) {
    die("Error de conexión a la base de datos: " . $exception->getMessage());
}