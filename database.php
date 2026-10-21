<?php
$server = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'php_login_database';

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    // Si no hay base de datos MySQL activa en la nube, evitamos que la app muera 
    // y permitimos que la interfaz cargue para que puedas verla.
    $conn = null; 
} else {
    mysqli_set_charset($conn, "utf8");
}
?>
