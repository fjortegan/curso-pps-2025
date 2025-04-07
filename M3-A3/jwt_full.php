<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// Ruta al archivo de clave pública (para validar el JWT)
$publicKeyPath = "firmas/public.pem";
// Obtener el JWT desde la cabecera HTTP
$headers = getallheaders();
if (!isset($headers['Authorization'])) {
http_response_code(401);
die("Acceso denegado: No se encontró el token en la cabecera.");
}
// Extraer el token de la cabecera "Authorization: Bearer <TOKEN>"
$authHeader = $headers['Authorization'];
$token = str_replace("Bearer ", "", $authHeader);
if (!file_exists($publicKeyPath)) {
die("Error: El archivo public.pem no existe.");
}
if (!is_readable($publicKeyPath)) {
die("Error: No se puede leer el archivo public.pem, revisa permisos.");
}
// Cargar clave pública
$publicKey = file_get_contents($publicKeyPath);
try {
// Validar y decodificar el JWT
$decoded = JWT::decode($token, new Key($publicKey, "RS256"));
// **Verificar si el token ha expirado**
if ($decoded->exp < time()) {
http_response_code(401);
die("Token expirado. Por favor, inicia sesión nuevamente.");
}
// **Verificar si el usuario tiene permisos**
if ($decoded->role !== 'admin') {
http_response_code(403);
die("Acceso denegado: No tienes permisos de administrador.");
}
// Si el token es válido y el usuario es admin, permitir acceso
echo "Acceso permitido. Bienvenido, " . $decoded->user . "\n";
} catch (Exception $e) {
http_response_code(401);
die("Token inválido: " . $e->getMessage());
}
?>
