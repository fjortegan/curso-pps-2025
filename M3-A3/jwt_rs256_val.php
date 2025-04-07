<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
$publicKeyPath = "firmas/public.pem";
$token = $_GET['jwt']; //Coloca aquí tu JWT
if (!file_exists($publicKeyPath)) {
die("Error: El archivo public.pem no existe.");
}
if (!is_readable($publicKeyPath)) {
die("Error: No se puede leer el archivo public.pem, revisa permisos.");
}
// Cargar clave pública
$publicKey = file_get_contents($publicKeyPath);
try {
// Decodificar y validar la firma
$decoded = JWT::decode($token, new Key($publicKey, "RS256"));
echo "Token válido! Información decodificada:\n";
print_r($decoded);
} catch (Exception $e) {
echo "Token inválido: " . $e->getMessage();
}
?>
