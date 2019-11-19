<?php
    require_once 'Conexion.php';
    require_once 'Clase.php';

    class Seccion {

        public $id;
        public $clases;
        public $titulo;

        public static function listar ($curso) {
            $lista = [];
            $query = 'SELECT * FROM seccion WHERE curso_id = ?';
            $resultSet = Conexion ::conectarBD() -> prepare($query);
            $resultSet -> bindParam(1, $curso);
            $resultSet -> execute();
            while ($seccion = $resultSet -> fetchObject()) {
                $seccion = self :: mapear($seccion);
                array_push($lista, $seccion);
            }
            return $lista;
        }

        private function mapear ($resultSet) {
            $seccion = new Seccion();
            $seccion -> id = $resultSet -> id;
            $seccion -> clases = Clase::listar($resultSet -> id);
            $seccion -> titulo = $resultSet -> titulo;
            return $seccion;
        }

    }