4
<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
// JWT generado (modifícalo con el tuyo)
$token = isset($_GET['jwt'])? $_GET['jwt'] : 
"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiYWRtaW4iLCJyb2xlIjoiYWRtaW4ifQ.sjghSlNCPFVXAvnnOJKRb2bHvqm5ClmEbuLZSF7oDcM";
// Decodificar sin verificar la firma (Inseguro, solo para pruebas)
$tokenParts = explode(".", $token);
if (count($tokenParts) !== 3) {
die("Error: El JWT no tiene el formato correcto.");
}
// Decodificar el header y el payload (sin verificar la firma)
$header = json_decode(base64_decode($tokenParts[0]), true);
$payload = json_decode(base64_decode($tokenParts[1]), true);
echo "HEADER:\n";
print_r($header);
echo "\nPAYLOAD:\n";
print_r($payload);
?>
