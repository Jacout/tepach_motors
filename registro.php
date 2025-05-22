<?php
include "modulos/conexion copy.php";
// Establecer conexión


$sql1 = "SELECT * FROM tbAno";
$stmt1 = sqlsrv_query($conectar, $sql1);
if ($stmt1 === false) { 
    $errors = sqlsrv_errors();
    $errorMessage = print_r($errors, true);
    
    // Guardar el error en un archivo de texto
    $logFile = 'logs.txt'; // Nombre del archivo donde se guardarán los errores
    file_put_contents($logFile, $errorMessage, FILE_APPEND);
}
$options1 = [];
while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
    $options1[] = $row;
}
sqlsrv_free_stmt($stmt1);


$sql2 = "SELECT * FROM tbmarca";
$stmt2 = sqlsrv_query($conectar, $sql2);
if ($stmt2 === false) { 
      $errors = sqlsrv_errors();
    $errorMessage = print_r($errors, true);
    
    // Guardar el error en un archivo de texto
    $logFile = 'logs.txt'; // Nombre del archivo donde se guardarán los errores
    file_put_contents($logFile, $errorMessage, FILE_APPEND);

}
$options2 = [];
while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
    $options2[] = $row;
}
sqlsrv_free_stmt($stmt2);

$sql3 = "SELECT * FROM tbtipo";
$stmt3 = sqlsrv_query($conectar, $sql3);
if ($stmt3 === false) { 
      $errors = sqlsrv_errors();
    $errorMessage = print_r($errors, true);
    
    // Guardar el error en un archivo de texto
    $logFile = 'logs.txt'; // Nombre del archivo donde se guardarán los errores
    file_put_contents($logFile, $errorMessage, FILE_APPEND);

}
$options3 = [];
while ($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $options3[] = $row;
}
sqlsrv_free_stmt($stmt3);

$sql4 = "SELECT * FROM tbTipoTrans";
$stmt4 = sqlsrv_query($conectar, $sql4);
if ($stmt4 === false) { 
    $errors = sqlsrv_errors();
    $errorMessage = print_r($errors, true);
    
    // Guardar el error en un archivo de texto
    $logFile = 'logs.txt'; // Nombre del archivo donde se guardarán los errores
    file_put_contents($logFile, $errorMessage, FILE_APPEND);

}
$options4 = [];
while ($row = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)) {
    $options4[] = $row;
}
sqlsrv_free_stmt($stmt4);


// Cerrar conexión
sqlsrv_close($conectar);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Registro de auto</title>
<link rel="stylesheet" href="styles/estilos_reg.css">

</head>
<body>
<form action="modulos/registros_auto.php" method="post">
  <h2>Registro</h2>
  <label for="nombre">Nombre:</label>
  <input type="text" id="nombre" name="nombre" required>
  <label for="fechastock">FechaStock:</label>
  <input type="date" name="fechastock">
  <label for="select1">Modelo:</label>
  <select id="select1" name="modelo" required>
    <option value="">-- Selecciona--</option>
    <?php foreach($options1 as $opt1): ?>
      <option value="<?= htmlspecialchars($opt1['id_ano']) ?>"><?= htmlspecialchars($opt1['ano']) ?></option>
    <?php endforeach; ?>
  </select>
  <label for="select2">Marca:</label>
  <select id="select2" name="marca" required>
    <option value="">-- Selecciona --</option>
    <?php foreach($options2 as $opt2):?>    
      <option value="<?= htmlspecialchars($opt2['id_marca']) ?>"><?= htmlspecialchars($opt2['nom_marca']) ?></option>
    <?php endforeach; ?>
  </select>

  <label for="select3">Tipo auto:</label>
  <select id="select3" name="tipo_auto" required>
    <option value="">-- Selecciona --</option>
    <?php foreach($options3 as $opt3): ?>
      <option value="<?= htmlspecialchars($opt3['id_tipo']) ?>"><?= htmlspecialchars($opt3['tipo_auto']) ?></option>
    <?php endforeach; ?>
  </select>

  <label for="select4">Tipo de tranmision:</label>
  <select id="select4" name="tipo_trans" required>
    <option value="">-- Selecciona --</option>
    <?php foreach($options4 as $opt4): ?>
      <option value="<?= htmlspecialchars($opt4['id_tipo_trans']) ?>"><?= htmlspecialchars($opt4['tipo_trans']) ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit">Registrar</button>
</form>
</body>
</html>

