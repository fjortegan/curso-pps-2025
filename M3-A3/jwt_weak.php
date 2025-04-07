<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
$key = "secret"; //Clave débil
$payload = ["user" => "admin", "role" => "admin"];
// Agregar el tercer parámetro: el algoritmo de firma
$jwt = JWT::encode($payload, $key, "HS256");
echo "JWT Generado: " . $jwt;
?>
