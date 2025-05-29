<?php require_once('../conexion.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comparador de Tarifas de Luz</title>

    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Introduce los datos de tu factura</h2>
        <form action="resultado.php" method="POST" class="card p-4 shadow-sm">

            <div class="mb-3">
                <label class="form-label">Potencia contratada PUNTA (kW)</label>
                <input type="number" name="potencia_punta" step="0.001" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Potencia contratada VALLE (kW)</label>
                <input type="number" name="potencia_valle" step="0.001" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Energía consumida PUNTA (kWh)</label>
                <input type="number" name="kwh_punta" step="0.001" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Energía consumida LLANO (kWh)</label>
                <input type="number" name="kwh_llano" step="0.001" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Energía consumida VALLE (kWh)</label>
                <input type="number" name="kwh_valle" step="0.001" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Excedente vertido (kWh, si tienes placas)</label>
                <input type="number" name="excedente" step="0.001" class="form-control" value="0">
            </div>

            <div class="mb-3">
                <label class="form-label">Días de la factura</label>
                <input type="number" name="dias" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Comparar Tarifas</button>
        </form>
    </div>

    <!-- Bootstrap JS desde CDN (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-zWqaNGLnY6BOyYeMZ6zTyyS9L7KnTsp/Upwd6B2aZVQCMp6+DR2P4rC/f7pPbYV7" crossorigin="anonymous"></script>
</body>
</html>
