<?php

    require_once 'Conexion.php';

    Categoria ::ejecutar($_SERVER['REQUEST_URI']);

    class Categoria {

        public $id;
        public $nombre;
        public $descripcion;
        public $logo;

        private function mapear ($resultSet) {
            $categoria = new Categoria();
            $categoria -> id = $resultSet -> id;
            $categoria -> nombre = $resultSet -> nombre;
            $categoria -> descripcion = $resultSet -> descripcion;
            $categoria -> logo = $resultSet -> logo;
            return $categoria;
        }

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
            $query = 'SELECT * FROM categoria WHERE id = ?';
            $cnx = Conexion ::conectarBD();
            $preparedStatement = $cnx -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($categoria = $preparedStatement -> fetchObject()) {
                $categoria = self ::mapear($categoria);
                return $categoria;
            } else {
                return null;
            }
        }

        public static function ejecutar ($request) {
            $peticion = explode('/', $request);
            if ($peticion[count($peticion) - 2] == __CLASS__) {
                $peticion = end($peticion);
                switch ($peticion) {
                    case '':
                        echo json_encode(self ::listar());
                        break;

                    case 'crear':
                        echo '';
                        break;

                    default:
                        break;
                }
            }
        }


    }