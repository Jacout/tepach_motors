<?php include ('modulos/conexion.php'); //cambiar la conexion
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventario de Carros</title>
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
    </div>
        <div style="text-align: right; margin-bottom: 20px;">
        <form method="post" action="menu.php">
        <button type="submit">regresar</button>
        </form>
    </div>
    <h1>Inventario de Carros</h1>
    <?php if (isset($_GET['eliminado']) && $_GET['eliminado'] == '1'): ?>
    <div class="mensaje">Auto eliminado con éxito.</div>
    <?php endif; ?>

    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>tipo de auto</th>
            <th>modelo</th>
            <th>Transmisión</th>
            <th>Nombre</th>
            <th>Fecha de stock</th>
        </tr>
        
        <?php
        $sql = "SELECT * FROM INV_ACT_EXISTENCIA"; //cambiar por la vista o un procedimiento
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
                <td class='acciones'>
                    <a href='modulos/eliminar.php?id=".$row['idauto']."' onclick='return confirm(\"¿Estás seguro de eliminar este auto?\")'>Eliminar</a>
                </td>
            </tr>";
        }

        if (!$hayDatos) {
            echo "<tr><td colspan='8'>No hay carros registrados</td></tr>";
        }

        sqlsrv_close($conectar);
        ?>
    </table>
</body>
</html>