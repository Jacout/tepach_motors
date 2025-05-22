<?php
include('conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try{
    $sql = "EXEC Eliminar @id=?";
    $stmt = sqlsrv_prepare($conectar, $sql, [$id]);

    if ($stmt && sqlsrv_execute($stmt)) {
        // Redirige con parámetro de éxito
        header("Location: ../eliminar_lista.php?eliminado=1");
        exit();
    }
    else {
        echo "Error al eliminar el auto: ";
    }

    }
    catch (Exception $e) {
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