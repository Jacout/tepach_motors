<?php
$serverName = ''; //este cambiar dependiendo
$connectionInfo = array( 'Database'=>'Produccion', 'UID'=>'', 'PWD'=>''); // cambiear UID y PWD
$conectar = sqlsrv_connect( $serverName, $connectionInfo); 
if ($conectar){
} else{
echo 'Hubo un error al conectarse a la base de datos. A continuación, los errores: <br>';
die( print_r(sqlsrv_errors(),true));
}
?>
