<?php

include "conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Consulta SQL para verificar el usuario y la contraseña
    $sql = "EXEC logeo @user='$user'";
    $stmt = sqlsrv_query($conectar, $sql);


    if(sqlsrv_num_rows($stmt) > 0){
        echo 'Datos incorrectos';
    }else{

        //para verificaar
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            echo $row[1] ,"<br />";
            //si es correcto
            if ($row[1]==$pass){
                echo 'Usuario correcto';
            }
            else{
                echo 'Credenciales invalidas';
            }
        }
        echo 'Datos encontrados';
    }
            sqlsrv_close($conectar);

    /*
    if ($stmt === false) {
        die("<tr><td colspan='8'>Error en la consulta: ".print_r(sqlsrv_errors(), true)."</td></tr>");
    }

    $val = false;*/
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
    <h2>Formulario de Login</h2>
    <form method="post" action="">
        Usuario: <input type="text" name="username" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

