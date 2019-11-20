<?php
    require_once 'Conexion.php';

    class Clase {

        public $id;
        public $seccion;
        public $titulo;
        public $duracion;
        public $video;
        public $texto;
        public $fechaSubida;

        public static function buscar ($id) {
            $lista = [];
            $query = 'SELECT * FROM clase WHERE seccion_id = ?';
            $resultSet = Conexion ::conectarBD() -> prepare($query);
            $resultSet -> bindParam(1, $id);
            $resultSet -> execute();
            while ($clase = $resultSet -> fetchObject()) {
                $clase = self :: mapear($clase);
                array_push($lista, $clase);
            }
            return $lista;
        }

        private function mapear ($resultSet) {
            $clase = new Clase();
            $clase -> id = $resultSet -> id;
            $clase -> seccion = $resultSet -> seccion_id;
            $clase -> titulo = $resultSet -> titulo;
            $clase -> duracion = $resultSet -> duracion;
            $clase -> video = $resultSet -> contenido_video;
            $clase -> texto = $resultSet -> contenido_texto;
            $clase -> fechaSubida = $resultSet -> fecha_subida;
            return $clase;
        }

    }