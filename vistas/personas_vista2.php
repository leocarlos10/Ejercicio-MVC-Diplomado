<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Nombre y estatura</title>
    <link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
    <h1>Crear usuario</h1>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje">
                <?= htmlspecialchars($mensaje, ENT_QUOTES, "UTF-8") ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <p class="error">
                <?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="index.php">
            <label for="nombre">Nombre:</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                maxlength="100"
                required
            >

            <label for="edad">Edad:</label>
            <input
                type="number"
                id="edad"
                name="edad"
                min="1"
                max="120"
                required
            >

            <label for="estatura">Estatura en metros:</label>
            <input
                type="number"
                id="estatura"
                name="estatura"
                min="0.5"
                max="2.5"
                step="0.01"
                required
            >

            <button type="submit">
                Crear usuario
            </button>
        </form>

        <h2>Usuarios registrados</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Estatura</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($datos as $dato): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($dato["id"], ENT_QUOTES, "UTF-8") ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($dato["nombre"], ENT_QUOTES, "UTF-8") ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($dato["edad"], ENT_QUOTES, "UTF-8") ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($dato["estatura"], ENT_QUOTES, "UTF-8") ?>
                            metros
                        </td>
                        <td>
                            <a href="index.php?accion=eliminar&id=<?= $dato["id"] ?>" onclick="return confirm('¿Deseas eliminar a este usuario?');"> Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</body>
</html>
