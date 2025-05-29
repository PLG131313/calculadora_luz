<?php
// resultado.php
require_once('../conexion.php');

$potencia_punta = (float) $_POST['potencia_punta'];
$potencia_valle = (float) $_POST['potencia_valle'];
$kwh_punta = (float) $_POST['kwh_punta'];
$kwh_llano = (float) $_POST['kwh_llano'];
$kwh_valle = (float) $_POST['kwh_valle'];
$excedente = (float) $_POST['excedente'];
$dias = (int) $_POST['dias'];

$config = $conexion->query("SELECT * FROM sistema LIMIT 1")->fetch_assoc();
$tarifas = $conexion->query("SELECT * FROM tarifas");

$resultados = [];

while ($tarifa = $tarifas->fetch_assoc()) {
    $total = 0;
    $total += $potencia_punta * $dias * $tarifa['precio_potencia_punta'] / 365;
    $total += $potencia_valle * $dias * $tarifa['precio_potencia_valle'] / 365;
    $total += $kwh_punta * $tarifa['precio_energia_punta'];
    $total += $kwh_llano * $tarifa['precio_energia_llano'];
    $total += $kwh_valle * $tarifa['precio_energia_valle'];
    if ($excedente > 0 && isset($tarifa['precio_excedente'])) {
        $total -= $excedente * $tarifa['precio_excedente'];
    }
    $total += $total * 0.0005;

    $resultados[] = [
        'nombre' => $tarifa['nombre'],
        'empresa' => $tarifa['empresa'],
        'enlace' => $tarifa['enlace'],
        'coste' => round($total, 2),
    ];
}

usort($resultados, fn($a, $b) => $a['coste'] <=> $b['coste']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados - Comparador de Luz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Resultado de Comparación</h2>

    <div class="alert alert-success">
        <strong>Recomendado:</strong> La mejor tarifa es <b><?= $resultados[0]['nombre'] ?></b> con un coste estimado de <b><?= $resultados[0]['coste'] ?> €</b>.
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tarifa</th>
                <th>Empresa</th>
                <th>Coste Estimado (€)</th>
                <th>Enlace</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $fila): ?>
                <tr>
                    <td><?= $fila['nombre'] ?></td>
                    <td><?= $fila['empresa'] ?></td>
                    <td><?= number_format($fila['coste'], 2) ?></td>
                    <td>
                        <?php if (!empty($fila['enlace'])): ?>
                            <a href="<?= $fila['enlace'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">Ir</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary mt-3">Volver</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
