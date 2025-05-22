<?php include ('conexion.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Autos próximos a llegar</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .mensaje { padding: 10px; background: #dff0d8; color: #3c763d; margin-bottom: 15px; }
        .acciones a { margin-right: 5px; }
    </style>
</head>
<body>
    <div style="text-align: right; margin-bottom: 20px;">
        <form method="post" action="menu_inventario.php">
            <button type="submit">Regresar</button>
        </form>
    </div>
    <h1>Autos próximos a llegar</h1>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Tipo de auto</th>
            <th>Modelo</th>
            <th>Transmisión</th>
            <th>Nombre</th>
            <th>Fecha de llegada</th>
        </tr>
        
        <?php
        $sql = "SELECT * FROM INV_ACT_EXISTENCIA WHERE fechaStock > CONVERT(date, GETDATE()) ORDER BY fechaStock ASC";
        $stmt = sqlsrv_query($conectar, $sql);

        if ($stmt === false) {
            die("<tr><td colspan='8'>Error en la consulta: ".print_r(sqlsrv_errors(), true)."</td></tr>");
        }

        $hayDatos = false;
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $hayDatos = true;
            echo "<tr>
                <td>".$row['idauto']."</td>
                <td>".htmlspecialchars($row['marca'])."</td>
                <td>".htmlspecialchars($row['tipoauto'])."</td>
                <td>".$row['modelo']."</td>
                <td>".$row['transmision']."</td>
                <td>".htmlspecialchars($row['nombre'])."</td>
                <td>".($row['fechaStock'] ? $row['fechaStock']->format('Y-m-d') : 'N/A')."</td>
            </tr>";
        }

        if (!$hayDatos) {
            echo "<tr><td colspan='8'>No hay autos próximos a llegar</td></tr>";
        }

        sqlsrv_close($conectar);
        ?>
    </table>
</body>
</html>