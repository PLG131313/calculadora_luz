<?php
require_once('proteger.php');
require_once('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $margen = (float) $_POST['margen_error'];
    $conexion->query("UPDATE sistema SET margen_error = $margen WHERE id = 1");
}

$valores = $conexion->query("SELECT * FROM sistema LIMIT 1")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configuración del Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Configuración del Sistema</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Margen de Error (%)</label>
            <input type="number" step="0.000001" name="margen_error" value="<?= $valores['margen_error'] ?>" required class="form-control">
        </div>
        <button class="btn btn-primary">Guardar</button>
        <a href="dashboard.php" class="btn btn-secondary">Volver</a>
    </form>
</div>
</body>
</html>
