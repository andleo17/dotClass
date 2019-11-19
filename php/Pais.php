<?php
    require_once 'Conexion.php';

    Pais ::ejecutar($_SERVER['REQUEST_URI']);

    class Pais {

        public $id;
        public $nombre;

        public static function listar () {
            $lista = [];
            $query = 'SELECT * FROM pais ORDER BY 2 ASC';
            $cnx = Conexion ::conectarBD();
            $resulset = $cnx -> query($query);
            while ($pais = $resulset -> fetchObject()) {
                $pais = self ::mapear($pais);
                array_push($lista, $pais);
            }
            return $lista;
        }

        public static function buscar ($id) {
            $query = 'SELECT * FROM pais WHERE id = ?';
            $cnx = Conexion ::conectarBD();
            $preparedStatement = $cnx -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($pais = $preparedStatement -> fetchObject()) {
                $pais = self ::mapear($pais);
                return $pais;
            } else {
                return null;
            }
        }

        private function mapear ($resultSet) {
            $pais = new Pais();
            $pais -> id = $resultSet -> id;
            $pais -> nombre = $resultSet -> nombre;
            return $pais;
        }

        public static function ejecutar ($request) {
            $peticion = explode('/', $request);
            if (in_array(__CLASS__, $peticion)) {
                $peticion = end($peticion);
                switch ($peticion) {
                    case '':
                        echo json_encode(self ::listar());
                        break;

                    default:
                        return self ::buscar($peticion);
                        break;
                }
            }
        }

    }