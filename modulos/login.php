<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Consulta SQL para verificar el usuario y la contraseña
    try {
        $sql = "EXEC logeo @user=?";
        $parametros = array($user);
        $stmt = sqlsrv_prepare($conectar, $sql, $parametros);

        if ($stmt === false) {
            throw new Exception('Error al preparar la consulta: ' . print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt) === false) {
            throw new Exception('Error al ejecutar la consulta: ' . print_r(sqlsrv_errors(), true));
        }

        // Verificar si hay registros
        if (sqlsrv_has_rows($stmt) === false) {
            echo '<script type="text/javascript">
            alert("Credenciales incorrectas");
            window.location.href="../index.html";
            </script>';
            exit;
        } else {
             //para verificar si concide con el registro
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            //si es correcto
            if ($row[1]==$pass){
                echo'<script type="text/javascript">
                alert("Bienvenido, iniciando sesion");
                window.location.href="../menu.php"
                </script>';
                exit;
            }
            else {
                echo '<script type="text/javascript">
                alert("Credenciales incorrectas");
                window.location.href="../index.html";
                </script>';
                exit;
            }
        }
    }
}
    catch (Exception $e) {
        // Registrar el error en un archivo
        $fichero = "logs.txt";
        file_put_contents($fichero, $e->getMessage() . "\n", FILE_APPEND);
        echo '<script type="text/javascript">
        alert("Credenciales incorrectas");
        window.location.href="../index.html";
        </script>';
        exit;
    } finally {
        // Cerrar la conexión
        sqlsrv_close($conectar);
    }
}
?>
