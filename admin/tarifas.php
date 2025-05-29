<?php
// tarifas.php
require_once('proteger.php');
require_once('../conexion.php');

// Eliminar tarifa si se indica
if (isset($_GET['eliminar'])) {
    $id = (int) $_GET['eliminar'];
    $conexion->query("DELETE FROM tarifas WHERE id = $id");
    header("Location: tarifas.php");
    exit;
}

$tarifas = $conexion->query("SELECT * FROM tarifas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarifas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tarifas</h2>
    <a href="editar_tarifa.php" class="btn btn-success mb-3">+ Nueva Tarifa</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Empresa</th>
                <th>Pot. Punta</th>
                <th>Pot. Valle</th>
                <th>kWh Punta</th>
                <th>kWh Llano</th>
                <th>kWh Valle</th>
                <th>Excedente</th>
                <th>Enlace</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($t = $tarifas->fetch_assoc()): ?>
                <tr>
                    <td><?= $t['nombre'] ?></td>
                    <td><?= $t['empresa'] ?></td>
                    <td><?= $t['precio_potencia_punta'] ?></td>
                    <td><?= $t['precio_potencia_valle'] ?></td>
                    <td><?= $t['precio_energia_punta'] ?></td>
                    <td><?= $t['precio_energia_llano'] ?></td>
                    <td><?= $t['precio_energia_valle'] ?></td>
                    <td><?= $t['precio_excedente'] ?></td>
                    <td>
                        <?php if (!empty($t['enlace'])): ?>
                            <a href="<?= $t['enlace'] ?>" target="_blank">Ver</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="editar_tarifa.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="?eliminar=<?= $t['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta tarifa?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary mt-3">Volver</a>
</div>
</body>
</html>