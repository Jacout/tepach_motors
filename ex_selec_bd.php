<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Formulario de Registro</title>
<style>
  body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
  form { background: white; padding: 20px; border-radius: 6px; max-width: 400px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
  label { display: block; margin-bottom: 6px; margin-top: 12px; font-weight: bold;}
  input, select { width: 100%; padding: 8px; box-sizing: border-box; }
  button { margin-top: 16px; background: #007bff; color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer; }
  button:hover { background: #0056b3; }
  .message { margin-top: 20px; font-size: 1.1em; }
</style>
</head>
<body>
<h2>Registro</h2>
<form action="registro.php" method="post">
  <label for="nombre">Nombre:</label>
  <input type="text" name="nombre" id="nombre" required>

  <label for="clave_foranea">Selecciona categoría:</label>
  <select name="clave_foranea" id="clave_foranea" required>
    <option value="">--Selecciona--</option>
    <option value="1">Categoría 1</option>
    <option value="2">Categoría 2</option>
    <option value="3">Categoría 3</option>
    <!-- Aquí debes poner las opciones según las claves foráneas disponibles -->
  </select>

  <button type="submit">Registrar</button>
</form>
</body>
</html>
