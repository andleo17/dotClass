<?php

    require_once 'Conexion.php';

    class Comentario {

        public $id;
        public $comentarioPadre;
        public $contenido;
        public $numeroLikes;
        public $numeroComentarios;
        public $esPregunta;
        public $estaResuelto;

        public static function buscar($id) {
            $query = 'SELECT * FROM comentario WHERE id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($comentario = $preparedStatement -> fetchObject()) {
                $comentario = self ::mapear($comentario);
                return $comentario;
            } else {
                return null;
            }
        }

        public static function listar() {
            $lista = [];
            $query = 'SELECT * FROM comentario';
            $resultSet = Conexion ::conectarBD() -> query($query);
            while ($comentario = $resultSet -> fetchObject()) {
                $comentario = self :: mapear($comentario);
                array_push($lista, $comentario);
            }
            return $lista;
        }

        private function mapear ($resultSet) {
            $comentario = new Comentario();
            $comentario -> id = $resultSet -> id;
            $comentario -> comentarioPadre = Comentario ::buscar($resultSet -> comentario_padre_id);
            $comentario -> contenido = $resultSet -> contenido;
            $comentario -> numeroLikes = $resultSet -> numero_likes;
            $comentario -> numeroComentarios = $resultSet -> numero_comentarios;
            $comentario -> esPregunta = $resultSet -> pregunta;
            $comentario -> estaResuelto = $resultSet -> resuelto;
            return $comentario;
        }

    }