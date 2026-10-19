<?php
session_start();
require 'database.php';

$user = null;

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if ($results) {
        $user = $results;
        // Redirección limpia antes de enviar HTML
        header("Location: main2.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>ControlMed - Inicio</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php'; ?>

    <h2>Para continuar, ingrese con usuario o regístrese</h2>
    <p><a href="login.php">Ingreso</a> / <a href="signup.php">Registro</a></p>

    <?php require 'partials/footer.php'; ?>
</body>
</html>
