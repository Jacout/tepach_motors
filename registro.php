<?php
//adecuar a lo que se solicita en base al query, es si nomas cargar y mostrar el form, hacer otro archivo para enviar esos datos
//ejemplo mod_registro
// Datos de conexión a SQL Server
$serverName = "tu_servidor";
$connectionOptions = [
    "Database" => "tu_base_de_datos",
    "Uid" => "tu_usuario",
    "PWD" => "tu_contraseña"
];

// Establecer conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta para las opciones del primer select
$sql1 = "SELECT id, nombre FROM tabla1";
$stmt1 = sqlsrv_query($conn, $sql1);
if ($stmt1 === false) { die(print_r(sqlsrv_errors(), true)); }
$options1 = [];
while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
    $options1[] = $row;
}
sqlsrv_free_stmt($stmt1);

// Consulta para las opciones del segundo select
$sql2 = "SELECT id, nombre FROM tabla2";
$stmt2 = sqlsrv_query($conn, $sql2);
if ($stmt2 === false) { die(print_r(sqlsrv_errors(), true)); }
$options2 = [];
while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
    $options2[] = $row;
}
sqlsrv_free_stmt($stmt2);

// Consulta para las opciones del tercer select
$sql3 = "SELECT id, nombre FROM tabla3";
$stmt3 = sqlsrv_query($conn, $sql3);
if ($stmt3 === false) { die(print_r(sqlsrv_errors(), true)); }
$options3 = [];
while ($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $options3[] = $row;
}
sqlsrv_free_stmt($stmt3);

// Consulta para las opciones del cuarto select
$sql4 = "SELECT id, nombre FROM tabla4";
$stmt4 = sqlsrv_query($conn, $sql4);
if ($stmt4 === false) { die(print_r(sqlsrv_errors(), true)); }
$options4 = [];
while ($row = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)) {
    $options4[] = $row;
}
sqlsrv_free_stmt($stmt4);

// Cerrar conexión
sqlsrv_close($conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Formulario de Registro con 4 Selects</title>
<style>
  body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #e9ecef; padding: 30px; }
  form { background: white; max-width: 480px; margin: auto; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
  h2 { text-align: center; margin-bottom: 24px; color: #343a40; }
  label { display: block; margin-bottom: 8px; font-weight: 600; color: #495057; }
  select, input[type="text"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 18px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
  }
  select:focus, input[type="text"]:focus {
    border-color: #007bff;
    outline: none;
  }
  button {
    width: 100%;
    padding: 14px;
    background-color: #007bff;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    font-size: 1.1rem;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>
<form action="registro.php" method="post">
  <h2>Registro</h2>

  <label for="nombre">Nombre:</label>
  <input type="text" id="nombre" name="nombre" required>

  <label for="select1">Selecciona opción 1:</label>
  <select id="select1" name="select1" required>
    <option value="">-- Selecciona --</option>
    <?php foreach($options1 as $opt1): ?>
      <option value="<?= htmlspecialchars($opt1['id']) ?>"><?= htmlspecialchars($opt1['nombre']) ?></option>
    <?php endforeach; ?>
  </select>

  <label for="select2">Selecciona opción 2:</label>
  <select id="select2" name="select2" required>
    <option value="">-- Selecciona --</option>
    <?php foreach($options2 as $opt2): ?>
      <option value="<?= htmlspecialchars($opt2['id']) ?>"><?= htmlspecialchars($opt2['nombre']) ?></option>
    <?php endforeach; ?>
  </select>

  <label for="select3">Selecciona opción 3:</label>
  <select id="select3" name="select3" required>
    <option value="">-- Selecciona --</option>
    <?php foreach($options3 as $opt3): ?>
      <option value="<?= htmlspecialchars($opt3['id']) ?>"><?= htmlspecialchars($opt3['nombre']) ?></option>
    <?php endforeach; ?>
  </select>

  <label for="select4">Selecciona opción 4:</label>
  <select id="select4" name="select4" required>
    <option value="">-- Selecciona --</option>
    <?php foreach($options4 as $opt4): ?>
      <option value="<?= htmlspecialchars($opt4['id']) ?>"><?= htmlspecialchars($opt4['nombre']) ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit">Registrar</button>
</form>
</body>
</html>

