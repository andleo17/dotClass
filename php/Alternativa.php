<?php
    require_once 'Conexion.php';

    class Alternativa {

        public $id;
        public $alternativa;
        public $numero;
        public $contenido;
        public $respuesta;

        public static function buscar($id) {
            $query = 'SELECT * FROM alternativa WHERE id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($alternativa = $preparedStatement -> fetchObject()) {
                $alternativa = self ::mapear($alternativa);
                return $alternativa;
            } else {
                return null;
            }
        }

        public static function listar() {
            $lista = [];
            $query = 'SELECT * FROM alternativa';
            $resultSet = Conexion ::conectarBD() -> query($query);
            while ($alternativa = $resultSet -> fetchObject()) {
                $alternativa = self :: mapear($alternativa);
                array_push($lista, $alternativa);
            }
            return $lista;
        }

        private function mapear ($resultSet) {
            $alternativa = new Alternativa();
            $alternativa -> id = $resultSet -> id;
            $alternativa -> pregunta = $resultSet -> pregunta;
            $alternativa -> numero = $resultSet -> numero;
            $alternativa -> contenido = $resultSet -> contenido;
            $alternativa -> respuesta = $resultSet -> respuesta;
            return $alternativa;
        }

    }