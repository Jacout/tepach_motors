<?php
include("conexion.php");

// Si es una modificación (POST), primero actualiza:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $tipo_auto = $_POST['tipo_auto'];
    $tipo_trans = $_POST['tipo_trans'];
    $fecha = $_POST['fechastock'] ? date_create($_POST['fechastock']) : null;

    try {
        // Consulta SQL para actualizar el auto
        $sqlUpdate = "EXEC act_auto @id=?, @marca=?, @tipo=?, @modelo=?, @trans=?, @nombre=?, @fechaStock=?";
        $params = [$id, $marca, $tipo_auto, $modelo, $tipo_trans, $nombre, $fecha];
        $stmt = sqlsrv_prepare($conectar, $sqlUpdate, $params);

        if ($stmt === false) {
            throw new Exception('Error al preparar la consulta.');
        }

        $resultado = sqlsrv_execute($stmt);

        if ($resultado) {
            echo "<script>alert('Auto modificado exitosamente'); window.location = '../menu.php';</script>";
            exit;
        } else {
            throw new Exception('Error al ejecutar la consulta.');
        }
    } catch (Exception $e) {
        // Registrar el error en un archivo
        $fichero = "logs.txt";
        file_put_contents($fichero, $e->getMessage() . "\n", FILE_APPEND);
        
        // Mensaje de error genérico al usuario
        echo "<script>alert('Ha ocurrido un error. Por favor, inténtelo más tarde.'); window.location = '../menu.php';</script>";
        exit;  
    } finally {
        // Cerrar la conexión
        sqlsrv_close($conectar);
    }
}
?>
