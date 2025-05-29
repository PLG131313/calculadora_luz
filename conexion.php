<?php
// Datos de conexión a la base de datos
$servidor = "127.0.0.1";
$usuario = "jorge";
$contraseña = "666666.j";
$basededatos = "calculadora_luz";

//**********************************************************************
// CONEXIÓN A LOCALHOST
//**********************************************************************
try {
    // Crear conexión con el servidor de base de datos
    $conexion = new mysqli($servidor, $usuario, $contraseña, $basededatos);

    // Configurar charset para evitar problemas con acentos y ñ
    $conexion->query("SET NAMES 'utf8'");

    // Aquí puedes dejar un mensaje opcional de éxito (comentado para producción)
    // echo "Conexión exitosa";
} catch (Exception $e) {
    // En caso de error, mostrar mensaje
    echo "<font color='red' size='5'><b>ERROR:</b><br> No se pudo realizar la conexión a la base de datos.</font><br>";
    // También puedes mostrar el error si estás en desarrollo:
    // echo "Error capturado: " . $e->getMessage();
    exit;
}
?>
