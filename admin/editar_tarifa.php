<?php
require_once('proteger.php');
require_once('../conexion.php');

$editando = isset($_GET['id']);
$id = $editando ? (int) $_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $empresa = $_POST['empresa'];
    $enlace = $_POST['enlace'];
    $ppp = $_POST['precio_potencia_punta'];
    $ppv = $_POST['precio_potencia_valle'];
    $pep = $_POST['precio_energia_punta'];
    $pel = $_POST['precio_energia_llano'];
    $pev = $_POST['precio_energia_valle'];
    $exc = $_POST['precio_excedente'];

    if ($editando) {
        $conexion->query("UPDATE tarifas SET 
            nombre = '$nombre',
            empresa = '$empresa',
            enlace = '$enlace',
            precio_potencia_punta = $ppp,
            precio_potencia_valle = $ppv,
            precio_energia_punta = $pep,
            precio_energia_llano = $pel,
            precio_energia_valle = $pev,
            precio_excedente = $exc
            WHERE id = $id
        ");
    } else {
        $conexion->query("INSERT INTO tarifas (
            nombre, empresa, enlace,
            precio_potencia_punta, precio_potencia_valle,
            precio_energia_punta, precio_energia_llano,
            precio_energia_valle, precio_excedente
        ) VALUES (
            '$nombre', '$empresa', '$enlace',
            $ppp, $ppv, $pep, $pel, $pev, $exc
        )");
    }

    header("Location: tarifas.php");
    exit;
}

$datos = [
    'nombre' => '',
    'empresa' => '',
    'enlace' => '',
    'precio_potencia_punta' => 0,
    'precio_potencia_valle' => 0,
    'precio_energia_punta' => 0,
    'precio_energia_llano' => 0,
    'precio_energia_valle' => 0,
    'precio_excedente' => 0
];

if ($editando) {
    $res = $conexion->query("SELECT * FROM tarifas WHERE id = $id");
    if ($res->num_rows) {
        $datos = $res->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $editando ? 'Editar Tarifa' : 'Nueva Tarifa' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2><?= $editando ? 'Editar Tarifa' : 'Nueva Tarifa' ?></h2>
    <form method="POST">
        <?php foreach ($datos as $campo => $valor): ?>
            <div class="mb-3">
                <label class="form-label"><?= ucfirst(str_replace('_', ' ', $campo)) ?></label>
                <input type="<?= is_numeric($valor) && $campo !== 'enlace' ? 'number' : 'text' ?>" name="<?= $campo ?>" value="<?= htmlspecialchars($valor) ?>" step="0.000001" required class="form-control">
            </div>
        <?php endforeach; ?>
        <button class="btn btn-primary">Guardar</button>
        <a href="tarifas.php" class="btn btn-secondary">Volver</a>
    </form>
</div>
</body>
</html>
