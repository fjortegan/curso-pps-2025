<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
$privateKey = file_get_contents("firmas/private.pem");
$payload = [
"user" => "admin",
"role" => "admin",
"iat" => time(),
"exp" => time() + 3600 // Expira en 1 hora
];
$jwt = JWT::encode($payload, $privateKey, "RS256");
echo "JWT Generado:\n" . $jwt . "\n";
?>
