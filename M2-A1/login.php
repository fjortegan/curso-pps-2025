<?php
$conn = new mysqli("db", "root", "root", "seguridad_db");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $_POST["username"];
$password = $_POST["password"];
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
echo "Consulta ejecutada: " . $query . "<br>";
$result = $conn->query($query);
if ($result) {
if ($result->num_rows > 0) {
echo "Inicio de sesión exitoso<br>";
// Modificación: Mostrar datos extraídos de la consulta
while ($row = $result->fetch_assoc()) {
echo "ID: " . $row['id'] . " - Usuario: " . $row['username'] . " -
Contraseña: " . $row['password'] . "<br>";
}
} else {
echo "Usuario o contraseña incorrectos";
}
} else {
echo "Error en la consulta: " . $conn->error;
}
}
?>
<form method="post">
<input type="text" name="username" placeholder="Usuario">
<input type="password" name="password" placeholder="Contraseña">
<button type="submit">Iniciar Sesión</button>
</form>
