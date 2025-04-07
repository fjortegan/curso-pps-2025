<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
$privateKey = file_get_contents("firmas/private.pem"); //Clave privada fuerte
$payload = [
"user" => "admin",
"role" => "admin",
"iat" => time(),
"exp" => time() + 3600 // Expira en 1 hora
];
$jwt = JWT::encode($payload, $privateKey, "RS256");
echo "JWT Seguro Generado:\n" . $jwt . "\n";
?>
