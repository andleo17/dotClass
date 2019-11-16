<?php

    require_once 'Conexion.php';

    $peticion = $_SERVER['REQUEST_URI'];
    $peticion = explode('/', $peticion);

    if ($peticion[count($peticion) - 2] == 'Categoria.php') {
        $peticion = end($peticion);

        switch ($peticion) {
            case '':
                echo json_encode(Categoria ::listar());
                break;

            case 'crear':
                break;

            default:
                break;
        }
    }

    class Categoria {

        public $id;
        public $nombre;
        public $descripcion;
        public $logo;

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
            $categoria -> descripcion = $resultSet -> descripcion;
            $categoria -> logo = $resultSet -> logo;
            return $categoria;
        }

    }