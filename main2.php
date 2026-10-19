<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

date_default_timezone_set('America/Argentina/Buenos_Aires');
require 'database.php';

$stmt = $conn->prepare("SELECT * FROM pacientes");
$stmt->execute();
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>ControlMed - Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <?php require 'partials/header.php'; ?>

    <div style="text-align: right; padding: 10px 20px;">
        <a href="logout.php">Cerrar Sesión</a>
    </div>

    <div class="container-table">
        <div class="table__title">Pacientes registrados</div>
        <div class="table__header">Nombre</div>
        <div class="table__header">Apellido</div>
        <div class="table__header">Medicación</div>
        <div class="table__header">Dosis Pres.</div>
        <div class="table__header">Dosis Ind.</div>
        <div class="table__header">Fecha Receta</div>
        <div class="table__header">Acciones</div>

        <?php foreach($pacientes as $row): ?>
            <div class="table__item"><?= htmlspecialchars($row["nombre"]); ?></div>
            <div class="table__item"><?= htmlspecialchars($row["apellido"]); ?></div>
            <div class="table__item"><?= htmlspecialchars($row["medicacion"]); ?></div>
            <div class="table__item"><?= htmlspecialchars($row["dosis"]); ?></div>
            <div class="table__item"><?= htmlspecialchars($row["dosisindicada"]); ?></div>
            <div class="table__item"><?= htmlspecialchars($row["fechareceta"]); ?></div>
            <div class="table__item">-</div>
        <?php endforeach; ?>
    </div>

    <div class="container-add">
        <h2 class="container__title">Registrar paciente</h2>
        <form action="insertar.php" method="post" class="container__form">
            <input name="nombre" type="text" class="container__input" placeholder="Nombre" required>
            <input name="apellido" type="text" class="container__input" placeholder="Apellido" required>
            <input name="medicacion" type="text" class="container__input" placeholder="Medicación" required>
            <input name="dosis" type="number" class="container__input" placeholder="Dosis en presentación (mg)" required>
            <input name="dosisindicada" type="number" class="container__input" placeholder="Dosis Indicada (mg)" required>
            <input name="fechareceta" type="date" class="container__input" placeholder="Fecha de receta" required>
            <input class="container__submit" type="submit" value="Registrar">
        </form>
    </div>

    <?php require 'partials/footer.php'; ?>
</body>
</html>

