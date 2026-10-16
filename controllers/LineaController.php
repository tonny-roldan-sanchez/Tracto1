<?php
class LineaController
{
    private LineaModel $modelo;

    public function __construct(LineaModel $modelo)
    {
        $this->modelo = $modelo;
    }

    public function procesar(string $accion, array $datos): array
    {
        $nombre = trim((string) ($datos['nom_linea'] ?? ''));
        $id = (int) ($datos['id_linea'] ?? 0);

        if ($accion === 'eliminar' && $id > 0) {
            if ($this->modelo->contarCamiones($id) > 0) {
                return ['tipo' => 'danger', 'mensaje' => 'No se puede eliminar una linea que tiene camiones registrados.'];
            }

            $this->modelo->eliminar($id);
            return ['tipo' => 'success', 'mensaje' => 'Linea eliminada correctamente.'];
        }

        if ($nombre === '') {
            return ['tipo' => 'danger', 'mensaje' => 'Ingresa el nombre de la linea.'];
        }

        if ($accion === 'agregar') {
            if ($this->modelo->buscarPorNombre($nombre)) {
                return ['tipo' => 'warning', 'mensaje' => 'Esa linea ya esta registrada.'];
            }

            $this->modelo->crear($nombre);
            return ['tipo' => 'success', 'mensaje' => 'Linea agregada correctamente.'];
        }

        if ($accion === 'modificar' && $id > 0) {
            if ($this->modelo->buscarPorNombre($nombre, $id)) {
                return ['tipo' => 'warning', 'mensaje' => 'Ya existe otra linea con ese nombre.'];
            }

            $this->modelo->actualizar($id, $nombre);
            return ['tipo' => 'success', 'mensaje' => 'Linea modificada correctamente.'];
        }

        return ['tipo' => 'danger', 'mensaje' => 'Selecciona una linea valida para modificar.'];
    }
}