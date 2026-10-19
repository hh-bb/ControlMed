<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

require 'database.php';
$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if ($results && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: main2.php");
        exit();
    } else {
        $message = 'Credenciales incorrectas';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ingreso</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php'; ?>

    <?php if(!empty($message)): ?>
        <p style="color: red;"><?= $message ?></p>
    <?php endif; ?>

    <h1>Ingreso</h1>
    <span>o <a href="signup.php">Registro</a></span>

    <form action="login.php" method="POST">
        <input name="email" type="email" placeholder="Ingrese su mail" required>
        <input name="password" type="password" placeholder="Ingrese su password" required>
        <input type="submit" value="Ingresar">
    </form>

    <?php require 'partials/footer.php'; ?>
</body>
</html>
