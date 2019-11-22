<?php
    require_once 'Conexion.php';
    require_once 'Alternativa.php';

    class Pregunta {

        public $id;
        public $examen;
        public $numero;
        public $titulo;

        public static function buscar($id) {
            $query = 'SELECT * FROM pregunta WHERE id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($pregunta = $preparedStatement -> fetchObject()) {
                $pregunta = self ::mapear($pregunta);
                return $pregunta;
            } else {
                return null;
            }
        }

        public static function listar($id) {
            $lista = [];
            $query = 'SELECT * FROM pregunta WHERE examen_id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            while ($pregunta = $preparedStatement -> fetchObject()) {
                $pregunta = self :: mapear($pregunta);
                array_push($lista, $pregunta);
            }
            return $lista;
        }

        public static function listarAlternativas($id) {
            return Alternativa::listar($id);
        }

        private function mapear ($resultSet) {
            $pregunta = new Pregunta();
            $pregunta -> id = $resultSet -> id;
            $pregunta -> examen = $resultSet -> examen_id;
            $pregunta -> numero = $resultSet -> numero;
            $pregunta -> titulo = $resultSet -> titulo;
            return $pregunta;
        }

    }