<?php
    require_once 'Conexion.php';
    require_once 'Clase.php';

    class Seccion {

        public $id;
        public $curso;
        public $titulo;

        public static function buscar($id) {
            $query = 'SELECT * FROM seccion WHERE id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($seccion = $preparedStatement -> fetchObject()) {
                $seccion = self ::mapear($seccion);
                return $seccion;
            } else {
                return null;
            }
        }

        public static function buscarSecciones ($id) {
            $lista = [];
            $query = 'SELECT * FROM seccion WHERE curso_id = ?';
            $resultSet = Conexion ::conectarBD() -> prepare($query);
            $resultSet -> bindParam(1, $id);
            $resultSet -> execute();
            while ($seccion = $resultSet -> fetchObject()) {
                $seccion = self :: mapear($seccion);
                array_push($lista, $seccion);
            }
            return $lista;
        }

        public static function listarClases ($id) {
            return Clase ::buscarClases($id);
        }

        private function mapear ($resultSet) {
            $seccion = new Seccion();
            $seccion -> id = $resultSet -> id;
            $seccion -> curso = $resultSet -> curso_id;
            $seccion -> titulo = $resultSet -> titulo;
            return $seccion;
        }

    }