<?php require_once('proteger.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Panel de Administración</h2>
    <p>Bienvenido al panel de control.</p>

    <div class="list-group mt-4">
        <a href="tarifas.php" class="list-group-item list-group-item-action">Gestionar Tarifas</a>
        <a href="sistema.php" class="list-group-item list-group-item-action">Configurar Variables del Sistema</a>
        <a href="logout.php" class="list-group-item list-group-item-action text-danger">Cerrar Sesión</a>
    </div>
</div>
</body>
</html>
