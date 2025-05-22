<?php
include "conexion.php";

function logError($message) {
    $logMessage = date('[Y-m-d H:i:s]') . " ERROR: " . $message . PHP_EOL;
    file_put_contents('error_log.txt', $logMessage, FILE_APPEND);
}

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = trim($_POST['username']);
        $pass = trim($_POST['password']);

        // 1. Ejecutar procedimiento almacenado
        $sql = "{CALL logeo (?)}";
        $params = array($user);
        $stmt = sqlsrv_query($conectar, $sql, $params);

        if ($stmt === false) {
            throw new Exception("Error SQL: " . print_r(sqlsrv_errors(), true));
        }

        // 2. Obtener resultados
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        
        if ($row) {
            // 3. Verificar contraseña DESENCRIPTADA
            $pass_bd = trim($row['Pass_descifrado']); // Nombre de columna exacto
            
            if ($pass_bd === $pass) {
                // 4. Redirección exitosa
                session_start();
                $_SESSION['auth'] = true;
                echo "<script>window.location.href='inventario.php';</script>";
                exit();
            } else {
                echo "<script>alert('Contraseña incorrecta');history.back();</script>";
                exit();
            }
        } else {
            echo "<script>alert('Usuario no existe');history.back();</script>";
            exit();
        }
    }
} catch (Exception $e) {
    logError($e->getMessage());
    echo "<script>alert('Error del sistema');window.location.href='login.php';</script>";
    exit();
} finally {
    if (isset($conectar)) {
        sqlsrv_close($conectar);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /* Estilo mínimo funcional */
        body { 
            background: #f0f2f5; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 300px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 1rem;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <form method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>
