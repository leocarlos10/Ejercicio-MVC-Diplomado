<?php
class personas_modelo
{
    private $db;
    private $personas;

    public function __construct()
    {
        $this->db = Conectar::conexion();
        $this->personas = [];
    }
    public function get_personas()
    {
        $consulta = $this->db->query("select * from personas;");
        while ($filas = $consulta->fetch_assoc()) {
            $this->personas[] = $filas;
        }
        return $this->personas;
    }

    public function crear_persona($nombre, $edad, $estatura)
    {
        $consulta = $this->db->prepare(
            "INSERT INTO personas (nombre, edad, estatura)
             VALUES (?, ?, ?)",
        );

        if (!$consulta) {
            throw new Exception("No se pudo preparar la inserción.");
        }

        $consulta->bind_param("sid", $nombre, $edad, $estatura);

        if (!$consulta->execute()) {
            throw new Exception("No se pudo crear la persona.");
        }

        $consulta->close();

        return true;
    }

    public function eliminar_persona($id)
    {
        $consulta = $this->db->prepare("DELETE FROM personas WHERE id = ?");

        if (!$consulta) {
            throw new Exception("No se pudo preparar la eliminación.");
        }

        $consulta->bind_param("i", $id);

        if (!$consulta->execute()) {
            throw new Exception("No se pudo eliminar la persona.");
        }

        $consulta->close();

        return true;
    }
}
?>
