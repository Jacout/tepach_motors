<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú de Inventario de Automóviles</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 80px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            border-radius: 12px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
        }

        .menu a {
            display: block;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .menu a:hover {
            background-color: #45a049;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Menu de Inventario de Automóviles</h1>
        <div class="menu">
            <a href="menu_inventario.php">🚗 Ver Inventario de Automóviles</a>
            <a href="registro.php">➕ Ingresar un Automóvil</a>
            <a href="modificar.php">✏️ Actualizar Datos de un Automóvil</a>
            <a href="eliminar_lista.php">🗑️ Eliminar un Automóvil</a>
        </div>
        <div style="text-align: right; margin-bottom: 20px;">
        <form method="post" action="login.php">
        <button type="submit">cerrar sesion</button>
        </form>
        </div>
    </div>
</body>
</html>