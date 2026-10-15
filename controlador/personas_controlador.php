<?php
//Llamada al modelo
require_once "modelo/personas_modelo.php";
$per = new personas_modelo();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $nombre = trim($_POST["nombre"] ?? "");
    $edad = filter_var($_POST["edad"] ?? null, FILTER_VALIDATE_INT);
    $estatura = filter_var(
        $_POST["estatura"] ?? null,
        FILTER_VALIDATE_FLOAT
    );

    if ($nombre === "") {
        $error = "El nombre es obligatorio.";
    } elseif ($edad === false || $edad < 1 || $edad > 120) {
        $error = "La edad debe ser un número entre 1 y 120.";
    } elseif (
        $estatura === false ||
        $estatura < 0.5 ||
        $estatura > 2.5
    ) {
        $error = "La estatura debe estar entre 0.50 y 2.50 metros.";
    } else {
        try {
            $per->crear_persona($nombre, $edad, $estatura);
            $mensaje = "Usuario creado correctamente.";
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'vista1';
if ($accion === 'eliminar' && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if ($id) {
        try {
            $per->eliminar_persona($id);
            // Redirigimos para limpiar la URL y refrescar la tabla
            header("Location: index.php?accion=vista1");
            exit();
        } catch (Exception $e) {
            $error = "No se pudo eliminar la persona: " . $e->getMessage();
        }
    }
}

$datos = $per->get_personas();
//Llamada a la vista
require_once "vistas/personas_vista2.php";
?>
