<?php
    require_once 'Conexion.php';

    class Pais {

        public $id;
        public $nombre;

        public static function listar () {
            $lista = [];
            $query = 'SELECT * FROM pais';
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

    }