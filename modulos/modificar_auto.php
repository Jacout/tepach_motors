<?php
include "conexion.php";

// Si es una modificación (POST), primero actualiza:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    if ($id === 0) {
        die("ID inválido");
    }

    $nombre = $_POST['nombre'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $tipo_auto = $_POST['tipo_auto'];
    $tipo_trans = $_POST['tipo_trans'];
    $fecha = $_POST['fechastock'] ? date_create($_POST['fechastock']) : null;

    $sqlUpdate = "UPDATE tbinv_autos SET nombre = ?, modelo = ?, marca = ?, tipoauto = ?, transmision = ?, fechaStock = ? WHERE idauto = ?";
    $params = [$nombre, $modelo, $marca, $tipo_auto, $tipo_trans, $fecha, $id];
    $stmt = sqlsrv_query($conectar, $sqlUpdate, $params);

    if ($stmt) {
        echo "<script>alert('Auto modificado exitosamente'); window.location = 'modificar.php';</script>";
        exit;
    } else {
        echo "<p>Error al modificar: ".print_r(sqlsrv_errors(), true)."</p>";
    }
}

// Si es GET, mostrar el formulario
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id === 0) {
    die("ID inválido");
}

// Obtener datos actuales
$sql = "SELECT * FROM tbinv_autos WHERE idauto = ?";
$stmt = sqlsrv_query($conectar, $sql, [$id]);
$auto = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if (!$auto) die("Auto no encontrado");

// Obtener opciones de los selects
function obtenerOpciones($tabla, $conectar) {
    $sql = "SELECT * FROM $tabla";
    $stmt = sqlsrv_query($conectar, $sql);
    $opciones = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $opciones[] = $row;
    }
    return $opciones;
}
$options1 = obtenerOpciones("tbAno", $conectar);
$options2 = obtenerOpciones("tbmarca", $conectar);
$options3 = obtenerOpciones("tbtipo", $conectar);
$options4 = obtenerOpciones("tbTipoTrans", $conectar);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar auto</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #1f4037, #99f2c8);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 16px 32px rgba(0,0,0,0.2);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #115e59;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 2px solid #115e59;
            border-radius: 8px;
            font-size: 14px;
        }
        button {
            background-color: #115e59;
            color: white;
            padding: 14px;
            font-size: 16px;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 25px;
        }
        button:hover {
            background-color: #0e4b47;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="modificar_auto.php" method="post">
            <h2>Modificar Auto ID: <?= $id ?></h2>
            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($auto['nombre']) ?>" required>

            <label for="fechastock">Fecha de stock:</label>
            <input type="date" name="fechastock" value="<?= $auto['fechaStock'] ? $auto['fechaStock']->format('Y-m-d') : '' ?>">

            <label for="modelo">Modelo:</label>
            <select name="modelo" required>
                <option value="">-- Selecciona --</option>
                <?php foreach($options1 as $opt): ?>
                    <option value="<?= $opt['id_ano'] ?>" <?= $opt['id_ano'] == $auto['modelo'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($opt['ano']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="marca">Marca:</label>
            <select name="marca" required>
                <option value="">-- Selecciona --</option>
                <?php foreach($options2 as $opt): ?>
                    <option value="<?= $opt['id_marca'] ?>" <?= $opt['id_marca'] == $auto['marca'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($opt['nom_marca']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="tipo_auto">Tipo de auto:</label>
            <select name="tipo_auto" required>
                <option value="">-- Selecciona --</option>
                <?php foreach($options3 as $opt): ?>
                    <option value="<?= $opt['id_tipo'] ?>" <?= $opt['id_tipo'] == $auto['tipoauto'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($opt['tipo_auto']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="tipo_trans">Transmisión:</label>
            <select name="tipo_trans" required>
                <option value="">-- Selecciona --</option>
                <?php foreach($options4 as $opt): ?>
                    <option value="<?= $opt['id_tipo_trans'] ?>" <?= $opt['id_tipo_trans'] == $auto['transmision'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($opt['tipo_trans']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
