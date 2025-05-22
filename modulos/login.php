<?php


include "conexion copy.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Consulta SQL para verificar el usuario y la contraseña
    try{
    $sql = "EXEC logeo @user=?";
    $parametros = array($user);
    $stmt = sqlsrv_query($conectar, $sql,$parametros);
    //Se valida si hay registros en base al login

    
    if($stmt === false){
        echo'<script type="text/javascript">
        alert("Credenciales incorrectas");
        window.location.href="../index.html"
        </script>';
        exit;
    }else{
        //para verificaar si concide con el registro
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
            //si es correcto
            if ($row[1]==$pass){
                echo'<script type="text/javascript">
                alert("Bienvenido, iniciando sesion");
                window.location.href="../menu.php"
                </script>';
                exit;
            } // si no lo mando a ingresar de nuevo
            else{
                echo'<script type="text/javascript">
                alert("Credenciales incorrectas");
                window.location.href="../index.html"
                </script>';
                exit;
            }
            }
    }
            sqlsrv_close($conectar);
}
    catch(Exception $e){
        $fichero = "logs.txt";
        $errores = sqlsrv_errors();
        file_put_contents($fichero, $errores);
        exit;
    }
    /*
    if ($stmt === false) {
        die("<tr><td colspan='8'>Error en la consulta: ".print_r(sqlsrv_errors(), true)."</td></tr>");
    }

    $val = false;*/
}

?>