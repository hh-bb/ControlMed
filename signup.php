<?php
require 'database.php';
$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        $message = 'Nuevo usuario creado con éxito. <a href="login.php">Inicia sesión</a>';
    } else {
        $message = 'Problema al crear usuario';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php'; ?>

    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <h1>Registro</h1>
    <span>o <a href="login.php">Ingreso</a></span>

    <form action="signup.php" method="POST">
        <input name="email" type="email" placeholder="Ingrese su mail" required>
        <input name="password" type="password" placeholder="Elija una contraseña" required>
        <input type="submit" value="Registrarse">
    </form>

    <?php require 'partials/footer.php'; ?>
</body>
</html>
