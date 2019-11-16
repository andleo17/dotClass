<?php

    require_once 'Conexion.php';

    class Categoria {

        public $id;
        public $nombre;

        public static function listar () {
            $lista = [];
            $query = 'SELECT * FROM categoria';
            $cnx = Conexion ::conectarBD();
            $resulset = $cnx -> query($query);
            while ($categoria = $resulset -> fetchObject()) {
                $categoria = self ::mapear($categoria);
                array_push($lista, $categoria);
            }
            return $lista;
        }

        public static function buscar ($id) {
            $query = 'SELECT * FROM categoria WHERE id = :id';
            $cnx = Conexion ::conectarBD();
            $preparedStatement = $cnx -> prepare($query);
            $preparedStatement -> bindParam(':id', $id);
            $preparedStatement -> execute();
            if ($categoria = $preparedStatement -> fetchObject()) {
                $categoria = self ::mapear($categoria);
                return $categoria;
            } else {
                return null;
            }
        }

        private function mapear ($resultSet) {
            $categoria = new Categoria();
            $categoria -> id = $resultSet -> id;
            $categoria -> nombre = $resultSet -> nombre;
            return $categoria;
        }

    }