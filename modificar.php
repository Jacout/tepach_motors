<?php include ('modulos/conexion.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventario actual de Carros</title>
    <link rel="stylesheet" href="styles/estilos_edi.css">
</head>
<body>
    <div class="container">
        <a href="menu.php" class="btn-volver">Volver al menú</a>
        <h1>Inventario actual de Carros</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Tipo de auto</th>
                <th>Modelo</th>
                <th>Transmisión</th>
                <th>Nombre</th>
                <th>Fecha de stock</th>
                <th>Acciones</th>
            </tr>
            <?php
            $sql = "SELECT * FROM INV_ACT_EXISTENCIA ORDER BY idauto DESC";
            $stmt = sqlsrv_query($conectar, $sql);
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>
                    <td>{$row['idauto']}</td>
                    <td>".htmlspecialchars($row['marca'])."</td>
                    <td>".htmlspecialchars($row['tipoauto'])."</td>
                    <td>{$row['modelo']}</td>
                    <td>{$row['transmision']}</td>
                    <td>".htmlspecialchars($row['nombre'])."</td>
                    <td>".($row['fechaStock'] ? $row['fechaStock']->format('Y-m-d') : 'N/A')."</td>
                    <td class='acciones'><a href='modificar_auto.php?id={$row['idauto']}'>Modificar</a></td>
                </tr>";
            }
            sqlsrv_close($conectar);
            ?>
        </table>
    </div>
</body>
</html>
