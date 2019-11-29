<?php
    require_once 'Conexion.php';
    require_once 'Util.php';
    require_once 'Seccion.php';
    require_once 'Curso.php';

    class Clase {

        public $id;
        public $seccion;
        public $titulo;
        public $duracion;
        public $video;
        public $texto;
        public $fechaSubida;
        public $descripcion;

        public static function buscar($id) {
            $query = 'SELECT * FROM clase WHERE id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($clase = $preparedStatement -> fetchObject()) {
                $clase = self ::mapear($clase);
                return $clase;
            } else {
                return null;
            }
        }

        public static function buscarClases ($id) {
            $lista = [];
            $query = 'SELECT * FROM clase WHERE seccion_id = ? ORDER BY id';
            $resultSet = Conexion ::conectarBD() -> prepare($query);
            $resultSet -> bindParam(1, $id);
            $resultSet -> execute();
            while ($clase = $resultSet -> fetchObject()) {
                $clase = self :: mapear($clase);
                array_push($lista, $clase);
            }
            return $lista;
        }

        public static function buscarContenidoCurso($id) {
            $clase = Clase::buscar($id);
            $seccion = Seccion::buscar($clase -> seccion);
            $curso = Curso::buscar($seccion -> curso);
            return ['curso' => $curso, 'contenido' => Curso::buscarContenido($curso -> id)];
        }

        private function mapear ($resultSet) {
            $clase = new Clase();
            $clase -> id = $resultSet -> id;
            $clase -> seccion = $resultSet -> seccion_id;
            $clase -> titulo = $resultSet -> titulo;
            $clase -> duracion = Util::convertirTiempo($resultSet -> duracion);
            $clase -> video = $resultSet -> contenido_video;
            $clase -> texto = $resultSet -> contenido_texto;
            $clase -> fechaSubida = $resultSet -> fecha_subida;
            $clase -> descripcion = $resultSet -> descripcion;
            return $clase;
        }

    }