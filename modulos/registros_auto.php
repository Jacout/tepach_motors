<?php
include("conexion.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//ya quedo
    $nombre = $_POST['nombre'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $tipo_auto = $_POST['tipo_auto'];
    $tipo_trans = $_POST['tipo_trans'];
    $fecha = $_POST['fechastock'] ? date_create($_POST['fechastock']) : null;


    try {
        // Consulta SQL para registrar el auto
        $sql = "EXEC registro_auto @marca=?, @tipo=?, @modelo=?, @trans=?, @nombre=?, @fechaStock=?";
        $params = [$marca, $tipo_auto, $modelo, $tipo_trans, $nombre, $fecha];
        $stmt = sqlsrv_prepare($conectar, $sql, $params);

        if ($stmt === false) {
            throw new Exception('Error al preparar la consulta: ' . print_r(sqlsrv_errors(), true));
        }

        $resultado = sqlsrv_execute($stmt);

        if ($resultado) {
            echo "<script>alert('Auto registrado exitosamente'); window.location = '../menu.php';</script>";
            exit;
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . print_r(sqlsrv_errors(), true));
        }
    } catch (Exception $e) {
        // Registrar el error en un archivo
        $fichero = "logs.txt";
        file_put_contents($fichero, $e->getMessage() . "\n", FILE_APPEND);
        
        // Mensaje de error al usuario
        echo "<script>alert('Ha ocurrido un error. Por favor, inténtelo más tarde.'); window.location = '../registro.php';</script>";
        exit;
    } finally {
        // Cerrar la conexión
        sqlsrv_close($conectar);
    }
        //echo "<script>alert('Ah ocurrido un error'); window.location = '../registro.php';</script>";
        //exit;    }
}

?>