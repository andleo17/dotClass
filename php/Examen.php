<?php
    require_once 'Conexion.php';

    class Examen {

        public $id;
        public $curso;

        public static function buscar($id) {
            $query = 'SELECT * FROM examen WHERE curso_id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($examen = $preparedStatement -> fetchObject()) {
                $examen = self ::mapear($examen);
                return $examen;
            } else {
                return null;
            }
        }

        private function mapear ($resultSet) {
            $examen = new Examen();
            $examen -> id = $resultSet -> id;
            $examen -> curso = $resultSet -> curso_id;
            return $examen;
        }
        
    }