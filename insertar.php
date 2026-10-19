<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST["nombre"] ?? '';
    $apellido = $_POST["apellido"] ?? '';
    $medicacion = $_POST["medicacion"] ?? '';
    $dosis = $_POST["dosis"] ?? 0;
    $dosisindicada = $_POST["dosisindicada"] ?? 0;
    $fechareceta = $_POST["fechareceta"] ?? '';

    // Consulta preparada para evitar Inyección SQL
    $sql = "INSERT INTO pacientes (nombre, apellido, medicacion, dosis, dosisindicada, fechareceta) VALUES (:nombre, :apellido, :medicacion, :dosis, :dosisindicada, :fechareceta)";
    $stmt = $conn->prepare($sql);
    
    $resultado = $stmt->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':medicacion' => $medicacion,
        ':dosis' => $dosis,
        ':dosisindicada' => $dosisindicada,
        ':fechareceta' => $fechareceta
    ]);

    if ($resultado) {
        echo "<script>alert('Paciente registrado correctamente'); window.location='main2.php';</script>";
    } else {
        echo "<script>alert('No se pudo registrar'); window.history.go(-1);</script>";
    }
}
?>
