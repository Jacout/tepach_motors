<?php
include('conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tbinv_autos WHERE idauto = ?";
    $stmt = sqlsrv_prepare($conectar, $sql, [$id]);

    if ($stmt && sqlsrv_execute($stmt)) {
        // Redirige con parámetro de éxito
        header("Location: eliminar_lista.php?eliminado=1");
        exit();
    } else {
        echo "Error al eliminar el auto: ";
        print_r(sqlsrv_errors());
    }
} else {
    echo "ID no especificado.";
}
?>